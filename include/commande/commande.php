<?php

class commande{
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


    public function insert($date,$client,$produit,$quantite,$PU){
        $sql = "INSERT INTO commande (date,client_id,produit_id,quantite,total) VALUES (?,?,?,?,?)";
        $stmt = self::$conn->prepare($sql);
        $total= $quantite*$PU;
        $stmt->execute(array( $date,$client,$produit,$quantite,$total));

        return true;
    }

    public function readCommmande($client){
        $data = array();
        $sql = 'SELECT commande.id As id, client.nom AS client, produit.nom AS nom,produit.prix AS prix,commande.date AS date,commande.quantite AS quantite,commande.total AS total
        FROM commande 
        LEFT JOIN client ON commande.client_id = client.id
        LEFT JOIN produit ON commande.produit_id = produit.id
        WHERE  commande.client_id = '.$client.''; 

        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }

    public function readCommmandeValider($client){
        $data = array();
        $sql = 'SELECT commande_valider.id, commande_valider.date,commande_valider.facturer As facturer, client.nom AS client, produit.nom AS nom,
        produit.prix AS PU, commande_valider.quantite AS quantite, commande_valider.total AS total
        FROM commande_valider
        LEFT JOIN client ON commande_valider.client_id = client.id
        LEFT JOIN produit ON commande_valider.produit_id = produit.id
        WHERE  commande_valider.client_id = ? ORDER BY commande_valider.id DESC';

        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($client));
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }
    
    public function readClientCommande(){
        $data = array();
        $sql = 'SELECT DISTINCT commande.client_id, client.nom, client.prenom FROM commande LEFT JOIN client ON commande.client_id = client.id'; 
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }

    public function readClientCommandeValider(){
        $data = array();
        $sql = 'SELECT DISTINCT commande_valider.client_id, client.nom As nom, client.prenom As prenom FROM commande_valider LEFT JOIN client ON commande_valider.client_id = client.id'; 
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }

    public function readClient(){
        $data = array();
        $sql = 'SELECT * FROM client ORDER BY id ASC'; 
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }
    
    public function totalClient(){
        $sql = "SELECT * FROM client ";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $total = $stmt->rowCount();

        return $total;
    }

    public function getCommandeById($id){
        $sql = "SELECT commande.id, client.nom AS client, produit.nom AS produit,produit.stock As stock,commande.date,commande.quantite,commande.total
         FROM commande 
         LEFT JOIN client ON commande.client_id = client.id
         LEFT JOIN produit ON commande.produit_id = produit.id
         WHERE commande.id =?";

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

    public function update_CommandeEnAttente($clientId,$produitId,$quantite,$id){
        $sql = "UPDATE commande SET client_id =?, produit_id=? quantite=? WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($clientId,$produitId,$quantite,$id));

        return true;
    }

    public function delete($id){
        $sql = "DELETE FROM commande WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array( $id));

        return true;
    }

    public function insertCommandeValider($id){
        $data = array();
        //selectionner le donné des commandes
        $sql1 = "SELECT*FROM commande WHERE id = ?";
        $stmt = self::$conn->prepare($sql1);
        $stmt->execute(array($id));
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $row){
            $data[] = $row;
        }
        $date = $row['date'];
        $idClient = $row['client_id'];
        $idProduit = $row['produit_id'];
        $quantite = $row['quantite'];
        $total = $row['total'];

        //trouver le stock du produit
        $sql2 = "SELECT*FROM produit WHERE id = {$idProduit}";
        $stmt = self::$conn->prepare($sql2);
        $stmt->execute();
        $result2= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result2 as $row){
            $data[] = $row;
        }
        $stock = $row['stock'];

        //update de rester stock 
        $reste = $stock - $quantite;
        $sql3 = "UPDATE produit SET stock={$reste} WHERE id = {$idProduit}";
        $stmt = self::$conn->prepare($sql3);
        $stmt->execute();

        $facturer= 0;
        $sql3 = "INSERT INTO commande_valider (date,client_id,produit_id,quantite,total,facturer) VALUES (?,?,?,?,?,?)";
        $stmt = self::$conn->prepare($sql3);
        $stmt->execute(array($date,$idClient,$idProduit,$quantite,$total,$facturer));

        $lastId = self::$conn->lastInsertId();

        return $lastId; 
    }

    //update de stock rester
    public function updateStock($reste,$id){
        $sql = "UPDATE produit SET stock=? WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($reste,$id));

        return true;
    }

    public function insertFacture($dateValider,$commandeValiderId){
        $payer = 0;
        $sql = "INSERT INTO facture (date, commande_valider_id, payer) VALUES (?,?,?)";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($dateValider,$commandeValiderId,$payer));

        $sql2 = "UPDATE commande_valider SET facturer=1 WHERE id = ?";
        $stmt2 = self::$conn->prepare($sql2);
        $stmt2->execute(array($commandeValiderId));

        return true;
    }

    public function totalCommande(){
        $sql = "SELECT * FROM commande";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $total = $stmt->rowCount();

        return $total;
    } 
    
    
    public function totalCommandeValider(){
        $sql = "SELECT * FROM commande_valider";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $total = $stmt->rowCount();

        return $total;
    }
}
    
?>