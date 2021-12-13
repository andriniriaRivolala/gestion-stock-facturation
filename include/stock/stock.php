<?php

class Stock{
    private static $dbName = 'awebcons_ygestion' ;
    private static $dbHost = 'localhost' ; 
    private static $dbUsername = 'awebcons_ygestion';
    private static $dbUserPassword = 'njatosyhasina10Hasina';
    private static $conn = null;
  
    public function __construct(){
        if ( null == self::$conn ) { 
            try { 
                self::$conn = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
            } catch(PDOException $e) { 
                die($e->getMessage()); 
            }
       }
       return self::$conn;
    }

    public function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    public function readStock(){
        $data = array();
        $sql = 'SELECT*FROM produit ORDER BY id DESC'; 
        
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }

    public function getStockById($id){
        $sql = "SELECT * FROM Stock WHERE id=?";

        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function getProduitById($id){
        $sql = "SELECT nom,prix,stock  FROM produit where id =?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }


    public function totalStock(){
        $sql = "SELECT sum(stock) FROM produit";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $total= $stmt->fetch();

        return $total[0];
    }  
}
    
?>