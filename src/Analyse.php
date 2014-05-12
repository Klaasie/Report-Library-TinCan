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
     * @param object $lrs Tin Can object
     */
    public function __construct($lrs){
        $this->lrs = $lrs;
    }

    /**
     * Method getSuggestions()
     *
     * @method getSuggestions()
     * @param int $amount Amount of suggestions to return
     * @return array with suggestions
     * @todo Make the amount of different users having done a specific activity matter.
     * @todo Work out how to use related activities
     * @todo build in checks
     */
    public function getSuggestions($amount = NULL){
        $result = $this->lrs->queryStatements([]);
        $statements = json_decode($result->httpResponse['_content']);

        $test = array_reduce($statements->statements, function($v, $item){
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

            return $v;
        }, array());
        arsort($test);

        if($amount):
            $test = array_slice($test, 0, $amount, true);
        endif;

        return $test;
    }


}