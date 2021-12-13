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
    <link rel="stylesheet" href="../css/stock.css">
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
                    <h4 class="text-warning">Stock </h4>
                    <i class="fas fa-cubes fa-lg text-warning"></i>
               </div>
           </div>
           <div class="card-body bg-dark"> 
                <div class="card  mb-2 bord">
                    <div class="card-header d-flex justify-content-between"> 
                        <h6 class="text-center text-dark">Tableau du stock </h6> 
                    </div>
                    <div class="card-body bg-dark">  
                        <div class="table-responsive" id="afficherToutStock">
                            <!--TABLEAU DU STOCK-->
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                           Quantité en stock restant : <span  class="badge badge-pill badge-secondary" id="totalStock"></span>
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
    <!-- sweetalert library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        
    <script  src="../js/stock.js"></script> 

</body>
</html>