<?php

class Report {

    protected $lrs;
    protected $version = '1.0.1';

    public function __construct(){
        require '../vendor/autoload.php';
    }

    public function connect_lrs($lrs_endpoint, $lrs_username, $lrs_password){
        $this->lrs = new TinCan\RemoteLRS($lrs_endpoint, $this->version, $lrs_username, $lrs_password);
        return $this->lrs;
    }

}