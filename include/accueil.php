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
    
    <script src="../js/style/fontawesome.min.js"></script>

</head>
<body class="bg-dark">
  <?php require_once "header.php"; ?> 
  <?php require_once "sidebar.php"; ?>
  
  <!-- ======= Corps  ======= -->
   <div class=" corps pt-2 " id="corps">
        <div class="card mx-2 mt-2 mb-2">
           <div class="card-header">
               <h5 class="text-primary">Tableau de bord :</h5>
           </div>
           <div class="card-body bg-dark">

                <div class="row">
                    <div class="col-md-4  col-sm-6">
                        <div class="card  mb-2 bord">
                            <div class="card-header d-flex justify-content-between"> 
                                <h6>Utilisateur</h6> 
                                <a href="utilisateur.php"><button class="btn btn-sm btn-success">Details</button></a>
                            </div>
                            <div class="card-body bg-dark">
                                <div class="d-flex justify-content-around">
                                    <?php 
                                        //on se connecte à la base 
                                        $db = new Database;
                                        $db = Database::connect(); 

                                        $sql = 'SELECT count(id) FROM utilisateur'; 
                                        $stmt=$db->query($sql);
                                        $effectifU = $stmt->fetch();
                                    ?>  
                                    <h2 class="text-muted"><?php echo $effectifU[0]; ?></h2>
                                    <i class="fas fa-user fa-lg text-muted"></i>
                                </div>
                                <p class="m-0 text-center text-white">Nombre des Utilisateurs</p>
                             </div>
                        </div> <!--div card --> 
                    </div>
                    <div class="col-md-4  col-sm-6">
                        <div class="card  mb-2 bord">
                            <div class="card-header d-flex justify-content-between"> 
                                <h6>Fournisseur</h6> 
                                <a href="fournisseur.php"><button class="btn btn-sm btn-success">Details</button></a>
                            </div>
                            <div class="card-body bg-dark">
                                <div class="d-flex justify-content-around">
                                    <?php 
                                        //on se connecte à la base 
                                        $db = new Database;
                                        $db = Database::connect(); 

                                        $sql = 'SELECT count(id) FROM fournisseur'; 
                                        $stmt=$db->query($sql);
                                        $effectifF = $stmt->fetch();
                                    ?>  
                                    <h2 class="text-primary"><?php echo $effectifF[0]; ?></h2>
                                    <i class="fas fa-briefcase fa-lg text-primary"></i>
                                </div>
                                <p class="m-0 text-center text-white">Nombre des Fournisseurs</p>
                            </div>
                        </div> <!--div card -->
                    </div>
                    <div class="col-md-4  col-sm-6">
                        <div class="card  mb-2 bord">
                            <div class="card-header d-flex justify-content-between"> 
                                <h6>Client</h6> 
                                <a href="client.php"><button class="btn btn-sm btn-success">Details</button></a>
                            </div>
                            <div class="card-body bg-dark">
                                <div class="d-flex justify-content-around">
                                <?php 
                                        //on se connecte à la base 
                                        $db = new Database;
                                        $db = Database::connect(); 

                                        $sql = 'SELECT count(id) FROM client'; 
                                        $stmt=$db->query($sql);
                                        $effectifC = $stmt->fetch();
                                    ?>  
                                    <h2 class="text-success"><?php echo $effectifC[0]; ?></h2>
                                    <i class="fas fa-users fa-lg text-success"></i>
                                </div>
                                <p class="m-0 text-center text-white">Nombre des Clients</p>
                            </div>
                        </div> <!--div card -->
                    </div>
                    <div class="col-md-4  col-sm-6">
                        <div class="card  mb-2 bord">
                            <div class="card-header d-flex justify-content-between"> 
                                <h6>Produit</h6> 
                                <a href="produit.php"><button class="btn btn-sm btn-success">Details</button></a>
                            </div>
                            <div class="card-body bg-dark">
                                <div class="d-flex justify-content-around">
                                <?php 
                                        //on se connecte à la base 
                                        $db = new Database;
                                        $db = Database::connect(); 

                                        $sql = 'SELECT count(id) FROM produit'; 
                                        $stmt=$db->query($sql);
                                        $effectifP = $stmt->fetch();
                                    ?>  
                                    <h2 class="text-danger"><?php echo $effectifP[0]; ?></h2>
                                    <i class="fas fa-cubes fa-lg text-danger"></i>
                                </div>
                                <p class="m-0 text-center text-white">Nombre des Produits</p>
                            </div>
                        </div> <!--div card -->
                    </div>
                    <div class="col-md-4  col-sm-6">
                        <div class="card  mb-2 bord">
                            <div class="card-header d-flex justify-content-between"> 
                                <h6>Stock</h6> 
                                <a href="stock.php"><button class="btn btn-sm btn-success">Details</button></a>
                            </div>
                            <div class="card-body bg-dark">
                                <div class="d-flex justify-content-around">
                                <?php 
                                        //on se connecte à la base 
                                        $db = new Database;
                                        $db = Database::connect(); 

                                        $sql1 = 'SELECT sum(DebutStock) FROM produit'; 
                                        $stmt1=$db->query($sql1);
                                        $effectifStock = $stmt1->fetch();

                                        $sql2 = 'SELECT sum(DebutStock)-sum(stock) FROM produit'; 
                                        $stmt2=$db->query($sql2);
                                        $QuantiteCommande = $stmt2->fetch();
                                    ?>  
                                    <h2 class="text-danger"><span class="text-success"><?php echo  $QuantiteCommande[0]; ?></span> / <?php echo $effectifStock[0]; ?></h2>
                                    <i class="fas fa-cubes fa-lg text-danger"></i>
                                </div>
                                <p class="m-0 text-center text-white">Quantité de stock</p>
                            </div>
                        </div> <!--div card -->
                    </div>
                    <div class="col-md-4  col-sm-6">
                        <div class="card  mb-2 bord">
                            <div class="card-header d-flex justify-content-between"> 
                                <h6>Categorie</h6> 
                                <a href="categorie.php"><button class="btn btn-sm btn-success">Details</button></a>
                            </div>
                            <div class="card-body bg-dark">
                                <div class="d-flex justify-content-around">
                                <?php 
                                        //on se connecte à la base 
                                        $db = new Database;
                                        $db = Database::connect(); 

                                        $sql = 'SELECT count(id) FROM categorie'; 
                                        $stmt=$db->query($sql);
                                        $effectifCA = $stmt->fetch();
                                    ?>  
                                    <h2 class="text-warning"><?php echo $effectifCA[0]; ?></h2>
                                    <i class="fas fa-cubes fa-lg text-warning"></i>
                                </div>
                                <p class="m-0 text-center text-white">Nombre des Categories</p>
                            </div>
                        </div> <!--div card -->
                    </div>
                    <div class="col-md-4  col-sm-6">
                        <div class="card  mb-2 bord">
                            <div class="card-header d-flex justify-content-between"> 
                                <h6>Sous-categorie</h6> 
                                <a href="sous-categorie.php"><button class="btn btn-sm btn-success">Details</button></a>
                            </div>
                            <div class="card-body bg-dark">
                                <div class="d-flex justify-content-around">
                                <?php 
                                        //on se connecte à la base 
                                        $db = new Database;
                                        $db = Database::connect(); 

                                        $sql = 'SELECT count(id) FROM souscategorie'; 
                                        $stmt=$db->query($sql);
                                        $effectifSC= $stmt->fetch();
                                    ?>  
                                    <h2 class="text-warning"><?php echo $effectifSC[0]; ?></h2>
                                    <i class="fas fa-cubes fa-lg text-warning"></i>
                                </div>
                                <p class="m-0 text-center text-white">Nombres sous-categories</p>
                            </div>
                        </div> <!--div card -->
                    </div>
                    <div class="col-md-4  col-sm-6">
                        <div class="card  mb-2 bord">
                            <div class="card-header d-flex justify-content-between"> 
                                <h6>Commande</h6> 
                                <a href="commandep.php"><button class="btn btn-sm btn-success">Details</button></a>
                            </div>
                            <div class="card-body bg-dark">
                                <div class="d-flex justify-content-around">
                                    <?php 
                                        //on se connecte à la base 
                                        $db = new Database;
                                        $db = Database::connect(); 

                                        $sql = 'SELECT count(id) FROM commande'; 
                                        $stmt=$db->query($sql);
                                        $effectifCom = $stmt->fetch();
                                    ?>  
                                    <h2 class="text-danger"><?php echo $effectifCom[0]; ?></h2>
                                   <i class="fas fa-archive fa-lg text-danger"></i>
                                </div>
                                <p class="m-0 text-center text-white">Nombre des commandes</p>
                            </div>
                        </div>  <!--div card -->
                    </div>
                    <div class="col-md-4  col-sm-6">
                        <div class="card  mb-2 bord">
                            <div class="card-header d-flex justify-content-between"> 
                                <h6>Facture</h6> 
                                <a href="facture.php"><button class="btn btn-sm btn-success">Details</button></a>
                            </div>
                            <div class="card-body bg-dark">
                                <div class="d-flex justify-content-around"> 
                                    <?php 
                                        //on se connecte à la base 
                                        $db = new Database;
                                        $db = Database::connect(); 

                                        $sql = 'SELECT count(id) FROM facture'; 
                                        $stmt=$db->query($sql);
                                        $effectifFact = $stmt->fetch();
                                    ?>  
                                    <h2 class="text-warning"><?php echo $effectifFact[0]; ?></h2>
                                    <i class="fas fa-file fa-lg text-warning"></i>
                                </div>
                                <p class="m-0 text-center text-white">Nombre des Factures</p>
                            </div>
                        </div>  <!--div card -->
                    </div>
                    <div class="col-md-4  col-sm-6">
                        <div class="card  mb-2 bord">
                            <div class="card-header d-flex justify-content-between"> 
                                <h6>Payement</h6>  
                                <a href="payement.php"><button class="btn btn-sm btn-success">Details</button></a>
                            </div>
                            <div class="card-body bg-dark">
                                <div class="d-flex justify-content-around"> 
                                    <?php 
                                        //on se connecte à la base 
                                        $db = new Database;
                                        $db = Database::connect(); 

                                        $sql = 'SELECT count(id) FROM payment'; 
                                        $stmt=$db->query($sql);
                                        $effectifP = $stmt->fetch();
                                    ?>  
                                    <h2 class="text-info"><?php echo $effectifP[0]; ?></h2>
                                    <i class="far fa-credit-card fa-lg text-info"></i>
                                </div>
                                <p class="m-0 text-center text-white">Nombre des Payements</p>
                            </div>
                        </div>  <!--div card -->
                    </div>
                </div>
           </div> 
        </div> <!--div card -->
    </div> <!--div corps -->
    <!-- ======= Corps Fin  ======= -->
    
    <?php require_once "footer.php";?>

   <!--SCRIPT LIBRARY-->
   <script  src="../js/header-sidebar.js"></script>    
   
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    

</body>
</html>