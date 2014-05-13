<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");
/**
 * Check which protocol we're on and set base URL accordingly.
 */
$proto = "http";
if((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443){
    $proto = "https";
}
define("PROTO", $proto);

/**
 * Set Base URL.
 */
define("BASE_URL", PROTO . "://" . rtrim($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],"/"));

if(!defined("BASE_DIR")){
    define("BASE_DIR", dirname(__FILE__));
}

require_once BASE_DIR . "/lib/AutoLoader.lib.php";

spl_autoload_register('doAutoLoad');

/**
 * Get data provider based on action requested.
 */

$action = new ActionInterpreter($_GET, $_POST);
echo $action->run();
$soap = new Soap();
