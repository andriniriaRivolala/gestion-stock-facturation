
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
    $nom = $prenom = $password =  $tel = $email = $image = "";
    $nomError = $prenomError = $passwordError = $telError = $emailError = $imageError = "";
    
    if(isset($_POST['submit'])){ 

        // on recupère nos valeurs avec des testes 
        $nom = test_input($_POST['nom']); 
        $prenom = test_input($_POST['prenom']); 
        $password = test_input($_POST['password']); 
        $tel = test_input($_POST['tel']); 
        $email = test_input($_POST['email']);

        $image = test_input($_FILES['image']['name']);
        $imageSize = $_FILES['image']['size']; 
        $imageTmp = $_FILES['image']['tmp_name'];
        $imagePath = 'uploads/'.basename($image); 
        //Chemin complet d'image
        $imageExt = pathinfo($imagePath, PATHINFO_EXTENSION);

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

        if(empty($password)){ 
            $passwordError ='Ce champs ne peut pas être vide'; 
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
        
        if(empty($image)){
            $image = 'Ce champs ne peut pas être vide';
            $UploadValid = false; 
        }else{
            $UploadValid = true;
            $allowExt  = array('jpeg','JPEG', 'jpg','JPG', 'png', 'PNG', 'gif','GIF');
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
       

        // si les données sont présentes et bonnes, on se connecte à la base 
        if ($Valid && $UploadValid) {
            $db = new Database; 
            $db = Database::connect(); 
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO utilisateur (image, nom, prenom, password, email, tel) VALUES (?, ?, ?, ? , ? , ? )";
            $stmt = $db->prepare($sql);
            $stmt->execute(array( $image , $nom , $prenom, $password, $email, $tel));
            Database::disconnect();
            header('location:../accueil.php');
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
    <script src="../../js/style/fontawesome.min.js"></script>  

</head>

<body class="bg-dark">
    <div class="container mb-3">
        <div class="card bg-dark justify-content-center mx-auto  border border-white mt-5">
                <!--card body-->
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="text-md" style="color:#ff9700;">Ajouter un utilisateur</h4>
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
                                    <input type="text" id="nom" name="nom" minlength="2" class="form-control" placeholder="Votre nom "
                                    value="<?php echo $nom; ?>" required>
                                </div>
                                <div class="valid-feedback"></div>

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
                                   <input type="email" id="email" name="email" class="form-control" placeholder="Votre email"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $email; ?>" required >
                                </div>
                                <div class="valid-feedback"></div>
                                <span class="text-danger"><?php echo $emailError; ?></span>
                                <!--Password-->
                                <label  class="text-white" for="password">Mot de passe :</label>
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                             <i class="fab fa-expeditedssl fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Au moins 8 caractères contient un chiffre et une lettre majuscule et minuscule ."class="form-control" placeholder="Votre password "
                                    value="<?php echo $password; ?>" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                           <a href="#" onclick="visibilite()"><i class=" text-dark fas fa-eye" id="icon"></i></a>
                                        </span>
                                    </div>
                                </div>
                                <div class="valid-feedback"></div> 
                                <span class="text-danger"><?php echo $passwordError; ?></span>
                            </div>

                            <div class="col-md-6">
                                <!--Phone-->
                                <label  class="text-white" for="tel">Tel :</label>
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone-alt fa-sm"></i>
                                        </span>
                                    </div>
                                    <input type="tel" id="tel" name="tel"  pattern="([+])[0-9].{7,}"  maxlength="13" class="form-control" placeholder="Votre télephone"
                                    value="<?php echo $tel; ?>" title="Contient + et des nombres" required >
                                </div>
                                <div class="valid-feedback"></div>
                                <span class="text-danger"><?php echo $telError; ?></span>
                            </div>
                            <div class="col-md-6">
                                <!--Photo-->
                                <label  class="text-white" for="image">Photo :</label>
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-file fa-sm"></i>
                                        </span>
                                    </div>
                                    <div class="custom-file">
                                        <input  type="file"class="custom-file-input" name="image" id="image" required>
                                        <label class="custom-file-label" for="customfile">Selectionner un image</label>
                                    </div>
                                </div>
                                <div class="valid-feedback"></div>
                                <span class="text-danger"><?php echo $imageError; ?></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                             <a href="../../" class="btn btn-outline-warning my-3 mr-3 btn-block">Retour</a>
                             <button type="submit" name="submit" class="btn btn-outline-success  my-3 ml-3 btn-block">Ajouter</button>
                        </div>
                    </form>     
                </div>
            </div> 
        </div> 
        </br></br></br></br>
    </div>

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