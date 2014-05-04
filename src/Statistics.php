<?php
/**
 * This is a php report library.
 *
 * This PHP Report Library can be used in combination with a Learning Record Store
 * to retrieve, analyse and display the records.
 *
 * @package Report.Statistics
 * @author Klaas Poortinga
 * @version 0.1
 *
 * @todo Develop a settings page
 * @todo getMonth($month) method
 */

/** 
  * this class extends Report class.
  *
  * The Statistics class provides the ability to quickly query the LRS.
  *
  * @see Report
  */
class Statistics extends Report {

    /**
    * Response placeholder, will containt values returned from methods.
    *
    * @var empty $response
    */
    public $response;

    /**
    * __construct
    *
    * @method __construct() __construct($lrs)
    * @param object $lrs TinCan object
    */
    public function __construct($lrs){
        $this->lrs = $lrs;
    }

    /**
    * method all()
    *
    * @method all()
    * @return Returns all statements
    */
    public function all(){
        $result = $this->lrs->queryStatements([]);
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
    *
    *
    * @method monthly()
    * @return Returns monthly statements
    * @todo Figure out if we return monthly statements from this month, or 1 month back in time (eg. 30/31 days).
    */
    public function monthly(){
        $objDate = new DateTime('-1 month');
        $result = $this->lrs->queryStatements(['since' => $objDate->format(DateTime::ISO8601)]);
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
        $result = $this->lrs->queryStatements(['since' => $objDate->format(DateTime::ISO8601)]);
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
        $result = $this->lrs->queryStatements(['since' => $objDate->format(DateTime::ISO8601)]);
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
    * @return Returns object with actors information
    */
    public function actors(){ //ACTORS
        $actors = array();
        $statements = $this->response->statements;
        foreach($statements as $statement):
            if(!array_key_exists($statement->actor->mbox, $actors)){
                $actors[$statement->actor->mbox] = $statement->actor;
            }
        endforeach;
        array_filter($actors);

        // Setting new response object.
        $this->response = new stdClass();
        //$this->response->statements = $statements; // Do we want this?
        $this->response->actors = $actors;
        $this->response->count = count($actors);

        return $this;
    }

    /**
    * method verbs()
    *
    * @method verbs()
    * @return Returns object with verbs information
    */
    public function verbs(){
        $verbs = array();
        $statements = $this->response->statements;
        foreach($statements as $statement):
            if(!array_key_exists($statement->verb->id, $verbs)){
                $verbs[$statement->verb->id] = $statement->verb;
            }
        endforeach;
        array_filter($verbs);

        // Setting new response object.
        $this->response = new stdClass();
        //$this->response->statements = $statements; // Do we want this?
        $this->response->verbs = $verbs;
        $this->response->count = count($verbs);

        return $this;
    }

    /**
    * method activities()
    *
    * @method activities()
    * @return Returns object with activity information
    */
    public function activities(){
        $activities = array();
        $statements = $this->response->statements;
        foreach($statements as $statement):
            if(!array_key_exists($statement->object->id, $activities)){
                $activities[$statement->object->id] = $statement->object;
            }
        endforeach;
        array_filter($activities);

        // Setting new response object.
        $this->response = new stdClass();
        //$this->response->statements = $statements; // Do we want this?
        $this->response->activities = $activities;
        $this->response->count = count($activities);

        return $this;
    }

    /**
    * method getCount()
    *
    * @method getCount()
    * @return Returns count of statements
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
}
?>