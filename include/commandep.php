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
    <link rel="stylesheet" href="../css/commande.css">

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
                    <h4 class="text-danger">Commande </h4>
                    <i class="fas fa-cubes fa-lg text-danger"></i>
               </div>
           </div>
           <div class="card-body bg-dark">
                <div class="card  mb-2 bord">
                    <div class="card-body d-flex justify-content-between" id="regle"> 
                        <h6 class="text-info"> Pour effectuer une commande, il faut selectionner le produit à commander sur la page de produit.</h6>
                    </div>
                </div> <!--div card --> 
                <div class="card  mb-2 bord">
                    <div class="card-header text-info d-flex justify-content-between"> 
                        <h6 class="text-dark">Commander </h6>
                        <h6 class="text-center text-dark">Date : <?php echo date("d/m/Y"); ?></h6> 
                    </div>
                    <div class="card-body bg-dark">
                        <form method="POST" id="add-form-data" enctype="multipart/form-data">
                            <input type="hidden" name="date" id="date" value="<?php echo date("Y/m/d"); ?>" >
                            <input type="hidden" name="idProd" id="idProd" value="<?php echo $_GET["id"]; ?>">

                            <div class="row text-white">
                                <div class="col-sm-4 col-6">
                                    <!--Client-->
                                    <div class="form-group">
                                        <label for="nom">Client :</label>
                                        <div id="selectAfficherClient">
                                            <!--SELECT POUR AFFICHER LES NOMS DES CLIENTS -->
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-sm-4 col-6">
                                    <!--Quantite-->
                                    <div class="form-group">
                                        <label for="quantiteC">Quantité :</label>
                                        <input type="number" name="quantiteC" id="quantiteC"  min="1" max=""  class="form-control form-control-sm  ml-2" placeholder="Qunatité de produit" required>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <!--stock-->
                                    <div class="form-group">
                                        <label for="stock">Stock :</label>
                                        <input type="number" name="stock" id="stock" value="" class="form-control form-control-sm bg-secondary text-white  ml-2" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <!--Produit-->
                                    <div class="form-group">
                                        <label for="produitC">Produit :</label>
                                        <input type="text"  name="produitC" id="produitC" value="" class="form-control form-control-sm bg-secondary text-white text-capitalize ml-2" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <!--PU-->
                                    <div class="form-group">
                                        <label for="prixUC">PU :</label>
                                        <input type="number" name="prixC" id="prixC"  class="form-control form-control-sm bg-secondary text-white ml-2" disabled>
                                        <input type="hidden" name="prixUC" id="prixUC" /> 
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <!--Total-->
                                    <div class="form-group">
                                        <label for="totalCom">Total :</label>
                                        <input type="number" name="totalCom" id="totalCom"  class="form-control form-control-sm bg-secondary text-white  ml-2"  disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mt-2">
                                    <button type="button" class="btn btn-outline-primary  btn-block" id="btnTotal">Calcul de total</button>
                                </div>
                                <div class="col-sm-6 mt-2 ">
                                    <input type="submit" name="effectuer" id="effectuer" class="btn btn-outline-success btn-block" value="Effectuer">
                                    <input type="hidden" name="action" value="addCommande">
                                </div>
                            </div>  
                        </form>     
                    </div>
                </div>   
                <div class="card  mb-2 bord">
                    <div class="card-header text-info d-flex justify-content-between"> 
                        <h6 class="text-center text-danger">Liste des commandes en-attente</h6> 
                    </div>
                    <div class="card-body bg-dark"> 
                        <div class="table-responsive" id="afficherToutCommande">
                                <!--TABLEAU DU COMMANDE EFFECTUER -->
                        </div>                     
                    </div>
                    <div class="card-footer bg-white ">
                        Nombre total des commandes :  <span class="badge badge-pill badge-secondary" id="totalCommande"></span>
                    </div>
                </div> <!--div card -->
                <div class="card  mb-2 bord">
                    <div class="card-header text-info d-flex justify-content-between"> 
                        <h6 class="text-center text-success">Liste des commandes valider</h6> 
                    </div>
                    <div class="card-body bg-dark"> 
                        <div class="table-responsive" id="afficherToutCommandeValider">
                                <!--TABLEAU DU COMMANDE VALIDER -->
                        </div>                     
                    </div>
                    <div class="card-footer bg-white ">
                        Nombre total des commandes valider :  <span class="badge badge-pill badge-secondary" id="totalCommandeValider"></span>
                    </div>
                </div> <!--div card -->
            </div> <!--div card body -->
        </div> <!--div card -->
    </div>

<!--===============Modal eddit, delete===============-->
<?php
    require_once "commande/modal/editModal.php";
    require_once "commande/modal/deleteModal.php";
    require_once "commande/modal/viewModal.php";
?>
<!--=============== Fin de Modal add, eddit, delete===============-->


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
     <!-- sweetalert library -->
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- SCRIPT COMMANDE -->
    <script  src="../js/commande.js"></script> 

</body>
</html>