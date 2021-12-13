<!-- ======= Sidebar ======= -->
<div class=" d-flex flex-column fixed float-left bg-dark menu menuCollapse mr-2" id="sidebar" width="150px">
    <div class="card m-1 bg-dark" width="120px">
        <div class="card-body justify-content-center">
            <?php
                 include "db.php";
                if(isset($_SESSION["nom1"])){
                    $nomUtil = $_SESSION["nom1"];
                    //on se connecte à la base 
                    $db = new Database;
                    $db = Database::connect(); 

                    $sql = 'SELECT* FROM utilisateur WHERE nom =?';
                    $stmt = $db->prepare($sql);
                    $stmt->execute(array( $nomUtil));
                    $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result as $row){
                        $data[] = $row;
            ?>
            <a href="utilisateur/view.php?id=<?php echo $row['id'];?>" ><img class="card-img-top rounded-circle  user" src="utilisateur/uploads/<?php echo $row['image']; ?>" alt="Utilisateur" style="width:100px, heigth:100px;"></a>
            <h6 class="text-light text-center text-capitalize my-1"><?php echo $row['nom']; ?></h6>
           
            <div class="d-flex justify-content-around list-unstyled my-1">
                <button class="btn btn-success"> <a href="utilisateur/edit.php?id=<?php echo $row['id']; ?>"><i class="fas fa-pencil-alt text-white"></i></a></button>
                <button class="btn btn-danger" id="AjouterUserModal2">
                        <a href="utilisateur/create2.php"><i class="fas fa-user-plus text-white"></i></a>
                </button> 
            </div>
            <?php
                    }
                }
                Database::disconnect();
            ?>
        </div>
    </div>
    <div class="sous-menu">
        <ul class="pl-0">
            <li class="my-2 py-1 pl-2 list-menu">
                <a class=" text-light menu-item " href="accueil.php">
                    <i class="fas fa-home mr-3 fa-sm" ></i><span class="text-light">Accueil</span>
                </a>
            </li>
            <li class="my-2 py-1 pl-2 list-menu">
                <a class=" text-light menu-item " href="fournisseur.php">
                    <i class="fas fa-briefcase mr-3  fa-sm"   ></i><span class="text-light">Fournisseur</span>
                </a>
            </li>
            <li class="my-2 py-1 pl-2 list-menu">
                <a class=" text-light menu-item " href="client.php">
                    <i class="fas fa-users mr-3  fa-sm"  ></i><span class="text-light">Client</span>
                </a>
            </li>
            <li class="my-2 py-1 pl-2 list-menu">
                <a class=" text-light menu-item" href="produit.php">
                    <i class="fas fa-cube mr-3  fa-sm"  ></i><span class="text-light">Produit</span>
                </a>   
            </li> 
            <li class="my-2 py-1 pl-2 list-menu">
                <a class=" text-light menu-item" href="stock.php">
                    <i class="fas fa-cube mr-3  fa-sm"  ></i><span class="text-light">Stock</span>
                </a>   
            </li> 
            <li class="my-2 py-1 pl-2 list-menu">
                <a class=" text-light menu-item " href="categorie.php">
                    <i class="fas fa-cube mr-3  fa-sm"  ></i><span class="text-light">Categorie</span>
                </a>
            </li>
            <li class="my-2 py-1 pl-2 list-menu">
                <a class=" text-light menu-item " href="sous-categorie.php">
                    <i class="fas fa-cube mr-3  fa-sm"  ></i><span class="text-light">Sous-categorie</span>
                </a>
            </li>
            <li class="my-2 py-1 pl-2 list-menu">
                <a class=" text-light menu-item " href="commandep.php">
                    <i class="fas fa-archive mr-3  fa-sm"  ></i><span class="text-light">Commande</span>
                    <span class="badge badge-pill badge-danger" id="AttenteCOMM">1</span>
                </a>
            </li>
            <li class="my-2 py-1 pl-2 list-menu">
                <a class=" text-light menu-item " href="facture.php">
                    <i class="fas fa-file mr-3  fa-sm"  ></i><span class="text-light">Facture</span>
                </a>
            </li>
            <li class="my-2 py-1 pl-2 list-menu">
                <a class=" text-light menu-item " href="payement.php">
                    <i class="far fa-credit-card mr-3  fa-sm"  ></i><span class="text-light">Payement</span>
                </a>
            </li>    
        </ul>
    </div>
</div>
    <!-- ======= Sidebar Fin ======= -->