<?php
    require '../db.php';
    $upload_dir = 'uploads/';
    
    //Function de verification
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }

    if(!empty($_GET['id'])){
        $id = test_input($_GET['id']);
    }

    if(!empty($_POST)){
        $id = test_input($_POST['id']);

        $db = new Database; 
        $db = Database::connect(); 
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "SELECT * FROM fournisseur where id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $image = $row['logo'];
        unlink($upload_dir.$image);

        $sql = "DELETE FROM fournisseur WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array( $id));
        Database::disconnect();
        header('location:../fournisseur.php');
    }

     //on initialise nos messages d'erreurs;
?> 
<!DOCTYPE html>
<html>
<head>
   <title>Gestion de stock et facturation</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <link rel="stylesheet" href="../../css/bootstrap.min.css">
   
    <!--LINK HEADER PRINCIPAL-->
    <link rel="stylesheet" href="css/position.css">
    <script src="js/script.js"></script>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="card bg-dark border border-white mx-auto mt-5">
                <!--card body-->
                <div class="card-body">
                    <div class="text-center mb-2">
                        <h4 class="text-md text-primary">Supprimer un fournisseur</h4>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"> 
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <p class="alert alert-warning">Etes-vous sur de vouloir supprimer ?</p>
                        <div class="">
                            <a href="../fournisseur.php" class="btn btn-outline-secondary">Non</a>
                            <button type="submit" name="delete" class="btn btn-outline-danger">Oui</button>
                        </div>
                    </form>   
                </div>
            </div> 
        </div> 
    </div>

     <!--LIBRARY JS-->
    <script src="../../style/js/bootstrap.min.js"></script>
    <script  src="../../js/style/jquery.min.js"></script>
    <script src="../../style/js/popper.min.js"></script>
    <script src="../../js/style/fontawesome.min.js"></script>  
 
</body>
</html> 