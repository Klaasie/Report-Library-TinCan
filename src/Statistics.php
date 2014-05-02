<?php
require_once('Report.php');
class Statistics extends Report {

    public $response;

    public function __construct($lrs){
        //Do stuff.
        $this->lrs = $lrs;
    }

    /*
        Statistics->all()
        Returns all time statistics.
    */
    public function all(){
        $result = $this->lrs->queryStatements([]);
        return $result;
    }

    /*
        Statistics->monthly()
        Returns monthly statistics.
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

    /*
        Statistics->weekly()
        Returns weekly statistics.
    */
    public function weekly(){
        $result = $this->lrs->queryStatements([]);
        return $result;
    }

    /*
        Statistics->daily()
        Returns daily statistics.
    */
    public function daily(){
        $result = $this->lrs->queryStatements([]);
        return $result;
    }

    /*
        Statistics->employees($statements)
        Returns employees statistics.
    */
    public function employees($statements){ //ACTORS
        $employees = array();
        foreach($statements as $statement):
            // IF !array_key_exists
            $employees[$statement->actor->mbox] = $statement->actor;
        endforeach;
        array_filter($employees);
        return $employees;
    }

    /*
        Statistics->verbs($statements)
        Returns verbs statistics.
    */
    public function verbs($statements){
        $verbs = array();
        foreach($statements as $statement):
            $verbs[$statement->actor->mbox] = $statement->actor;
        endforeach;
        array_filter($verbs);
        return $verbs;
    }

    /*
        Statistics->activities($statements)
        Returns activities statistics.
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