<?php
/** 
 * this class extends Report class.
 *
 * The Analyse class provides the ability to quickly execute specific analyse queries.
 *
 * @package Report
 * @subpackage Analyse
 * @todo finish new method
 */
class Analyse extends Report {

    /**
    * Method __construct()
    *
    * @method __construct()
    */
    public function __construct(){

    }

    /**
    * Method getSuggestions($amount = NULL)
    *
    * @method getSuggestions($amount = NULL)
    * @param int $amount Amount of suggestions to return
    * @return array with suggestions
    * @todo Work out how to use related activities
    * @todo handle $agent->object in the filter
    * @todo Save original statement to display who the suggestion is based on.
    * @todo If 1 person does the same activity twice, count still goes up.
    */
    public function getSuggestions($amount = NULL){
        $result = parent::$lrs->queryStatements(['limit' => 100]);
        $statements = json_decode($result->httpResponse['_content']);

        $suggestions = array();
        foreach($statements->statements as $statement){
            if(isset($statement->actor->mbox)){
                if(!parent::$agent || $statement->actor->mbox != parent::$agent->getMbox()){
                    if(!array_key_exists($statement->object->id, $suggestions)){
                        if(isset($statement->object->definition->name->{"en-US"})){
                            $name = $statement->object->definition->name->{"en-US"};
                        }else{
                            $name = $statement->object->id;
                        }
                        $suggestions[$statement->object->id] = array('count' => 1, 'title' => $name);
                    }else{
                        $suggestions[$statement->object->id]['count'] += 1;
                    }
                }else{
                    // In this case the statement->actor is equal to the set user in Report::$agent
                    // In case the object is set already set, while the actor has done the activity, unset it.
                    if(isset($suggestions[$statement->object->id])){
                        unset($suggestions[$statement->object->id]);
                    }
                }
            }
        }

        arsort($suggestions);

        if($amount):
            $suggestions = array_slice($suggestions, 0, $amount, true);
        endif;

        return $suggestions;
    }

    /**
    * Method compareActors($actors)
    *
    * @method compareActors($actors)
    * @param array $actors
    * @return object with similar activities
    * @todo Handle account object correctly
    * @todo build checks to make sure mbox is set
    */
    public function compareActors(array $actors){
        $activities = array();
        foreach($actors as $actor){
            $result = parent::$lrs->queryStatements(['agent' => new TinCan\Agent(array('mbox' => $actor))]);
            $statements = json_decode($result->httpResponse['_content']);
            foreach($statements->statements as $statement){
                $actorValues = parent::actorValues($statement->actor);
                if(isset($activities[$statement->object->id])){
                    if(!array_key_exists($actorValues->id, $activities[$statement->object->id]['who'])){
                        $activities[$statement->object->id]['count']++; 
                        $activities[$statement->object->id]['who'][$actorValues->id] = $actorValues->name;
                    }
                }else{
                    if(isset($statement->object->definition->name->{'en-US'})){
                        $activities[$statement->object->id]['activity']['name'] = $statement->object->definition->name->{"en-US"};
                    }else{
                        $activities[$statement->object->id]['activity']['name'] = $statement->object->id;
                    }
                    $activities[$statement->object->id]['activity']['id'] = $statement->object->id;
                    $activities[$statement->object->id]['count'] = 1;
                    $activities[$statement->object->id]['who'][$actorValues->id] = $actorValues->name;
                }
            }
        }

        foreach($activities as $key => $activity){
            if($activity['count'] == 1){
                unset($activities[$key]);
            }
        }

        return $activities;
    }

}
?>