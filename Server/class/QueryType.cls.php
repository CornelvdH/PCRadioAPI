<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryType
 *
 * @author cornel
 */
class QueryType {
    /**
     * Give each query type its own number.
     */
    const SELECT = 1;
    const INSERT = 2;
    const UPDATE = 3;
    const DELETE = 4;
    const ALTER = 5;
    static function isValid($queryType){
        $reflObject = new ReflectionClass(get_class());
        if($reflObject->hasConstant($queryType)){
            return true;
        } else {
            return false;
        }
    }
    static function get($queryType){
        if(self::isValid($queryType)){
            $reflObject = new ReflectionClass(get_class());
            return $reflObject->getConstant($queryType);
        } else {
            return false;
        }
    }
}
