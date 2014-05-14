<?php
/** 
 * this class extends Report class.
 *
 * The Statistics class provides the ability to quickly query the LRS.
 *
 * @package Report
 * @subpackage Statistics
 * @todo Different names for filterActors,Verbs,Activities
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
    * Retrieves all statements available from the LRS.
    * Note: Your LRS may have a limit on the amount of statements that it returns.
    *       The public LRS for example returns up to 500 statements maximum.
    *
    * @method all()
    * @return Returns all statements from LRS.
    */
    public function allTime(){
        $result = parent::$lrs->queryStatements([]);
        $content = json_decode($result->httpResponse['_content']);

        $this->response = new stdClass();
        $this->response->success = $result->success;
        $this->response->statements = $content->statements;
        $this->response->count = count($content->statements);
        return $this;
    }

    /**
    * method pastMonth()
    *
    * @method pastMonth()
    * @return Returns statements from last 30/31 days.
    */
    public function pastMonth(){
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
    * method pastWeek()
    *
    * @method pastWeek()
    * @return Returns statements from last 7 days.
    */
    public function pastWeek(){
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
    * method pastDay()
    *
    * @method pastDay()
    * @return Returns all statements from last 24 hours.
    */
    public function pastDay(){
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
    * method getMonth($month)
    *
    * @method getMonth($month)
    * @param string/int $month month of query
    * @return Returns statements from specific month
    * @todo option to query from last year?
    */
    public function getMonth($month){
        // Handle param, typeof == string or typeof == int etc.

        // $this->response = new stdClass();
        // $this->response->success = $result->success;
        // $this->response->date = $objDate->format(DateTime::ISO8601);
        // $this->response->statements = $content->statements;
        // $this->response->count = count($content->statements);
        // return $this;
    }

    /**
    * method filterActors()
    *
    * @method filterActors()
    * @return Returns object with all actors from statements object
    */
    public function filterActors(){
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

        return $this;
    }

    /**
    * method filterVerbs()
    *
    * @method filterVerbs()
    * @return Returns object with verbs information
    */
    public function filterVerbs(){
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
    * method filterActivities()
    *
    * @method filterActivities()
    * @return Returns object with activity information
    */
    public function filterActivities(){
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
    * method getActor($email)
    *
    * @method getActor($email)
    * @param string $email email of actor
    * @return Returns statements with specific actor
    */
    public function getActor($email){
        // Query actor with tincan\Agent

        // $this->response = new stdClass();
        // $this->response->success = $result->success;
        // $this->response->date = $objDate->format(DateTime::ISO8601);
        // $this->response->statements = $content->statements;
        // $this->response->count = count($content->statements);
        // return $this;
    }

    /**
    * method getVerb($verb)
    *
    * @method getVerb($verb)
    * @param string $verb verb
    * @return Returns statements with specific verb
    */
    public function getVerb($verb){
        // Handle verb, is it a URI? or the display {'en-US'}? Etc.

        // $this->response = new stdClass();
        // $this->response->success = $result->success;
        // $this->response->date = $objDate->format(DateTime::ISO8601);
        // $this->response->statements = $content->statements;
        // $this->response->count = count($content->statements);
        // return $this;
    }

    /**
    * method getActivity($activity)
    *
    * @method getActivity($activity)
    * @param string $activity activity
    * @return Returns statements with specific activity
    */
    public function getActivity($activity){
        // Handle verb, is it a URI? or the display {'en-US'}? Etc.

        // $this->response = new stdClass();
        // $this->response->success = $result->success;
        // $this->response->date = $objDate->format(DateTime::ISO8601);
        // $this->response->statements = $content->statements;
        // $this->response->count = count($content->statements);
        // return $this;
    }

    /**
    * method getCount()
    *
    * @method getCount()
    * @return Returns count of previous method
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

        $i = 0;
        foreach($this->response->statements as $statement){
            $this->response->statements[$i] = new Statement($statement);
            $i++;
        }

        return $this->response->statements;
    }

    /**
    * method getTimeElapsedString($datetime, $full = false)
    *
    * @method getTimeElapsedString($datetime, $full = false)
    * @param datetime $datetime A datetime or timestamp value
    * @param bool $full 
    * @return String of elapsed time
    */
    public function getTimeElapsedString($datetime, $full = false) {
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

    /**
    * method getRandom()
    *
    * @method getRandom()
    * @return Object random statement object
    */
    function getRandomStatement() {
        $statements = $this->response->statements;
        $index = array_rand($statements, 1);
        $statements[$index] = new Statement($statements[$index]);
        return $statements[$index];
    }
}
?>