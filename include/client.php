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
  <div class=" corps pt-2" id="corps">
        <div class="card mx-2 mt-2 mb-2 ">
           <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text-success">Client </h4>
                    <a href="client/create.php" class="btn btn-success" >
                        Ajouter <i class="fas fa-user-circle fa-sm" ></i>
                    </a>
                </div>
           </div>
           <div class="card-body bg-dark">
                <div class="card">
                    <div class="card-body bg-dark pb-1">
                        <h6 class="text-white">Filtrer </h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <!--Nom-->
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Par nom "
                                        onkeyup="chercherParNom()"  value="" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!--prenom-->
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" id="prenom" name="prenom" class="form-control" placeholder=" Par prenom  "
                                        onkeyup="chercherParPrenom()" value="" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!--email-->
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Par email "
                                        onkeyup="chercherParEmail()" value="" >
                                    </div>
                                </div>
                            </div>
                    </div>
                </div> <!--div card filtre-->
                <div class="card  mt-2">
                    <div class="card-header">
                        <h6>Tous les clients</h6>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="table-responsive my-2">
                            <table class="table table-striped table-hover table-border table-sm table-dark" id="table">
                                <thead>
                                    <tr class="text-info">
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Email</th>
                                        <th>Addresse</th>
                                        <th>Telephone</th>
                                        <th>Code postal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>    
                                <tbody>
                                    <?php    
                                        //on se connecte à la base 
                                        $db = new Database;
                                        $db = Database::connect(); 
                                        //sql
                                        $sql = 'SELECT * FROM client ORDER BY id ASC'; 
                                        $stmt=$db->query($sql);
                                
                                        while($row = $stmt->fetch()){
                                            //on cree les lignes du tableau avec chaque valeur retournée
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['nom']; ?></td>
                                        <td><?php echo $row['prenom']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['tel']; ?></td>
                                        <td><?php echo $row['codepostal']; ?></td>
                                        <td class="">
                                            <a href="client/view.php?id=<?php echo $row['id']; ?>" class="pl-2" title="Voir"><i class="fas fa-eye text-success"></i></a>
                                            <a href="client/edit.php?id=<?php echo $row['id']; ?>" class="pl-2" title="Modifier"><i class="fas fa-pencil-alt text-warning"></i></a>
                                            <a href="client/delete.php?id=<?php echo $row['id']; ?>" class="pl-2" title="Supprimer"><i class="fas fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>     
                                </tbody>
                            </table>
                        </div>  
                    </div>
                    <div class="card-footer">
                        <?php   
                            //on se connecte à la base 
                            $sql = 'SELECT count(id) FROM client'; 
                            $stmt=$db->query($sql);
                            $effectif = $stmt->fetch();
                        ?>   
                        Total des clients : <span class="badge badge-pill badge-secondary ml-1"> <?php echo $effectif[0]; ?></span>  
                        <?php
                            Database::disconnect();
                        ?>
                    </div>
                </div>

            </div> <!--div card body-->
        </div>   <!--div card -->          
    </div> <!--div corps-->
    
  <!-- ======= Corps Fin  ======= -->

  <?php require_once "footer.php"; ?>

   <!--SCRIPT LIBRARY-->

    <script  src="../js/header-sidebar.js"></script> 
    <script  src="../js/client.js"></script> 

    <script  src="../jquery.modal.min.js"></script>
    <script src="../js/style/fontawesome.min.js"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    

</body>
</html>