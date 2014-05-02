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
 */

/** 
  * this class extends Report class.
  *
  * The Statistics class provides the ability to quickly query the LRS.
  *
  * @see Report, TEST_CONST
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
    * @return result object
    */
    public function all(){
        $result = $this->lrs->queryStatements([]);
        return $result;
    }

    /**
    * method monthly()
    *
    *
    *
    * @method monthly()
    * @return result response object
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
        return $this->response;
    }

    /**
    * method weekly()
    *
    * @method weekly()
    * @return result response object
    * @todo Do we return everything from now till 7 days back, or everything in the current weeknumber?
    */
    public function weekly(){
        $result = $this->lrs->queryStatements([]);
        return $result;
    }

    /**
    * method daily()
    *
    * @method daily()
    * @return result response object
    * @todo return evertyhing from 00:00 till NOW
    */
    public function daily(){
        $result = $this->lrs->queryStatements([]);
        return $result;
    }

    /**
    * method actors()
    *
    * @method actors()
    * @param object $statements contains all statements
    * @return result response object
    */
    public function actors($statements){ //ACTORS
        $actors = array();
        foreach($statements as $statement):
            if(!array_key_exists($statement->actor->mbox, $actors)){
                $actors[$statement->actor->mbox] = $statement->actor;
            }
        endforeach;
        array_filter($actors);
        return $actors;
    }

    /**
    * method verbs()
    *
    * @method verbs()
    * @param object $statements contains all statements
    * @return result response object
    */
    public function verbs($statements){
        $verbs = array();
        foreach($statements as $statement):
            $verbs[$statement->actor->mbox] = $statement->actor;
        endforeach;
        array_filter($verbs);
        return $verbs;
    }

    /**
    * method activities()
    *
    * @method activities()
    * @param object $statements contains all statements
    * @return result response object
    */
    public function activities($statements){
        $activities = array();
        foreach($statements as $statement):
            $activities[$statement->actor->mbox] = $statement->actor;
        endforeach;
        array_filter($activities);
        return $activities;
    }
}
?>