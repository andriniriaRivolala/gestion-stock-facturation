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
    <link rel="stylesheet" href="../css/produit.css">

    <script src="../js/style/fontawesome.min.js"></script>

</head>
<body class="bg-dark">
  <?php require_once "header.php"; ?> 
  <?php require_once "sidebar.php"; ?>
  
  <!-- ======= Corps  ======= -->
  <div class=" corps pt-2" id="corps">
        <div class="card mx-2 mt-2 mb-2 ">
           <div class="card-header">
               <div class="d-flex justify-content-between">
                    <h4 class="text-danger">Produit </h4>
                    <i class="fas fa-cubes fa-lg text-danger"></i>
               </div>
           </div>
           <div class="card-body bg-dark">
                <div class="card  mb-2 bord">
                    <div class="card-header"> 
                        <h6>Filtrer les produits</h6> 
                    </div>
                    <div class="card-body bg-dark pb-1">
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <!--Nom-->
                                <label class="text-white" for="nomfilter">Par nom :</label>
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" id="nomfilter" class="form-control" placeholder=" nom "
                                       value="" >
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6" id="fournisseurParentF">
                                <!--AFFICHER LES FOURNISSEURS PARENTE DANS UN SELECT DE FILTER -->
                            </div>
                            <div class="col-md-4 col-sm-6" id="categorieParentF">
                                <!--AFFICHER LES CATEGORIES PARENT DANS UN SELECT-DE FILTER-->
                            </div> 
                            <div class="col-md-4 col-sm-6" id="souscategorieParentF">
                                <!--AFFICHER LES SOUS-CATEGORIES PARENT DANS UN SELECT DE FILTER-->
                            </div> 
                            <div class="col-md-4 col-sm-6">
                                <!--Nom-->
                                <label class="text-white" for="prixinferieur">Par prix inferieur à :</label>
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="number" id="prixinferieur" class="form-control" placeholder=" prix inferieur"
                                       value="" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!--div card filtre-->

                 <div class="row">
                    <div class="col-md-12 ">
                        <div class="card  mb-2 bord">
                            <div class="card-header d-flex"> 
                                <h6 class="text-danger">Liste des produits</h6> 
                            </div>
                            <div class="card-body bg-dark" id="produitAffi">
                                <div id="afficherToutProduit">
                                    <!--AFFICHAGE DE PRODUIT SOUS FORME DE CARD-->
                                </div>
                            </div>
                            <div class="card-footer">
                                Nombre total des produits :  <span class="badge badge-pill badge-secondary" id="totalProduit"></span>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
    <!--===============LOADING===============-->
    <div class="overlay text-center" id="load" style="display:none">
        <div class="spinner-border spinner-border-sm text-danger" style="width: 5rem; height: 5rem;"></div>
        <br>
        <h4 class="text-white"> LOADING ...</h4>
    </div>
    <!--===============LOADING FIN===============-->
  <!-- ======= Corps Fin  ======= -->

  <?php require_once "footer.php"; ?>

<!--===============Modal add, eddit, delete===============-->
<?php
    require_once "produit/modal/addModal.php";
    require_once "produit/modal/editModal.php";
    require_once "produit/modal/deleteModal.php";
    require_once "produit/modal/viewModal.php";
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

    <!-- SCRIPT PRODUIT -->
    <script  src="../js/produit.js"></script> 

</body>
</html>