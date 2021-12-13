<?php

class produit{
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

    /**
     *  Ajouter un produit
     * @param array $data
     * @return int $lastInsertedId
     */ 
    public function ajouter($data){
        if(!empty($data)){
            $fields = $placeholders = [];
            foreach($data as $field=>$value){
                  $fields[] = $field;
                  $placeholders[] = ":{$field}";
            }
        }
        //MYSQL INSERT LES DONES
        $sql = "INSERT INTO produit (". implode(',',$fields). ") VALUES  
        (".implode(',',$placeholders).")";
       
        $stmt = self::$conn->prepare($sql);

        try{
            //Transaction des donnés
            self::$conn->beginTransaction();
             $stmt->execute($data);

            //Enregistrer le dernier Id
            $lastInsertedId = self::$conn->lastInsertId();
            self::$conn->commit();

            return $lastInsertedId;

        }catch(PDOException $e){
             echo "Error :". $e->getMessage();
             //revenir le connection
             self::$conn->rollBack();

        }

    }

    /**
    * fonction telecharger un photo
    * @param array $file
    * @return string $newFileName
    */
    public function uploadPhoto($file){

        $fileTempPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];
       
        $fileNameCmps = explode('.',$fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtn = ["jpg","png","gif","jpeg"];
       
        if(in_array($fileExtension, $allowedExtn)){
            $uploadFileDir = getcwd().'/uploads/';
            $destFilePath = $uploadFileDir.$fileName;
            if(move_uploaded_file($fileTempPath, $destFilePath)){
                
                return $fileName;
            }
        }
    }

    /**
    * fonction read Produit
    * @return array $data
    */
    public function readProduit(){
        $data = array();
        $sql = 'SELECT * FROM produit ORDER BY id ASC'; 
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }
    
    /**
    * fonction total Produit
    *@return int $total
    */
    public function totalProduit(){
        $sql = "SELECT * FROM produit ";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $total = $stmt->rowCount();

        return $total;
    }  
    
    /**
    * fonction read Fournisseur
    * @return array $data
    */
    public function readFournisseur(){
        $data = array();
        $sql = 'SELECT * FROM fournisseur ORDER BY id ASC'; 
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }

    /**
    * fonction total Fournisseur
    *@return int $total
    */
    public function totalFournisseur(){
        $sql = "SELECT * FROM fournisseur ";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $totalFournisseur = $stmt->rowCount();

        return $totalFournisseur;
    }

    /**
    * fonction read Categorie
    * @return array $data
    */
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

    /**
    * fonction total Categorie
    *@return int $total
    */
    public function totalCategorie(){
        $sql = "SELECT * FROM categorie ";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $totalCategorie = $stmt->rowCount();

        return $totalCategorie;
    }

    /**
    * fonction read souscategorie
    * @return array $data
    */
    public function readSouscategorie(){
        $data = array();
        $sql = 'SELECT * FROM souscategorie ORDER BY id ASC'; 
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }

        return $data;
    }

    /**
    * fonction total souscategorie
    *@return int $total
    */
    public function totalSouscategorie(){
        $sql = "SELECT * FROM souscategorie ";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $totalSouscategorie = $stmt->rowCount();

        return $totalSouscategorie;
    }

    /**
    * fonction read produit par id
    * @param int $id
    * @return array $result
    */
    public function getProduitById($id){
        $sql = 'SELECT produit.id,produit.nom,produit.image,produit.prix,produit.stock,
                produit.fournisseur_id AS idFournisseur,fournisseur.nom AS fournisseur,
                produit.categorie_id AS idCategorie,categorie.nom AS categorie,
                produit.souscategorie_id AS idSouscategorie,souscategorie.nom AS souscategorie,
                produit.description,produit.date
                FROM produit
                LEFT JOIN fournisseur ON produit.fournisseur_id = fournisseur.id
                LEFT JOIN categorie ON produit.categorie_id = categorie.id
                LEFT JOIN souscategorie ON produit.souscategorie_id = souscategorie.id
                WHERE produit.id=?';
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($id));
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * fonction  modifier un produit
     * @param array $id
     * @param array $data
     */  
    public function update($data,$id){
        if(!empty($data)){
            $fields = '';
            $x = 1;
            $fieldsCount = count($data);
            foreach($data as $field=>$value){
                $fields .=  "{$field}=:{$field}";
                if($x < $fieldsCount){
                    $fields .= ",";
                }
                $x++;
            }
        }
        //SQL UPDATE LES DONES
        $sql = "UPDATE produit SET {$fields} WHERE id = :id";

        $stmt = self::$conn->prepare($sql);

        try{
            //Transaction des donnés
            self::$conn->beginTransaction();
             $data['id'] = $id;
             $stmt->execute($data);
             self::$conn->commit();

             return true;

        }catch(PDOException $e){
             echo "Error :". $e->getMessage();
             //revenir le connection
             self::$conn->rollBack();
        }
    }

    /**
    * fonction read produit par id
    * @param int $id
    */
    public function delete($id){
        $uploadFileDir = getcwd().'/uploads/'; 
        $sql = "SELECT * FROM produit where id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $image = $row['image'];
        unlink( $uploadFileDir.$image);

        $sql = "DELETE FROM produit WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array( $id));

        return true;
    }

    /**
    * fonction read un filtre produit par nom 
    * @param string $text
    * @return array $results
    */
    public function searchNom($text){
        $sql = "SELECT * FROM produit WHERE nom LiKE :search ORDER BY id DESC";   
        
        $stmt = self::$conn->prepare($sql);
        $stmt->execute([':search' => "%{$text}%"]);

        if($stmt->rowCount() > 0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $results = [];
        }

        return $results;
    }

    /**
    * fonction read un filtre produit ayant prix inferieur 
    * @param int $prix
    * @return array $results
    */
    public function searchPrix($prix){
        $sql = "SELECT * FROM produit WHERE prix <= :search ORDER BY id DESC";   
        
        $stmt = self::$conn->prepare($sql);
        $stmt->execute([':search' => "{$prix}"]);

        if($stmt->rowCount() > 0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $results = [];
        }

        return $results;
    }

     /**
    * fonction read un filtre produit ayant le fournisseur 
    * @param array $id
    * @return array $results
    */
    public function searchFournisseur($id){
    
        $sql = "SELECT * FROM produit WHERE fournisseur_id = ? ORDER BY id DESC";   
        
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($id));

        if($stmt->rowCount() > 0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $results = [];
        }

        return $results;
    }

       /**
    * fonction read un filtre produit ayant le categorie
    * @param array $id
    * @return array $results
    */
    public function searchCategorie($id){
    
        $sql = "SELECT * FROM produit WHERE categorie_id = ? ORDER BY id DESC";   
        
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($id));

        if($stmt->rowCount() > 0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $results = [];
        }

        return $results;
    }

       /**
    * fonction read un filtre produit ayant le souscategorie
    * @param array $id
    * @return array $results
    */
    public function searchSouscategorie($id){
    
        $sql = "SELECT * FROM produit WHERE souscategorie_id = ? ORDER BY id DESC";   
        
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array($id));

        if($stmt->rowCount() > 0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $results = [];
        }

        return $results;
    }
}
    
?>