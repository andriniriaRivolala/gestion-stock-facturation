<?php

class categorie{
    private static $dbName = 'agestion' ;
    private static $dbHost = 'localhost' ; 
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
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

    public function insert($nom){
        $sql = "INSERT INTO categorie (nom) VALUES (?)";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($nom));

        return true;
    }

    public function read(){
        $data = array();
        $sql = 'SELECT * FROM categorie ORDER BY id ASC'; 
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }

    public function getCategorieById($id){
        $sql = "SELECT * FROM categorie where id =?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($id));
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function update($nom,$id){
        $sql = "UPDATE categorie SET nom =? WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($nom,$id));

        return true;
    }

    public function delete($id){
        $sql = "DELETE FROM categorie WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array( $id));

        return true;
    }

    public function totalCategorie(){
        $sql = "SELECT * FROM categorie ";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $total = $stmt->rowCount();

        return $total;
    }  
}
    
?>