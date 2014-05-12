<?php
/** 
  * this class extends Report class.
  *
  * The Analyse class provides the ability to quickly execute specific analyse queries.
  *
  * @package Report
  * @subpackage Analyse
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
     * Method getSuggestions()
     *
     * @method getSuggestions()
     * @param int $amount Amount of suggestions to return
     * @return array with suggestions
     * @todo Work out how to use related activities
     * @todo handle $agent->object in the filter
     */
    public function getSuggestions($amount = NULL){
        $result = parent::$lrs->queryStatements([]);
        $statements = json_decode($result->httpResponse['_content']);
        $suggestions = array_reduce($statements->statements, function($v, $item){
            if(!parent::$agent || $item->actor->mbox != parent::$agent->getMbox()):
                if(!array_key_exists($item->object->id, $v)){
                    if(isset($item->object->definition->name->{"en-US"})){
                        $name = $item->object->definition->name->{"en-US"};
                    }else{
                        $name = $item->object->id;
                    }
                    $v[$item->object->id] = array('count' => 1, 'title' => $name);
                }else{
                    $v[$item->object->id]['count'] += 1;
                }
            endif;

            return $v;
        }, array());
        arsort($suggestions);

        if($amount):
            $suggestions = array_slice($suggestions, 0, $amount, true);
        endif;

        return $suggestions;
    }


}