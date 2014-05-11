<?php
require_once 'BaseSettings.lib.php';
function doAutoLoad($className){
    require_once BASE_DIR . "/class/" . $className . ".cls.php";
}