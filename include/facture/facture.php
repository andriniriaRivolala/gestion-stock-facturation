<?php

class facture{
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

    public function readFacture(){
        $data = array();
        $sql = 'SELECT  DISTINCT facture.id, facture.date,facture.payer AS payer, client.nom AS client, produit.nom AS produitNom,
        produit.prix AS PU, commande_valider.id AS commandeValiderId,commande_valider.quantite AS quantite, commande_valider.total AS total
        FROM facture 
        LEFT JOIN commande_valider ON facture.commande_valider_id = commande_valider.id
        LEFT JOIN client ON commande_valider.client_id = client.id
        LEFT JOIN produit ON commande_valider.produit_id = produit.id
        ORDER BY facture.id DESC'; 

        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }

    public function getFactureById($id){
        $sql = 'SELECT facture.id As factureId, facture.date AS factureDate, 
        client.nom AS clientNom, client.prenom As clientPrenom, client.tel As clientTel, 
        client.address AS clientAddress, client.email As clientEmail, 
        produit.nom AS produitNom, produit.prix AS PU,
        commande_valider.id AS commandeValiderId, commande_valider.quantite AS commandeQuantite, commande_valider.total AS commandeTotal 
        FROM facture 
        LEFT JOIN commande_valider ON facture.commande_valider_id = commande_valider.id 
        LEFT JOIN client ON commande_valider.client_id = client.id 
        LEFT JOIN produit ON commande_valider.produit_id = produit.id WHERE facture.id=?';

        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function delete($id){
        $sql = "DELETE FROM facture WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array( $id));

        return true;
    }

    public function totalFacture(){
        $sql = "SELECT * FROM facture";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $total = $stmt->rowCount();

        return $total;
    }  

    public function insertpayement($id){
        $data = array();

        $sql1 = "SELECT facture.id As factureId, facture.date AS factureDate, 
        facture.commande_valider_id As commandeValiderId, commande_valider.total As total
        FROM facture 
        LEFT JOIN commande_valider ON facture.commande_valider_id = commande_valider.id 
        WHERE facture.id = ?";
        $stmt1 = self::$conn->prepare($sql1);
        $stmt1->execute(array($id));
        $result= $stmt1->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $row){
            $data[] = $row;
        }

        $sql2 = "UPDATE facture SET payer=1 WHERE id=?";
        $stmt2 = self::$conn->prepare($sql2);
        $stmt2->execute(array($id));

        $date = $row['factureDate'];
        $idFacture = $row['factureId'];
        $idCommande_valider_id = $row['commandeValiderId'];
        $total = $row['total'];

        $sql3 = "INSERT INTO payment (date,facture_id,total) VALUES (?,?,?)";
        $stmt = self::$conn->prepare($sql3);
        $stmt->execute(array($date,$idFacture,$total));

        $lastId = self::$conn->lastInsertId();

        return $lastId; 
    }
}
    
?>