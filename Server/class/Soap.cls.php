<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Soap
 *
 * @author cornel
 */
class Soap {
    var $_xmlDoc;
    function __construct(){
        $this->_xmlDoc = new DOMDocument();
        $rootElement = $this->_xmlDoc->createElement("root");
        $rootElement->nodeValue = "Test 123";
        $this->_xmlDoc->appendChild($rootElement);
        $this->_xmlDoc->save(BASE_DIR . '/xml/example.xml');
    }
}
