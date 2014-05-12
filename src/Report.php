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
 */
class Report {

    /**
    * Tin Can Version number
    *
    * @var string $version
    */
    private $version = '1.0.1';

    /**
    * Response placeholder, will containt values returned from methods.
    *
    * @var empty $response
    */
    public $Statistics;

    /**
    * Response placeholder, will containt values returned from methods.
    *
    * @var empty $response
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
            $this->lrs = new TinCan\RemoteLRS($lrs_endpoint, $this->version, $lrs_username, $lrs_password);
            $this->Statistics = new Statistics($this->lrs);
            $this->Analyse = new Analyse($this->lrs);
            return true;
        endif; 
        return false;
    }

}