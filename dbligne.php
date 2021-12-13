<?php 
class Database {
     private static $dbName = 'awebcons_ygestion' ;
     private static $dbHost = 'localhost' ; 
     private static $dbUsername = 'awebcons_ygestion';
     private static $dbUserPassword = 'njatosyhasina10Hasina';
     private static $conn = null;
  
    public static function connect() {
        if ( null == self::$conn ) { 
            try { 
                self::$conn = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
            } catch(PDOException $e) { 
                die($e->getMessage()); 
            }
       }
       return self::$conn;
    }
     
    public static function disconnect()
    {
        self::$conn = null;
    }
}
?>