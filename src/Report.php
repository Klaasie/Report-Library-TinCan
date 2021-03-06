<?php

/**
 * This is a php report library.
 *
 * This PHP Report Library can be used in combination with a Learning Record Store
 * to retrieve, analyse and display the records.
 * @package Report
 * @author Klaas Poortinga
 * @version V0.2
 *
 * @todo Develop a settings page
 * @todo Allow for ajax calls
 * @todo Added a star rating system to demo, should this be implemented in the library itself?
 * @todo Allow to rate your own statements, give value to the importance of the statement
 * @todo Handle html entities
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
    * method __constructor()
    *
    * @method __construct()
    */
    public function __construct(){

    }

    /**
    * Connects the library to a Learning Record Store.
    *
    * @method connectLrs(lrs_endpoint, lrs_username, lrs_password)
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
    * @method addAgent($email, $name = NULL)
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

    /**
    * Get the actor values
    *
    * This method returns actor information in one format.
    * This method is to prevent having to check which actor type we're dealing with 
    * in every function we're using actors.
    *
    * @method actorValues($actorObj)
    * @param object $actorObj
    * @return object actor information
    * @todo Handle groups
    */
    static function actorValues($actorObj) {
        $actor = new stdClass();

        if(isset($actorObj->objectType) && $actorObj->objectType == "Group"){
            // Handle groups
            return "Groups currently not supported.";
        }else{
            // An Actor Agent can be uniquely identified by: mbox, mbox_sha1sum, openid, account.
            if(array_key_exists('mbox', $actorObj)){
                $actor->id = $actorObj->mbox;
                if(isset($actorObj->name)){
                    $actor->name = $actorObj->name;
                }else{
                    $actor->name = NULL;
                }
            }else if(array_key_exists('mbox_sha1sum', $actorObj)){
                $actor->id = $actorObj->mbox_sha1sum;
                if(isset($actorObj->name)){
                    $actor->name = $actorObj->name;
                }else{
                    $actor->name = NULL;
                }
            }else if(array_key_exists('openid', $actorObj)){
                $actor->id = $actorObj->openid;
                if(isset($actorObj->name)){
                    $actor->name = $actorObj->name;
                }else{
                    $actor->name = NULL;
                }
            }else{
                $actor->id = $actorObj->account->homePage;
                if(isset($actorObj->account->name)){
                    $actor->name = $actorObj->account->name;
                }else{
                    $actor->name = NULL;
                }
            }
        }

        return $actor;
    }
}
?>