<?php
/** 
 * this class extends Report class.
 *
 * The Statement class provides the ability to retrieve statement values through methods.
 * This class bears resemblance to the Tin Can API.
 *
 * @package Report
 * @subpackage Statement
 * @todo Think of a better name for class
 */
class Statement extends Report {

    /**
    * Constructs the class
    * By setting $this->statements the use of statements methods won't result into errors with Statistics methods.
    *
    * @method __construct()
    * @param object $statements contains all statements
    * @return string $statement
    */
    public function __construct($statement = NULL){
        if($statement !== NULL){
            $this->statement = $statement;
        }
    }

    /**
    * Outputs a basic statement in string
    *
    * Takes the object of a statement and returns it as a string,
    * This method prevents you from having to do all the checks again.
    *
    * @method printStatement()
    * @param object $statements contains all statements
    * @return string $statement
    */
    public function getBasicStatement(){
        $actor = $this->getActorName();
        $verb = $this->getVerbName();
        $object = $this->getActivityName();

        return $actor . ' ' . $verb . ' ' . $object;
    }

    /**
    * Returns actor name
    *
    * @method getActorName()
    * @return String of actor name
    */
    public function getActorName(){
        if(isset($this->statement->actor->name)):
            $actor = $this->statement->actor->name;
        elseif(isset($this->statement->actor->account)):
            if(isset($this->statement->actor->account->name)):
                $actor = $this->statement->actor->account->name;
            else:
                $actor = $this->statement->actor->account->homePage;
            endif;
        else:
            $actor = $this->statement->actor->mbox;
        endif;

        return $actor;
    }

    /**
    * Returns verb name
    *
    * @method getVerbName()
    * @return String of verb name
    */
    public function getVerbName(){
        if(isset($this->statement->verb->display->{"en-US"})):
            $verb = $this->statement->verb->display->{'en-US'};
        else:
            $verb = $this->statement->verb->id;
        endif;

        return $verb;
    }

    /**
    * Returns activity name
    *
    * @method getActivityName()
    * @return String of activity name
    */
    public function getActivityName(){
        if(isset($this->statement->object->definition->name->{"en-US"})):
            $object = $this->statement->object->definition->name->{"en-US"};
        else:
            $object = $this->statement->object->id;
        endif;

        return $object;
    }

    /**
    * Returns activity url
    *
    * @method getActivityUrl()
    * @return String of activity url
    */
    public function getActivityUrl(){
        if(isset($this->statement->object->id)):
            $url = $this->statement->object->id;
        else:
            return false;
        endif;

        return $url;
    }

}
?>