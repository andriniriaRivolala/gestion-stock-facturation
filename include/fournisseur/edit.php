
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

    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id']; 
    } 

    if ( null==$id ) {
        header("Location: ../fournisseur.php"); 
    } 

    // on initialise nos erreurs 
    $nomError = null; $prenomError = null; $addressError = null; $telError = null; $emailError = null; $imageError = null; 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        
        // On assigne nos valeurs 
         // on recupère nos valeurs avec des testes 
         $nom = test_input($_POST['nom']); 
         $prenom = test_input($_POST['prenom']); 
         $address = test_input($_POST['address']); 
         $tel = test_input($_POST['tel']); 
         $email = test_input($_POST['email']);
    
        // On initialise les variables 
        $valid = true;

        // On verifie que les champs sont remplis
        if (empty($nom)) { 
            $nomError = 'Please enter Name'; 
            $valid = false; 
        } 
        
        if (empty($prenom)) { 
            $prenomError = 'Please enter prenom'; 
            $valid = false; 
        } 
        
        if (empty($email)) { 
            $emailError = 'Please enter Email Address'; 
            $valid = false; 
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            $emailError = 'Please enter a valid Email Address'; 
            $valid = false; 
        } 
        
        if (empty($tel)) { 
            $telError = 'Please enter phone'; 
            $valid = false; 
        } 
        
        $image = test_input($_FILES['image']['name']);
        $imageSize = $_FILES['image']['size']; 
        $imageTmp = $_FILES['image']['tmp_name'];
        $imagePath = 'uploads/'.basename($image); 
        //Chemin complet d'image
        $imageExt = pathinfo($imagePath, PATHINFO_EXTENSION); 

        // On initialise les variables 
        $updateImage = false; 
        $UploadValid = false;

        if(empty($image)){
            //Pas de update image
            $updateImage = false;
        }else{
            $UploadValid = true;
            $updateImage = true;
            //il y a un update image
            $allowExt  = array('jpeg','JPEG', 'jpg','JPG', 'png', 'PNG', 'gif','GIF');;
			
            // on vérifie l'extansion du  fichier
            if(!in_array($imageExt, $allowExt)){
                $imageError = 'Enter un vrai image';
                $UploadValid = false;
            }
			
            // on vérifie l'existance du  fichier
            if(file_exists($imagePath)){
                $imageError = 'Le fichier existe deja';
                $UploadValid = false;
            }
            
            // on vérifie la taille  fichier
            if( $imageSize > 5000000){
                $imageError = 'Le fichier ne doit pas être passer de 5Mo';
                $UploadValid = false;
            }
            
            // on vérifie le techargement du fichier
            if($UploadValid){
               if( !move_uploaded_file($imageTmp ,$imagePath)){
                    $imageError = 'Il y a une erreur lors de telechargement';
                    $UploadValid = false;
                }
            }
        }
		

        // mise à jour des donnés 
        if (($valid && $updateImage && $UploadValid) || ($valid && !$updateImage)) { 
            $db = Database::connect(); 
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            if($updateImage){
                $sql = "UPDATE fournisseur SET logo =?, nom =?, prenom =?, address =?, email =?, tel =? WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute(array($image, $nom, $prenom, $address,  $email, $tel, $id));
            }else{
                $sql = "UPDATE fournisseur SET nom =?, prenom =?, address =?, email =?, tel =? WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute(array($nom, $prenom, $address,  $email, $tel, $id));
            }
            
            Database::disconnect();
            header("Location: ../fournisseur.php"); 
        }else if($updateImage && !$UploadValid){
            $db = Database::connect();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            $sql = "SELECT image FROM fournisseur where id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $image =  $row['logo'];

            Database::disconnect();
            
        }

    //Pas de submit
    }else {
        $db = Database::connect();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
        $sql = "SELECT * FROM fournisseur where id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $nom =  $row['nom'];
        $prenom =  $row['prenom'];
        $address =  $row['address'];
        $tel =  $row['tel'];
        $email =  $row['email'];
        $image =  $row['logo'];
       
        Database::disconnect();
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
                        <h4 class="text-md text-primary" >Modifier un fournisseur</h4>
                    </div>
                    <form action="<?php echo 'edit.php?id='.$id;?>" method="POST" 
                         enctype="multipart/form-data" id="addform" class="was-validated">
                        <div class="row">
                            <div class="col-md-6">
                               <!--Imtel-->
                               <img src="uploads/<?php echo $image ?>"  class="rounded mx-auto d-block my-2" width="200" height="200">
                               <h6 class="text-white text-center">
                                Logo : <?php echo $row['logo']; ?>
                               </h6>
                               <!--Photo-->
                               <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-file fa-sm"></i>
                                        </span>
                                    </div>
                                    <div class="custom-file">
                                        <input  type="file"class="custom-file-input" name="image" id="image">
                                        <label class="custom-file-label" for="customfile">Selectionner un image</label>
                                    </div>
                                </div>
                                <div class="valid-feedback"></div>
                                <span class="text-danger"><?php echo $imageError; ?></span>
                            </div>
   
                            <div class="col-md-6">
                                  <!--Nom-->
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user fa-sm"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="nom" name="nom" minlength="2" class="form-control" placeholder="Votre nom "
                                    value="<?php echo $nom; ?>">
                                </div>
                                <div class="valid-feedback"></div>
                                <span class="text-danger"><?php echo $nomError; ?></span>

                                <!--Prenom-->
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user fa-sm"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="prenom" name="prenom" minlength="2" class="form-control" placeholder="Votre prénom " 
                                    value="<?php echo $prenom; ?>">
                                </div>
                                <div class="valid-feedback"></div>
                                <span class="text-danger"><?php echo $prenomError; ?></span>
                               
                                <!--Email-->
                                <div class="input-group mb-1">
                                   <div class="input-group-prepend">
                                       <span class="input-group-text">
                                            <i class="fas fa-envelope fa-sm"></i>
                                       </span>
                                   </div>
                                   <input type="email" id="email" name="email" class="form-control" placeholder="Votre email"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $email; ?>" >
                                </div>
                                <div class="valid-feedback"></div>
                                <span class="text-danger"><?php echo $emailError; ?></span>
                                
                                <!--address-->
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                             <i class="fas fa-map-marker-alt fa-sm"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="address" name="address" minlength="2" class="form-control" placeholder="Votre address "
                                    value="<?php echo $address; ?>" required>
                                </div>
                                <div class="valid-feedback"></div>
                                <span class="text-danger"><?php echo $addressError; ?></span>
                           
                                <!--Phone-->
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone-alt fa-sm"></i>
                                        </span>
                                    </div>
                                    <input type="tel" id="tel" name="tel"  pattern="([+])[0-9].{7,}"  maxlength="13" class="form-control" placeholder="Votre télephone"
                                    value="<?php echo $tel; ?>" title="Contient + et des nombres">
                                </div>
                                <div class="valid-feedback"></div>
                                <span class="text-danger"><?php echo $telError; ?></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                             <a href="../fournisseur.php" class="btn btn-outline-secondary my-3 mr-3 btn-block">Retour</a>
                             <button type="submit" name="submit" class="btn btn-outline-danger  my-3 ml-3 btn-block">Modifier</button>
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
        
         //Visibilite de mot de passe
         function visibilite() {
            var x = document.getElementById("address");
            var y = document.getElementById("icon");
            if (x.type === "address") {
                x.type = "text";
                y.classList = "text-dark fas fa-eye-slash";
            } else {
                x.type = "address";
                y.classList = "text-dark fas fa-eye";
            }
        }

</script>
    
</body>
</html> 