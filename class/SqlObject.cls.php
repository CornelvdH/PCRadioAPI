<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SqlObject
 *
 * @author cornel
 */
class SqlObject {
    var $queryType;
    var $sqlQuery;
    var $params = array();
    var $returnType = PDO::FETCH_BOTH;
    function __construct($sqlQuery){
        if(!empty($sqlQuery)){
            $this->sqlQuery = $sqlQuery;
            $this->process();
        } else {
            throw new Exception("SQL Object error: SQL Query empty or invalid.");
        }
    }
    private function process(){
        $sqlParts = explode(" ", $this->sqlQuery);
        $sqlKeyword = strtoupper($sqlParts[0]);
        if(QueryType::isValid($sqlKeyword)){
            $this->queryType = QueryType::get($sqlKeyword);
        } else {
            throw new Exception("SQL Object error: SQL Query empty or invalid.");
        }
    }
    function addParam($key, $value){
        if(!is_numeric($key)){
            $this->params[$key] = $value;
        } else {
            throw new Exception("Key must be associative.");
        }
    }
    function addParamsWithArray($params){
        if(is_array($params)){
            foreach($params as $k => $v){
                $this->params[$k] = $v;
            }
        } else {
            throw new Exception("Paramaters var must be an array.");
        }
    }
    function setReturnType($pdoReturnType){
        if($pdoReturnType >= 2 && $pdoReturnType <= 4){
            $this->returnType = $pdoReturnType;
        } else {
            throw new Exception("PDO Return Type doesn't have a recognized value.");
        }
    }
}
