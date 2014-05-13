<?php

/**
 * This is a php report library.
 *
 * This PHP Report Library can be used in combination with a Learning Record Store
 * to retrieve, analyse and display the records.
 * @package Report
 * @author Klaas Poortinga
 * @version V0.1
 *
 * @todo Develop a settings page
 * @todo Option to make a TinCan\Agent - for situations where someone would login
 * @todo Allow for ajax calls
 * @todo Added a star rating system to demo, should this be implemented in the library itself?
 * @todo Create printStatement function
 */
class Report {

    /**
    * Tin Can Version number
    *
    * @var string $version
    */
    private $version = '1.0.1';

    /**
    * lrs placeholder, will containt lrs object.
    *
    * @var empty $lrs
    */
    static $lrs;

    /**
    * agent placeholder, will containt agent object.
    *
    * @var empty $agent
    */
    static $agent;

    /**
    * Statistics placeholder, will be used for new Statistics()
    *
    * @var empty $Statistics
    */
    public $Statistics;

    /**
    * Analyse placeholder, will be used for new Analyse()
    *
    * @var empty $Analyse
    */
    public $Analyse;

    /**
    * method __constructor()
    *
    * @method __construct()
    */
    public function __construct(){

    }

    /**
    * Connects the library to a Learning Record Store.
    *
    * @method boolean connectLrs(lrs_endpoint, lrs_username, lrs_password)
    * @param string $lrs_endpoint Learning Record Store endpoint
    * @param string $lrs_username Basic Auth Username
    * @param string $lrs_password Basic Auth Password
    * @return bool 
    */
    public function connectLrs($lrs_endpoint, $lrs_username, $lrs_password){
        if($lrs_endpoint && $lrs_username && $lrs_password):
            self::$lrs = new TinCan\RemoteLRS($lrs_endpoint, $this->version, $lrs_username, $lrs_password);
            $this->Statistics = new Statistics();
            $this->Analyse = new Analyse();
            return true;
        endif; 
        return false;
    }

    /**
    * Adds an agent to the object.
    *
    * This method adds a new agent to the object. This is particulary usefull for profile pages aswell as for
    * analyse blocks.
    *
    * @method boolean addAgent($email, $name = NULL)
    * @param string $email Actor email
    * @param string $name Actor name default NULL
    * @return bool
    * @todo Handle $agent->object
    */
    public function addAgent($email, $name = NULL){
        if(stripos($email, 'mailto:') === false){
            $email = 'mailto:' . $email;
        }
        
        if(isset($email)){
            $tcAgent = array(
                    'mbox' => $email,
                    'name' => $name
                );
            self::$agent = new TinCan\Agent($tcAgent);
            return true;
        }
        return false;
    }

}