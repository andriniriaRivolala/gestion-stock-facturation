
<?php
    require '../db.php';
     
    //Function de verification
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }
    
    //on initialise nos messages d'erreurs; 
    $nom = $prenom = $address =  $tel = $email  = $codepostal = "";
    $nomError = $prenomError = $addressError = $telError = $emailError = $codepostalError = "";
    
    if(isset($_POST['submit'])){ 

        // on recupère nos valeurs avec des testes 
        $nom = test_input($_POST['nom']); 
        $prenom = test_input($_POST['prenom']); 
        $address = test_input($_POST['address']); 
        $tel = test_input($_POST['tel']); 
        $email = test_input($_POST['email']);
        $codepostal = test_input($_POST['codepostal']);

        // on vérifie nos champs 
        $Valid = true; 
        $UploadValid = false; 
        
        if (empty($nom)) { 
            $nomError = 'Ce champs ne peut pas être vide';
            $valid = false;
        }
        
        if(empty($prenom)){
             $prenomError ='Ce champs ne peut pas être vide'; 
             $valid= false; 
        } 

        if(empty($address)){ 
            $addressError ='Ce champs ne peut pas être vide'; 
            $valid= false; 
        } 
        
        if (empty($email)) { 
            $emailError = 'Ce champs ne peut pas être vide';
            $valid = false; 
        } 
        
        if (empty($tel)) {
            $telError = 'Ce champs ne peut pas être vide';
            $valid = false; 
        }

        if (empty($codepostal)) {
            $codepostalError = 'Ce champs ne peut pas être vide';
            $valid = false; 
        }

        // si les données sont présentes et bonnes, on se connecte à la base 
        if ($Valid ) {
            $db = new Database; 
            $db = Database::connect(); 
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO client ( nom, prenom, email, address, tel,codepostal) VALUES (?, ?, ?, ? , ? , ? )";
            $stmt = $db->prepare($sql);
            $stmt->execute(array( $nom , $prenom, $email, $address, $tel, $codepostal));
            Database::disconnect();
            header('location:../client.php');
        }
    }
 
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
                    <h4 class="text-md text-success" >Ajouter un client</h4>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" 
                        enctype="multipart/form-data" id="addform" class="was-validated">
                    <div class="row">
                        <div class="col-md-6">
                            <!--Nom-->
                            <label class="text-white" for="nom">Nom :</label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user fa-sm"></i>
                                    </span>
                                </div>
                                <input type="text" id="nom" name="nom" class="form-control" minlength="2" placeholder="Votre nom "
                                    value="<?php echo $nom; ?>" required>
                            </div>
                            <div class="valid-feedback"></div>
                            <span class="text-danger"><?php echo $nomError; ?></span>

                            <!--Prenom-->
                            <label  class="text-white" for="prenom">Prénom :</label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user fa-sm"></i>
                                    </span>
                                </div>
                                <input type="text" id="prenom" name="prenom" minlength="2" class="form-control" placeholder="Votre prénom " 
                                value="<?php echo $prenom; ?>" required>
                            </div>
                            <div class="valid-feedback"></div>
                            <span class="text-danger"><?php echo $prenomError; ?></span>
                        </div>

                        <div class="col-md-6">
                            <!--Email-->
                            <label  class="text-white" for="email">Email :</label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope fa-sm"></i>
                                    </span>
                                </div>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Votre email "
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $email; ?>" required>
                            </div>
                            <div class="valid-feedback"></div>
                            <span class="text-danger"><?php echo $emailError; ?></span>

                            <!--Password-->
                            <label  class="text-white" for="address"> Adresse :</label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt fa-sm"></i>
                                    </span>
                                </div>
                                <input type="text" id="address" name="address" minlength="2" class="form-control" placeholder="Votre adresse "
                                value="<?php echo $address; ?>" required>
                            </div>
                            <div class="valid-feedback"></div>
                            <span class="text-danger"><?php echo $addressError; ?></span>
                        </div>

                        <div class="col-md-6">
                            <!--Phone-->
                            <label  class="text-white" for="tel">Phone :</label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone-alt fa-sm"></i>
                                    </span>
                                </div>
                                <input type="tel" id="tel" name="tel" pattern="([+])[0-9].{7,}"  maxlength="13" class="form-control" placeholder="Votre télephone"
                                value="<?php echo $tel; ?>" title="Contient + et des nombres" required>
                            </div>
                            <div class="valid-feedback"></div>
                            <span class="text-danger"><?php echo $telError; ?></span>
                        </div>
                        <div class="col-md-6">    
                            <!--Codepostal-->
                            <label  class="text-white" for="codepostal">Codepostal :</label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone-alt fa-sm"></i>
                                    </span>
                                </div>
                                <input type="text" id="codepostal" name="codepostal" pattern="([0-9].{2,})" maxlength="6" class="form-control" placeholder="Votre code postal"
                                value="<?php echo $codepostal; ?>" required>
                            </div>  
                        </div>
                    </div>
                    <div class="d-flex justify-content-around">
                        <a href="../client.php" class="btn btn-outline-secondary my-3 mr-3 btn-block">Retour</a>
                        <button type="submit" name="submit" class="btn btn-outline-success  my-3 ml-3 btn-block">Ajouter</button>
                    </div>
                </form>   
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