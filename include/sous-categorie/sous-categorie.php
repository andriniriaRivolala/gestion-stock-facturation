<?php

class souscategorie{
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

    public function insert($nom,$categorieParent){
        $sql = "INSERT INTO souscategorie (nom,categorie_id) VALUES (?,?)";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array( $nom,$categorieParent));

        return true;
    }

    public function readSousCategorie(){
        $data = array();
        $sql = 'SELECT souscategorie.id, souscategorie.nom, categorie.nom AS category FROM souscategorie LEFT JOIN categorie ON souscategorie.categorie_id = categorie.id ORDER BY souscategorie.id ASC'; 
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }

    public function readCategorie(){
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
    
    public function totalCategorie(){
        $sql = "SELECT * FROM categorie ";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $totalCategorie = $stmt->rowCount();

        return $totalCategorie;
    }

    public function getsouscategorieById($id){
        $sql = "SELECT souscategorie.id, souscategorie.nom, categorie.nom AS category , categorie_id FROM souscategorie LEFT JOIN categorie ON souscategorie.categorie_id = categorie.id where souscategorie.id =?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($id));
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function update($nom,$categorieParent,$id){
        $sql = "UPDATE souscategorie SET nom =?, categorie_id=? WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($nom,$categorieParent,$id));

        return true;
    }

    public function delete($id){
        $sql = "DELETE FROM souscategorie WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array( $id));

        return true;
    }

    public function totalsouscategorie(){
        $sql = "SELECT * FROM souscategorie ";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $total = $stmt->rowCount();

        return $total;
    }  
}
    
?>