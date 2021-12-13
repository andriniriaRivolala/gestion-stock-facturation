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
    <link rel="stylesheet" href="../css/sous-categorie.css">

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
                    <h5 class="text-warning">Sous-categorie :</h5>
                    <i class="fas fa-cubes fa-lg text-warning"></i>
               </div>
           </div>
           <div class="card-body bg-dark">

                 <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card  mb-2 bord">
                            <div class="card-header "> 
                                <h6>Ajouter une nouvelle sous-categorie</h6> 
                           </div>
                           <div class="card-body bg-dark">
                                <form action="" method="POST" id="form-data">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!--Nom-->
                                            <label for="nom" class="text-white">Nom :</label>
                                            <input type="text" name="nom" id="nom" minlenght="2" class="form-control mb-1" width="100" placeholder="Nom du sous-categorie :" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="nom" class="text-white">Categorie parente :</label>
                                            <div id="selectAfficherCategorie">
                                                 <!--SELECT POUR AFFICHER DES DONNERS DE CATEGORIE -->
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="insert" id="insert" class="btn btn-outline-success btn-block mt-2" id="addButton">Ajouter</button>
                                </form>
                             </div>
                        </div>
                    </div>
                    <div class="col-md-12  col-sm-12">
                        <div class="card  mb-2 bord">
                            <div class="card-header"> 
                                <h6>Tous les sous-catégories</h6> 
                            </div>
                            <div class="card-body bg-dark">
                                <div class="table-responsive-sm" id="afficherToutSousCategorie" >
                                        <!--TABLEAU DES DONNERS DE SOUS-CATEGORIE -->
                                </div>
                            </div> <!--div card-body-->
                            <div class="card-footer">
                                 Nombres total des sous-catégories: <span class="badge badge-pill badge-secondary" id="totalSousCategories"></span>
                            </div>
                        </div> <!--div card-->
                    </div> <!--div col-->
                </div>   <!--div row-->
           </div>
        </div>
</div>

        
<!--MODAL EDIT ET DELETE-->
<?php
    require_once "sous-categorie/modal/editModal.php";
    require_once "sous-categorie/modal/deleteModal.php";
?>
<!--FIN MODAL EDIT ET DELETE -->

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

    <!-- SCRIPT SOUS-CATEGORIE -->
    <script  src="../js/souscategorie.js"></script> 

</body>
</html>