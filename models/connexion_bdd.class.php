<?php

abstract class Model{
    private static $pdo;

    private static function setBdd(){
        self::$pdo = new PDO("mysql:host=localhost;dbname=agoraagricultureurbaine;charset=utf8","root","");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }

    protected function getBdd(){
        if(self::$pdo === null){
            self::setBdd();
        }
        return self::$pdo;
    }
}




/*     $bdd = new PDO('mysql:host=localhost;dbname=agoraagricultureurbaine2', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $bdd->exec("set names utf8"); */

/*     const HOST_NAME = "localhost";
    const DATABASE_NAME = "agoraagricultureurbaine2";
    const USER_NAME = "root";
    const PASSWORD = "";

    function connexionPDO(){
        try{
            $bdd = new PDO("mysql:host=".HOST_NAME.";dbname=".DATABASE_NAME."; charset=utf8", USER_NAME, PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bdd;
        }catch (PDOException $e){
            $message = "Erreur PDO avec le message" .$e->getMessage();
            die($message);
        }
    }

    $bdd = connexionPDO();
 */
