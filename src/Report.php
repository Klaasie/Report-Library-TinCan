<?php

class Report {

    protected $version = '1.0.1';

    public function __construct(){
        //Do stuff.
    }

    public function connectLrs($lrs_endpoint, $lrs_username, $lrs_password){
        $this->lrs = new TinCan\RemoteLRS($lrs_endpoint, $this->version, $lrs_username, $lrs_password);
        $this->Statistics = new Statistics($this->lrs);
        return true;
    }

}