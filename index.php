<?php
    //on ouvre la session   
    session_start(); 

    require 'include/db.php';

    //Function de verification
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }
    
    //on initialise nos messages d' erreurs
    $nomError = $passwordError = $msgError = '';
    $password = $nom = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        
        //on securise les données
        $password = test_input($_POST['password']); 
        $nom = test_input($_POST['nom']);

        // on vérifie les input
        $valid = true;
        if (empty($nom)) {
            $nomError = 'Entrer votre nom';
            $valid = false;
        }

        if (empty($password)) {
            $passwordError = 'Entrer votre mot de passe';
            $valid = false;
        }

        if ($valid) {
            //si c'est bon, on connecte à la base
            $db = new Database();
            $db = Database :: connect();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM utilisateur WHERE nom=? AND password=? ";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($nom, $password));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // Acces OK ! s'il y a des data et qu'elle correspondent
            if ($data['password'] == $password && $data['nom'] == $nom ) {

                //on assigne nos valeurs
                $_SESSION['nom1'] = $data['nom'];
                $_SESSION['password1'] = $data['password'];
                $_SESSION['id1'] = $data['id'];
        

                //et on renvoie vers accueil
                header('location:include/accueil.php'); 

            }else{
                // Acces refusé on reste sur la page!
                $msgError = ' <p>Le mot de passe ou le nom
                    entré n\'est pas correcte.</p><p>Cliquez <a href="index.php">ici</a></p>';   
            }
        }

        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html>
<head>
   <title>Gestion de stock et facturation</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   
    <!--LINK HEADER PRINCIPAL-->
    <link rel="stylesheet" href="css/position.css">

    <script src="js/style/fontawesome.min.js"></script>
      
</head>

<body class="bg-dark">
    <div class="container">
        <div class="card bg-dark justify-content-center mx-auto border border-white"  style="width:85%">
            <div class="card-body">
                <div class="text-center ">
                    <h5 class="text-md" style="color:#ff9700;">BIENVENUE EN G-STOCK</h5>
                    <p class="text-white">Connecter vous pour accéder :</p>
                </div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="input-group mb-2 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input type="text" name="nom" class="form-control" placeholder="Votre nom" value="<?php echo $nom; ?>">
                    </div>
                    <div class="input-group mb-2 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fab fa-expeditedssl fa-lg"></i>
                            </span>
                        </div>
                        <input type="password" name="password" id="input-password" class="form-control" placeholder="Mot de passe" value="<?php echo $password; ?>" >
                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox"  onclick="visibilite()" class="custom-control-input" id="customCheck" name="example1">
                        <label class="custom-control-label text-white" for="customCheck"> Montrer le mot de passe</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-block btn-outline-success justify-content-center" > Login </button>
                </form>
                <div class="mt-1 text-center row">
                    <div class="col-md-6">
                          <a href="include/utilisateur/oublier.php" class="card-link">Mot de passe oublier ?</a>
                    </div>
                    <div class="col-md-6">
                          <a href="include/utilisateur/create1.php" class="card-link">Creer un compte ! </a>
                    </div>
                </div>
                <div class="mt-1 text-center ">
                    <span class =" text-danger"> <?php echo $msgError; ?> </span>
                </div>
            </div>  <!--div card-body -->
        </div>
    </div>

     <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      
    
    
    <!--CODE JQUERY-->
    <script>
      
        //Visibilite de mot de passe
        function visibilite() {
            var x = document.getElementById("input-password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    
</body>
</html> 