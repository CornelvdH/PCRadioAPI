<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CryptoCreator
 *
 * @author cornel
 */
require_once BASE_DIR . '/lib/password.php';

class CryptoCreator {

    const CRYPTO_TABLE = "apikeys";

    private static function createSalt($saltValue, $rand) {
        return md5($saltValue . "-" . $rand);
    }

    private static function hyphenate($str) {
        return implode("-", str_split($str, 5));
    }

    static function createHash($user, $userData) {
        $db = new Database();
        $rand = rand(0, 50000);
        $saltValue = date("dmY-His");
        $salt = self::createSalt($saltValue, $rand);
        $tempSerial = md5($user . "|" . $userData . "|" . $salt);
        $serial = self::hyphenate(strtoupper(substr($tempSerial, 0, 35)));
        $sqlObject = new SqlObject("INSERT INTO " . self::CRYPTO_TABLE . " VALUES (NULL, '$rand', '$saltValue', '$user', '$userData');");
        $db->execute($sqlObject);
        return $serial;
    }

    static function checkIfHashValid($user, $userData, $hash) {
        $db = new Database();
        $sqlObject = new SqlObject("SELECT * FROM " . self::CRYPTO_TABLE . " WHERE User = '$user' AND UserData = '$userData';");
        $result = $db->execute($sqlObject);
        $rand = $result[0]["RandomNumber"];
        $saltValue = $result[0]["SaltValue"];
        $userData = $result[0]["UserData"];
        $salt = self::createSalt($saltValue, $rand);
        $serialCheck = substr(md5($user . "|" . $userData . "|" . $salt), 0, 35);
        $hash = strtolower(str_replace("-", "", $hash));
        if ($hash === $serialCheck) {
            return true;
        } else {
            return false;
        }
    }

    static function regenerateForUser($user, $userData) {
        $db = new Database();
        $checkObj = new SqlObject("SELECT * FROM " . self::CRYPTO_TABLE . " WHERE User = '$user' AND UserData = '$userData';");
        $checkRes = $db->execute($checkObj);
        if (isset($checkRes[0]["ID"])) {
            $rand = rand(0, 50000);
            $saltValue = date("dmY-His");
            $salt = self::createSalt($saltValue, $rand);
            $tempSerial = md5($user . "|" . $userData . "|" . $salt);
            $serial = self::hyphenate(strtoupper(substr($tempSerial, 0, 35)));
            $sqlObject = new SqlObject("UPDATE " . self::CRYPTO_TABLE . " SET RandomNumber = '$rand', SaltValue = '$saltValue' WHERE User = '$user' AND UserData = '$userData';");
            $db->execute($sqlObject);
            return $serial;
        } else {
            return false;
        }
    }
}
