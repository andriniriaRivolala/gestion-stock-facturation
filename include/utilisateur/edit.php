
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
        header("Location: ../utilisateur.php"); 
    } 

    // on initialise nos erreurs 
    $nomError = null; $prenomError = null; $passwordError = null; $telError = null; $emailError = null; $imageError = null; 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        
        // On assigne nos valeurs 
         // on recupère nos valeurs avec des testes 
         $nom = test_input($_POST['nom']); 
         $prenom = test_input($_POST['prenom']); 
         $password = test_input($_POST['password']); 
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
                $sql = "UPDATE utilisateur SET image =?, nom =?, prenom =?, password =?, email =?, tel =? WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute(array($image, $nom, $prenom, $password,  $email, $tel, $id));
            }else{
                $sql = "UPDATE utilisateur SET nom =?, prenom =?, password =?, email =?, tel =? WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute(array($nom, $prenom, $password,  $email, $tel, $id));
            }
            
            Database::disconnect();
            header("Location: ../utilisateur.php"); 
        }else if($updateImage && !$UploadValid){
            $db = Database::connect();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            $sql = "SELECT image FROM utilisateur where id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $image =  $row['image'];

            Database::disconnect();
            
        }

    //Pas de submit
    }else {
        $db = Database::connect();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
        $sql = "SELECT * FROM utilisateur where id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $nom =  $row['nom'];
        $prenom =  $row['prenom'];
        $password =  $row['password'];
        $tel =  $row['tel'];
        $email =  $row['email'];
        $image =  $row['image'];
       
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
    <script src="../../js/style/fontawesome.min.js"></script>  

</head>

<body class="bg-dark">
    <div class="container">
        <div class="card bg-dark border border-white mx-auto mt-5 ">
                <!--card body-->
                <div class="card-body">
                    <div class="text-center mb-2">
                        <h4 class="text-md" style="color:#ff9700;">Modifier un utilisateur</h4>
                    </div>
                    <form action="<?php echo 'edit.php?id='.$id;?>" method="POST" 
                         enctype="multipart/form-data" id="addform" class="was-validated">
                        <div class="row">
                            <div class="col-md-6">
                               <!--Imtel-->
                               <img src="uploads/<?php echo $image ?>"  class="rounded mx-auto d-block my-2" height="200">
                               <h6 class="text-white text-center">
                                Image : <?php echo $row['image']; ?>
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
                                <!--Password-->
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                             <i class="fab fa-expeditedssl fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Au moins 8 caractères contient un chiffre et une lettre majuscule et minuscule ."class="form-control" placeholder="Votre password "
                                    value="<?php echo $password; ?>" >
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                           <a href="#" onclick="visibilite()"><i class=" text-dark fas fa-eye" id="icon"></i></a>
                                        </span>
                                    </div>
                                </div>
                                <div class="valid-feedback"></div> 
                                <span class="text-danger"><?php echo $passwordError; ?></span>
                           
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
                             <a href="../utilisateur.php" class="btn btn-outline-warning my-3 mr-3 btn-block">Retour</a>
                             <button type="submit" name="submit" class="btn btn-outline-danger  my-3 ml-3 btn-block">Modifier</button>
                        </div>
                    </form>   
                </div>
            </div> 
        </div> 
    </div>

     <!--LIBRARY JS-->
     <!-- jQuery library -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <!--CODE JQUERY-->
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        
         //Visibilite de mot de passe
         function visibilite() {
            var x = document.getElementById("password");
            var y = document.getElementById("icon");
            if (x.type === "password") {
                x.type = "text";
                y.classList = "text-dark fas fa-eye-slash";
            } else {
                x.type = "password";
                y.classList = "text-dark fas fa-eye";
            }
        }

</script>
    
</body>
</html> 