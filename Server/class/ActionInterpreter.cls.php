<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ActionInterpreter
 *
 * @author cornel
 */
class ActionInterpreter {
    var $_requestArray;
    var $_baseAction;
    var $_postArray;
    
    const ACTION_KEY = "action";
    
    function __construct($getArray, $postArray){
        $this->_requestArray = $getArray;
        $this->_postArray = $postArray;
        if(array_key_exists(self::ACTION_KEY, $this->_requestArray)){
            $this->_baseAction = $this->_requestArray[self::ACTION_KEY];
        } else {
            throw new Exception("Action not provided.");
        }
    }
    function run(){
        return call_user_func(array($this, $this->_baseAction));
    }
    function auth(){
        
        //return CryptoCreator::createHash($array['userName'], $array['machineName']);
    }
}
