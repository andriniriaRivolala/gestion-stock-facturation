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
   
    <!--LINK HEADER PRINCIPAL-->
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/acceuil.css">
    <link rel="stylesheet" href="../css/facture.css">

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
                    <h4 class="text-warning">Facture :</h4>
                    <i class="fas fa-file fa-lg text-warning"></i>
               </div>
           </div>
           <div class="card-body bg-dark"> 
                <div class="card  mb-2 bord">
                    <div class="card-header"> 
                        <h6>Filtrer des factures </h6> 
                    </div>
                    <div class="card-body bg-dark pb-1">
                        <div class="row">
                            <div class="col-md-4 col-sm-6" id="ClientF">
                                 <!--FILTRER LE TABLEAU DE FACTURE PAR CLIENT-->
                                 <label for="nom" class="text-white">Par client:</label>
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom client "
                                    onkeyup="chercherParNom()" value="" >
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6" id="CommandeId">
                                 <!--FILTRER LE TABLEAU DE FACTURE PAR COMMANDE ID-->
                                 <label for="IdCommande" class="text-white">Par commande id:</label>
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" id="IdCommande" name="IdCommande" class="form-control" placeholder="Id commande "
                                    onkeyup="chercherParCommID()" value="" >
                                </div>
                            </div> 
                            <div class="col-md-4 col-sm-6" id="DateF">
                                <!--FILTRER LE TABLEAU DE FACTURE PAR DATE -->
                                <label for="date" class="text-white">Par date:</label>
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
                    <div class="card-header text-warning d-flex justify-content-between"> 
                        <h6>Liste des factures </h6> 
                    </div>
                    <div class="card-body bg-dark">  
                        <div class="table-responsive" id="afficherToutFacture">
                            <!--LISTE DES FACTURES-->
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                            Nombres total des factures : <span  class="badge badge-pill badge-secondary" id="totalFacture"></span>
                    </div>
                </div>    
            </div> <!--div card body -->
        </div> <!--div card -->
    </div>
  <!-- ======= Corps Fin  ======= -->

  <?php require_once "footer.php"; ?>

  <!--===============Modal eddit, delete===============-->
<?php
    require_once "facture/modal/viewModal.php";
?>
<!--=============== Fin de Modal add, eddit, delete===============-->

   <!--SCRIPT LIBRARY-->
   <script  src="../js/header-sidebar.js"></script>    

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- sweetalert library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        
    <script  src="../js/facture.js"></script> 

</body>
</html>