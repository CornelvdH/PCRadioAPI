<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author cornel
 */
class Database {

    /**
     *
     * This dbLink var contains all connection properties for the specific database connection.
     */
    var $dbLink;

    /**
     * Constructor function.
     */
    function __construct() {
        /**
         * If we have settings loaded, we can start building our PDO connection.
         */
        if (defined("SETTINGS_LOADED") && SETTINGS_LOADED === true) {
            $this->dbLink = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $this->dbLink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } else {
            throw new Exception("Unable to load: no settings file provided.");
        }
    }

    function execute($sqlObject) {
        if (is_a($sqlObject, 'SqlObject')) {
            $stmt = $this->dbLink->prepare($sqlObject->sqlQuery);
            foreach ($sqlObject->params as $key => $value) {
                $stmt->bindParam(':' . $key, $value);
            }
            $queryResult = $stmt->execute();
            if ($sqlObject->queryType == QueryType::SELECT) {
                $result = $stmt->fetchAll($sqlObject->returnType);
                return $result;
            } else {
                return $queryResult;
            }
        } else {
            throw new Exception("Var must be of type SQL Object.");
        }
    }

}
