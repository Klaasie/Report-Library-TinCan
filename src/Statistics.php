<?php
/** 
  * this class extends Report class.
  *
  * The Statistics class provides the ability to quickly query the LRS.
  *
  * @package Report
  * @subpackage Statistics
  * @todo getMonth($month) method
  * @todo Check if response is available for actors(), verbs(), activities(). If not a query should follow.
  * @todo Create a limit, queries that are too big take long to display. Note: Limit on public LRS is at 500. This takes roughly 3 - 5 seconds..
  */
class Statistics extends Report {

    /**
    * Response placeholder, will containt values returned from methods.
    *
    * @var empty $response
    */
    public $response;

    /**
    * method __construct()
    *
    * @method __construct()
    */
    public function __construct(){

    }

    /**
    * method all()
    *
    * @method all()
    * @return Returns all statements
    */
    public function all(){
        $result = parent::$lrs->queryStatements([]);
        $content = json_decode($result->httpResponse['_content']);

        $this->response = new stdClass();
        $this->response->success = $result->success;
        $this->response->statements = $content->statements;
        $this->response->count = count($content->statements);
        return $this;
    }

    /**
    * method monthly()
    *
    * @method monthly()
    * @return Returns monthly statements
    * @todo Figure out if we return monthly statements from this month, or 1 month back in time (eg. 30/31 days).
    */
    public function monthly(){
        $objDate = new DateTime('-1 month');
        $result = parent::$lrs->queryStatements(['since' => $objDate->format(DateTime::ISO8601)]);
        $content = json_decode($result->httpResponse['_content']);

        $this->response = new stdClass();
        $this->response->success = $result->success;
        $this->response->date = $objDate->format(DateTime::ISO8601);
        $this->response->statements = $content->statements;
        $this->response->count = count($content->statements);
        return $this;
    }

    /**
    * method weekly()
    *
    * @method weekly()
    * @return Returns weekly statements
    * @todo Do we return everything from now till 7 days back, or everything in the current weeknumber?
    */
    public function weekly(){
        $objDate = new DateTime('-1 week');
        $result = parent::$lrs->queryStatements(['since' => $objDate->format(DateTime::ISO8601)]);
        $content = json_decode($result->httpResponse['_content']);

        $this->response = new stdClass();
        $this->response->success = $result->success;
        $this->response->date = $objDate->format(DateTime::ISO8601);
        $this->response->statements = $content->statements;
        $this->response->count = count($content->statements);
        return $this;
    }

    /**
    * method daily()
    *
    * @method daily()
    * @return Returns daily statements
    * @todo return evertyhing from 00:00 till NOW
    */
    public function daily(){
        $objDate = new DateTime('-1 day');
        $result = parent::$lrs->queryStatements(['since' => $objDate->format(DateTime::ISO8601)]);
        $content = json_decode($result->httpResponse['_content']);

        $this->response = new stdClass();
        $this->response->success = $result->success;
        $this->response->date = $objDate->format(DateTime::ISO8601);
        $this->response->statements = $content->statements;
        $this->response->count = count($content->statements);
        return $this;
    }

    /**
    * method actors()
    *
    * @method actors()
    * @param null $email query on an actor specific
    * @return Returns object with actors information
    * @todo Wonder if this function should be split up in actors() and getActors (to prevent the use of the if/else statement)
    */
    public function actors($email = null){
        if($email == null && $this->response->statements){
            $actors = array();
            $statements = $this->response->statements;
            foreach($statements as $statement):
                // An actor can be uniquely identified by: mbox, mbox_sha1sum, openid, account.
                if(array_key_exists('mbox', $statement->actor)){
                    $type = "mbox";
                }else if(array_key_exists('mbox_sha1sum', $statement->actor)){
                    $type = "mbox_sha1sum";
                }else if(array_key_exists('openid', $statement->actor)){
                    $type = "openid";
                }else{
                    $type = "account";
                }

                // Extra check since a type "account" requires a different approach.
                if($type != "account"){
                    // Extra check to see if actor->type is set.
                    if(isset($statement->actor->$type)){
                        if(!array_key_exists($statement->actor->$type, $actors)){
                            $actors[$statement->actor->$type] = $statement->actor;
                        }
                    }
                }else{
                    if(isset($statement->actor->$type->name)){
                        if(!array_key_exists($statement->actor->$type->name, $actors)){
                            $actor[$statement->actor->$type->name] = $statement->actor;
                        }
                    }
                }
                
            endforeach;
            array_filter($actors);

            // Setting new response object.
            $this->response = new stdClass();
            $this->response->statements = $statements;
            $this->response->actors = $actors;
            $this->response->count = count($actors);
        }else{
            // $email is set and $this->response->statements is not, which means we still have to do a query.
            $result = parent::$lrs->queryStatements(['agent' => new TinCan\Agent(array('mbox' => 'mailto:' . $email ))]);
            $content = json_decode($result->httpResponse['_content']);

            $this->response = new stdClass();
            $this->response->success = $result->success;
            $this->response->statements = $content->statements;
            $this->response->count = count($content->statements);
        }

        return $this;
    }

    /**
    * method verbs()
    *
    * @method verbs()
    * @return Returns object with verbs information
    * @todo Enable function to query specific verb
    * @todo This function should do a query when no statements are set.
    */
    public function verbs(){
        $verbs = array();
        $statements = $this->response->statements;
        foreach($statements as $statement):
            // Extra check to see if verb->id is set.
            if(isset($statement->verb->id)){
                if(!array_key_exists($statement->verb->id, $verbs)){
                    $verbs[$statement->verb->id] = $statement->verb;
                }
            }
        endforeach;
        array_filter($verbs);

        // Setting new response object.
        $this->response = new stdClass();
        $this->response->statements = $statements;
        $this->response->verbs = $verbs;
        $this->response->count = count($verbs);

        return $this;
    }

    /**
    * method activities()
    *
    * @method activities()
    * @return Returns object with activity information
    * @todo Enable function to query specific activity
    * @todo This function should do a query when no statements are set.
    */
    public function activities(){
        $activities = array();
        $statements = $this->response->statements;
        foreach($statements as $statement):
            //Extra check if object->id is set, this one is required but apparently not in the public LRS.
            if(isset($statement->object->id)){
                if(!array_key_exists($statement->object->id, $activities)){
                    $activities[$statement->object->id] = $statement->object;
                }
            }
        endforeach;
        array_filter($activities);

        // Setting new response object.
        $this->response = new stdClass();
        $this->response->statements = $statements;
        $this->response->activities = $activities;
        $this->response->count = count($activities);

        return $this;
    }

    /**
    * method getCount()
    *
    * @method getCount()
    * @return Returns count of previous method
    * @todo Is it clear what is returned here?
    */
    public function getCount(){
        return $this->response->count;
    }

    /**
    * method getStatements()
    *
    * @method getStatements()
    * @return Returns an array of statements
    */
    public function getStatements(){
        return $this->response->statements;
    }

    /**
    * method getTimeElapsedString()
    *
    * @method getTimeElapsedString()
    * @param datetime $datetime A datetime or timestamp value
    * @param bool $full 
    * @return String of elapsed time
    */
    function getTimeElapsedString($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
?>