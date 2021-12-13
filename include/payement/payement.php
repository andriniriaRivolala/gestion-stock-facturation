<?php

class payement{
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

    public function readPayement(){
        $data = array();
        $sql = 'SELECT payment.id, payment.date, payment.facture_id As factureId,
         client.nom AS client, payment.total AS total, facture.commande_valider_id AS commandeValiderId 
         FROM payment 
         LEFT JOIN facture ON payment.facture_id = facture.id 
         LEFT JOIN commande_valider ON facture.commande_valider_id = commande_valider.id 
         LEFT JOIN client ON commande_valider.client_id = client.id 
         LEFT JOIN produit ON commande_valider.produit_id = produit.id 
         ORDER BY payment.id DESC';

        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }

    public function getPayementById($id){
        $sql = "SELECT * FROM payment WHERE id=?";

        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    
    public function totalPayement(){
        $total=0;
        $sql = "SELECT * FROM payment";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $total = $stmt->rowCount();

        return $total;
    }  
}

?>
