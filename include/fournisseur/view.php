
<?php
    require '../db.php';
    
    //Function de verification
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }
     
    $id = null;

    if(!empty($_GET['id'])){
        $id = test_input($_GET['id']);
    }

       if (null == $id) {
         header("location:../fournisseur.php"); 
    } else { 
        //on lance la connection et la requete 
        $db = Database ::connect(); 
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
        $sql = "SELECT * FROM fournisseur where id =?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }

    Database::disconnect();
    

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
                        <h4 class="text-md text-capitalize" style="color:#ff9700;"><?php echo $row['nom'] ?> <?php echo $row['prenom'] ?></h4>
                    </div>
                    <div class="row">
                <div class="col-md " >
                    <img src="uploads/<?php echo $row['logo']; ?>"  class="rounded mx-auto d-block my-2" width="200" height="200">
                </div>
                <div class="col-md">
                    <h5 class="form-control my-2"><i class="fas fa-user"></i>
                      <span class="text-wite "><?php echo ' '. $row['nom'] ?></span>
                    </h5>
                    <h5 class="form-control my-2"><i class="fas fa-user"></i>
                      <span class="text-dark"><?php echo ' ' . $row['prenom'] ?></span>
                    </h5>
                    <h5 class="form-control my-2"><i class="fas fa-map-marker-alt"></i>
                      <span class="text-dark"><?php echo ' ' . $row['address'] ?></span>
                    </h5>
                    <h5 class="form-control my-2"><i class="fas fa-phone-alt"></i>
                      <span class="text-wite"><?php echo ' ' . $row['tel'] ?></span>
                    </h5>
                    <h5 class="form-control my-2"><i class="fa fa-envelope"></i>
                      <span class="text-wite"><?php echo ' ' . $row['email'] ?></span>
                    </h5>

                      <a class="btn btn-outline-danger d-block my-1" href="../fournisseur.php"><i class="fa fa-sign-out-alt"></i><span>Retour</span></a>

                </div>
              </div>
                </div>
            </div> 
        </div> 
    </div>

     <!--LIBRARY JS-->
    <script src="style/js/bootstrap.min.js"></script>
    <script  src="../../js/style/jquery.min.js"></script>
    <script src="style/js/popper.min.js"></script>
    <script src="../../js/style/fontawesome.min.js"></script>  
    
    <!--CODE JQUERY-->
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
</script>
    
</body>
</html> 