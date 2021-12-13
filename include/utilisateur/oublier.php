<?php
    require '../db.php';

    //Function de verification
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }
    
    //on initialise nos messages d' erreurs
    $msgError = $confirme = '';
    $email = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        
        //on securise les données
        $email = test_input($_POST['email']);

        // on vérifie les input
        $valid = true;
        if (empty($email)) {
            $nomError = 'Entrer votre email';
            $valid = false;
        }

        if ($valid) {
            //si c'est bon, on connecte à la base
            $db = new Database();
            $db = Database :: connect();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM utilisateur WHERE email=?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($email));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            $password = $data['password']; 

            // Acces OK ! s'il y a des data et qu'elle correspondent
            if ($data['email'] == $email ) {
                $to = "awebmada@gmail.com";
                $subject = "Mot de passe";
                $message = "Bonjour, votre mot de passe est $password";
                $headers = "From : awebmada@gmail.com\r\n Reply-To:-$email";
                $send_Mail = mail($to, $subject,$message, $headers);
                if($send_Mail == true){
                    $confirme = '<p> Un email est envoyer sur votre email.</p><p>Cliquez <a href="">ici</a></p>';
                }else{
                    $msgError = "<p>Une erreur se produit</p>";
                }

            }else{
                // Acces refusé on reste sur la page!
                $msgError = ' <p>Pas cette email dans database.</p><p>Cliquez <a href="">ici</a>';   
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
   <link rel="stylesheet" href="../../css/bootstrap.min.css">
   
    <!--LINK HEADER PRINCIPAL-->
    <script src="../../js/style/fontawesome.min.js"></script> 

</head>

<body class="bg-dark">
    <div class="container">
        <div class="card bg-dark justify-content-center mx-auto border border-white mt-5">
            <div class="card-body">
                <div class="text-center ">
                    <h5 class="text-md text-danger">Mot de passe oublier ?</h5>
                    <p class="text-white">Entrer l'email correspondant au compte :</p>
                    <p class="text-white">Nous vous enverrons immédiatement par e-mail votre mot de passe.</p>
                </div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="was-validated">
                    <div class="input-group mb-2 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Votre email"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="" required >
                    </div>
                    <div class="d-flex justify-content-around">
                        <button type="submit" name="submit" class="btn  m-2 btn-outline-success btn-block text-center " > Recuperer</button>
                        <a href="../../" class="btn  btn-outline-info m-2 btn-block" > Retour </a>
                    </div>
                </form>
                <div class="mt-1 text-center ">
                    <span class =" text-success"> <?php echo $confirme; ?> </span>
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
 
    </script>
    
</body>
</html> 