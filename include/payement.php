<?php
    session_start();
    if(!isset($_SESSION['nom1'])){
       header('location:../index.php');
    }
 
?>
<!DOCTYPE html>
<html>
<head>
   <title>Gestion de stock et facturation</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <link rel="stylesheet" href="../css/bootstrap.min.css">
   <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
   
    <!--LINK HEADER PRINCIPAL-->
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/acceuil.css">

    <script src="../js/style/fontawesome.min.js"></script>

</head>
<body class="bg-dark">
    <?php require_once "header.php"; ?> 
    <?php require_once "sidebar.php"; ?>
  
    
  <!-- ======= Corps  ======= -->
  <div class=" corps pt-2" id="corps">
        <div class="card mx-2 mt-2 mb-2">
           <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text-info">Payement </h4>
                    <i class="far fa-credit-card fa-lg text-info"></i>
               </div>
           </div>
           <div class="card-body bg-dark"> 
                <div class="card  mb-2 bord">
                    <div class="card-header"> 
                        <h6>Filtrer les payements </h6> 
                    </div>
                    <div class="card-body bg-dark pb-1">
                        <div class="row">
                            <div class="col-md-4 col-sm-6" id="ClientF">
                                <!--FILTRER LE TABLEAU DE PAYMENT PAR CLIENT-->
                                <label for="nom" class="text-white">Par client :</label>
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Par nom "
                                    onkeyup="chercherParNom()" value="" >
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6" id="commandeId">
                                <!--FILTRER LE TABLEAU DE PAYMENT PAR CLIENT-->
                                <label for="IdCommande"" class="text-white">Par id facture :</label>
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" id="IdCommande"" name="IdCommande"" class="form-control" placeholder="Par id facture"
                                    onkeyup="chercherParCommID()" value="" >
                                </div>
                            </div> 
                            <div class="col-md-4 col-sm-6" id="DateF">
                                 <!--FILTRER LE TABLEAU DE PAYMENT PAR DATE -->
                                 <label for="date" class="text-white">Par date :</label>
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" id="date" name="date" class="form-control" placeholder="Année-mois-jour "
                                    onkeyup="chercherParDate()" value="" >
                                </div>
                            </div> 
                        </div>
                    </div>
                </div> <!--div card filtre-->
                <div class="card  mb-2 bord">
                    <div class="card-header d-flex justify-content-between"> 
                        <h6 class="text-info">Liste des payements </h6> 
                    </div>
                    <div class="card-body bg-dark">  
                        <div class="table-responsive" id="afficherToutPayement">
                            <!--LISTE DES PAYEMENTS-->
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                            Nombres total des payements : <span  class="badge badge-pill badge-secondary" id="totalPayement"></span>
                    </div>
                </div>    
            </div> <!--div card body -->
        </div> <!--div card -->
    </div>
  <!-- ======= Corps Fin  ======= -->

    <?php require_once "footer.php"; ?>

   <!--SCRIPT LIBRARY-->
   <script  src="../js/header-sidebar.js"></script>    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    
    <script  src="../js/payement.js"></script> 

</body>
</html>