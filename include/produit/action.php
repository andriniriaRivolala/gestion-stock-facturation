<?php
  
    require_once "produit.php";
    
    $prod = new produit();

    //afficher tout les fourisseurs dans un select sur le filter 
    if(isset($_POST['action']) && $_POST['action'] == "afficherFournisseurF"){
        $output = '';
        $data = $prod->readFournisseur();
        if($prod->totalFournisseur()>0){
            $output .=
            '<label for="fournisseur-prtF" class="text-white">Fournisseur :</label>
            <select name="fournisseur-prtF" class="custom-select" id="selectFournisseurF">
                <option></option>';
                foreach($data as $row){
                    $output .=
                    '<option value="'.$row['id'].'">'.$row['nom'].'</option>';
                }
            $output .=
            '</select>';
            echo $output;
        }else{
            echo '<h5 class="text-center text-danger">Pas de fournisseur dans le database</h5>';
        }
    }

    //afficher tout les categories dans  un select sur le filter
    if(isset($_POST['action']) && $_POST['action'] == "afficherCategorieF"){
        $output = '';
        $data = $prod->readCategorie();
        if($prod->totalCategorie()>0){
            
            $output .=
            '<label for="categorie-prtF" class="text-white">Categorie :</label>
            <select name="categorie-prtF" class="custom-select" id="selectCategorieF">
                <option ></option>';
                foreach($data as $row){
                    $output .=
                    '<option value="'.$row['id'].'">'.$row['nom'].'</option>';
                }
            $output .=
            '</select>';
            echo $output;
        }else{
            echo '<h5 class="text-center text-danger">Pas de categorie dans le database</h5>';
        }
    }

    //afficher tout les  sous-categories dans un select sur le filter
    if(isset($_POST['action']) && $_POST['action'] == "afficherSouscategorieF"){
        $output = '';
        $data = $prod->readSouscategorie();
        if($prod->totalSouscategorie()>0){
            $output .=
            '<label for="souscategorie-prtF" class="text-white" >Sous-categorie :</label>
            <select name="souscategorie-prtF" class="custom-select" id="selectSouscategorieF">
                <option></option>';
                foreach($data as $row){
                    $output .=
                    '<option value="'.$row['id'].'">'.$row['nom'].'</option>';
                }
            $output .=
            '</select>';
            echo $output;
        }else{
            echo '<h5 class="text-center text-danger">Pas de sous-categorie dans le database</h5>';
        }
    }

    //afficher tout les produits dans des cards
     if(isset($_POST['action']) && $_POST['action'] == "afficher"){
        $output = '';
        $data = $prod->readProduit();
        if($prod->totalProduit()>0){
            $output .= 
            '<div id="flex-container" >
                <div class="ligne1">
                    <div class="card m-2 bg-secondary" id="ajouter-produit" data-toggle="modal" data-target="#addModal" style="width:150px;height:230px;">
                        <div class="card-body text-center">
                                <i class="fas fa-plus fa-5x  text-white m-3"></i>
                        </div>
                        <div class="card-footer">
                            <h6 class="text-center text-white">Ajouter Produit</h6>
                        </div>
                    </div>
                </div>';
            foreach($data as $row){
                $output .= 
                '<div class="ligne2">
                    <div class="card m-2 bg-white" id="produit" style="width:150px;height:230px;">
                        <img id="'. $row['id'].'" title="CLick pour voir le detail" class="card-img-top imageProdView" src="produit/uploads/'.$row['image'].'" data-toggle="modal" data-target="#viewModal" alt="image produit" width="149px" height="120px" style="cursor:pointer;">
                        <h5 id="prixcard"><span class="badge badge-danger ">'.$row['prix'].' $</span></h5>
                        <div class="card-body" style="padding:0px;">
                            <h5 class="d-flex justify-content-center"><span class="badge badge-info text-capitalize">'.$row['nom'].'</span></h5>
                            <p class="text-dark" style="margin:0px;">Stock : <span class="badge badge-pill badge-success ml-1">'.$row['stock'].'</span></p>
                            <div class="d-flex justify-content-end">
                                <a href="#" id="'. $row['id'].'" class="badge badge-pill badge-danger deletebtn" data-toggle="modal" data-target="#deleteModal" title="supprimet un produit"><i class="fas fa-trash text-white"></i></a>
                                <a href="#" id="'. $row['id'].'" class="badge badge-pill badge-warning mx-1 editbtn" data-toggle="modal" data-target="#editModal" title="modifier un produit"><i class="fas fa-edit  text-white"></i></a>
                            </div>
                        </div>
                        <div class="card-footer bg-dark justify-content-center"  style="padding:0px;">
                                <a href="commandep.php?id='. $row['id'].'" class="btn btn-outline-success text-white d-block btn-sm">
                                    <i class="fas fa-cart-plus fa-sm"></i> Commander
                                </a>
                        </div>
                    </div>
                </div>';
            }
            $output .=
            '</div>';
            echo $output;
        }else{
            $output .= 
            '<div class="row">
                <div class="col-md-3 col-sm-4 col-12">
                    <div class="card my-2 bg-secondary" id="ajouter-produit" data-toggle="modal" data-target="#addModal" style="width:150px;height:230px;">
                        <div class="card-body text-center">
                                <i class="fas fa-plus fa-5x  text-white m-3"></i>
                        </div>
                        <div class="card-footer">
                            <h6 class="text-center text-white">Ajouter Produit</h6>
                        </div>
                    </div>
                </div>';
            $output .=
            '</div>';
            echo $output."</br>";
            echo '<h3 class="text-center text-danger">Pas de produit dans le database</h3>';
        }
    }
    //afficher le total produit
    if(isset($_POST['action']) && $_POST['action'] == "totalProduit"){
         $total = $prod->totalProduit(); 
         echo $total;  
    }
    

    //afficher tout les fourisseurs dans un select sur le modal insert 
    if(isset($_POST['action']) && $_POST['action'] == "afficherFournisseur"){
        $output = '';
        $data = $prod->readFournisseur();
        if($prod->totalFournisseur()>0){
            $output .=
            '<label for="fournisseur-prt" class="text-white">Fournisseur :</label>
            <select name="fournisseur-prt" class="custom-select text-capitalize" id="selectFournisseur" required>
                <option selected></option>';
                foreach($data as $row){
                    $output .=
                    '<option value="'.$row['id'].'">'.$row['nom'].'</option>';
                }
            $output .=
            '</select>';
            echo $output;
        }else{
           echo '<h5 class="text-center text-danger">Pas de fournisseur dans le database</h5>';
        }
    }
    //afficher tout les categories dans  un select sur le modal insert
    if(isset($_POST['action']) && $_POST['action'] == "afficherCategorie"){
        $output = '';
        $data = $prod->readCategorie();
        if($prod->totalCategorie()>0){
            
            $output .=
            '<label for="categorie-prt" class="text-white">Categorie :</label>
            <select name="categorie-prt" class="custom-select text-capitalize" id="selectCategorie" required>
                <option selected></option>';
                foreach($data as $row){
                    $output .=
                    '<option value="'.$row['id'].'">'.$row['nom'].'</option>';
                }
            $output .=
            '</select>';
            echo $output;
        }else{
           echo '<h5 class="text-center text-danger">Pas de categorie dans le database</h5>';
        }
    }
    //afficher tout les  sous-categories dans un select sur le modal insert
    if(isset($_POST['action']) && $_POST['action'] == "afficherSouscategorie"){
        $output = '';
        $data = $prod->readSouscategorie();
        if($prod->totalSouscategorie()>0){
            $output .=
            '<label for="souscategorie-prt" class="text-white" >Sous-categorie :</label>
            <select name="souscategorie-prt" class="custom-select text-capitalize" id="selectSouscategorie" required>
                <option selected></option>';
                foreach($data as $row){
                    $output .=
                    '<option value="'.$row['id'].'">'.$row['nom'].'</option>';
                }
            $output .=
            '</select>';
            echo $output;
        }else{
           echo '<h5 class="text-center text-danger">Pas de sous-categorie dans le database</h5>';
        }
    }
    //Ajouter un produit
    if(isset($_POST['action']) && $_POST['action'] == 'add'){
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $DebutStock = $_POST['Stock'];
        $stock = $_POST['stock'];
        $fournisseur = $_POST['fournisseur-prt'];
        $categorie = $_POST['categorie-prt'];
        $souscategorie = $_POST['souscategorie-prt'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $photo = $_FILES['photo1'];
        
        $imagename ="";
        if(!empty($photo['name'])){
            $imagename = $prod-> uploadPhoto($photo);
            
            $produitData = [
                'nom' => $nom,
                'image' => $imagename,
                'prix' => $prix,
                'DebutStock' =>  $DebutStock,
                'stock' =>  $stock,
                'fournisseur_id' => $fournisseur,
                'categorie_id' => $categorie,
                'souscategorie_id' => $souscategorie,
                'description' => $description,
                'date' => $date,
            ];
        }

        $prodId = $prod->ajouter($produitData);
        if(!empty($prodId)){
            $produit = $prod->getProduitById($prodId);
            echo json_encode($produit); 
            exit();
        }
    }
    
    //Recuperer les valerurs selon id cliquer edit
     if(isset($_POST['edit_id'])){
        $id = $_POST['edit_id'];
        $row = $prod->getProduitById($id);
        echo json_encode($row);
        exit();
    }

    //afficher tout les donnes des fournisseurs sur un select dans le modal edit
    if(isset($_POST['action']) && $_POST['action'] == "afficherFournisseurEdit"){
        $output = '';
        $data = $prod->readFournisseur();
        if($prod->totalFournisseur()>0){
            $output .=
            '<label for="fournisseur-prtEdit" class="text-white">Fournisseur :</label>
            <select name="editfournisseur-prt" class="custom-select" id="select1" required>
                <option selected id="fournisseurdefinie" value=""></option>';
                foreach($data as $row){
                    $output .=
                    '<option value="'.$row['id'].'">'.$row['nom'].' '.$row['prenom'].'</option>';
                }
            $output .=
            '</select>';
            echo $output;
        }
    }

    //afficher tout les donnes des categories sur un select dans le modal edit
    if(isset($_POST['action']) && $_POST['action'] == "afficherCategorieEdit"){
        $output = '';
        $data = $prod->readCategorie();
        if($prod->totalCategorie()>0){
            $output .=
            '<label for="categorie-prtEdit" class="text-white">Categorie :</label>
            <select name="editcategorie-prt" class="custom-select" id="select2" required>
                <option selected id="categoriedefinie" value=""></option>';
                foreach($data as $row){
                    $output .=
                    '<option value="'.$row['id'].'">'.$row['nom'].'</option>';
                }
            $output .=
            '</select>';
            echo $output;
        }
    }

     //afficher tout les donnes des souscategories sur un select dans le modal edit
     if(isset($_POST['action']) && $_POST['action'] == "afficherSouscategorieEdit"){
        $output = '';
        $data = $prod->readSouscategorie();
        if($prod->totalSouscategorie()>0){
            $output .=
            '<label for="souscategorie-prtEdit" class="text-white">Sous-categorie :</label>
            <select name="editsouscategorie-prt" class="custom-select" id="select3" required>
                <option selected id="souscategoriedefinie" value=""></option>';
                foreach($data as $row){
                    $output .=
                    '<option value="'.$row['id'].'">'.$row['nom'].'</option>';
                }
            $output .=
            '</select>';
            echo $output;
        }
    }

    //update un produit
    if(isset($_POST['action']) && $_POST['action'] == 'modifier'){
        $id = $_POST['idModifier'];
        $nom = $_POST['nomedit'];
        $prix = $_POST['prixedit'];
        $DebutStock = $_POST['stockedit'];
        $stock = $_POST['stockedit'];
        $fournisseur = $_POST['editfournisseur-prt'];
        $categorie = $_POST['editcategorie-prt'];
        $souscategorie = $_POST['editsouscategorie-prt'];
        $description = $_POST['descriptionedit'];
        $date = $_POST['editdate'];
        $photo = $_FILES['photoEdit'];

        //validation
        $imagename ="";
        if(!empty($photo['name'])){
            $imagename = $prod-> uploadPhoto($photo);
            
            $produitData = [
                'nom' => $nom,
                'image' => $imagename,
                'prix' => $prix,
                'DebutStock' =>  $DebutStock,
                'stock' =>  $stock,
                'fournisseur_id' => $fournisseur,
                'categorie_id' => $categorie,
                'souscategorie_id' => $souscategorie,
                'description' => $description,
                'date' => $date,
            ];
        }else{
            $produitData = [
                'nom' => $nom,
                'prix' => $prix,
                'DebutStock' =>  $DebutStock,
                'stock' =>  $stock,
                'fournisseur_id' => $fournisseur,
                'categorie_id' => $categorie,
                'souscategorie_id' => $souscategorie,
                'description' => $description,
                'date' => $date,
            ];
        }

        echo $prod->update($produitData,$id);
    }

    //Recuperer les valerurs selon id cliquer delete
    if(isset($_POST['delete_id'])){
        $id = $prod->test_input($_POST['delete_id']);
        $row = $prod->getProduitById($id);
        echo json_encode($row);
        exit();
    }

    //supprimer le sous-categorie modifier
    if(isset($_POST['action']) && $_POST['action'] == "delete"){
        $id =  $prod->test_input($_POST['iddelete']);
        $prod->delete($id);   
    }

    //Recuperer les valerurs selon id cliquer view
    if(isset($_POST['view_id'])){
        $id = $_POST['view_id'];
        $row = $prod->getProduitById($id);
        echo json_encode($row);
        exit();
    }

    //afficher tout les produits dans des cards filtrer par le nom 
     if(isset($_POST['action']) && $_POST['action'] == "searchNom"){
        $textNom = $_POST['searchNom'];
        $output = '';
        $data = $prod->searchNom($textNom);
        if($prod->totalProduit()>0){
            $output .= 
            '<div id="flex-container" >
                <div class="ligne1">
                    <div class="card m-2 bg-secondary" id="ajouter-produit" data-toggle="modal" data-target="#addModal" style="width:150px;height:230px;">
                        <div class="card-body text-center">
                                <i class="fas fa-plus fa-5x  text-white m-3"></i>
                        </div>
                        <div class="card-footer">
                            <h6 class="text-center text-white">Ajouter Produit</h6>
                        </div>
                    </div>
                </div>';
            foreach($data as $row){
                $output .= 
                '<div class="ligne2">
                    <div class="card m-2 bg-white" id="produit" style="width:150px;height:230px;">
                        <img id="'. $row['id'].'" title="CLick pour voir le detail" class="card-img-top imageProdView" src="produit/uploads/'.$row['image'].'" data-toggle="modal" data-target="#viewModal" alt="image produit" width="149px" height="120px" style="cursor:pointer;">
                        <h5 id="prixcard"><span class="badge badge-danger ">'.$row['prix'].' $</span></h5>
                        <div class="card-body" style="padding:0px;">
                            <h5 class="d-flex justify-content-center"><span class="badge badge-info text-capitalize">'.$row['nom'].'</span></h5>
                            <p class="text-dark" style="margin:0px;">Stock : <span class="badge badge-pill badge-success ml-1">'.$row['stock'].'</span></p>
                            <div class="d-flex justify-content-end">
                                <a href="#" id="'. $row['id'].'" class="badge badge-pill badge-danger deletebtn" data-toggle="modal" data-target="#deleteModal" title="supprimet un produit"><i class="fas fa-trash text-white"></i></a>
                                <a href="#" id="'. $row['id'].'" class="badge badge-pill badge-warning mx-1 editbtn" data-toggle="modal" data-target="#editModal" title="modifier un produit"><i class="fas fa-edit  text-white"></i></a>
                            </div>
                        </div>
                        <div class="card-footer bg-dark justify-content-center"  style="padding:0px;">
                                <a href="commandep.php?id='. $row['id'].'" class="btn btn-outline-success text-white d-block btn-sm">
                                    <i class="fas fa-cart-plus fa-sm"></i> Commander
                                </a>
                        </div>
                    </div>
                </div>';
            }
            $output .=
            '</div>';
            echo $output;
        }else{
            $output .= 
            '<div class="row">
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="card my-2 bg-secondary" id="ajouter-produit" data-toggle="modal" data-target="#addModal" style="width:150px;height:230px;">
                        <div class="card-body text-center">
                                <i class="fas fa-plus fa-5x  text-white m-3"></i>
                        </div>
                        <div class="card-footer">
                            <h6 class="text-center text-white">Ajouter Produit</h6>
                        </div>
                    </div>
                </div>';
            $output .=
            '</div>';
            echo $output."</br>";
        }
    }

    //afficher tout les produits dans des cards filtrer par le prix 
    if(isset($_POST['action']) && $_POST['action'] == "searchPrix"){
        $textPrix = $_POST['searchPrix'];
        $output = '';
        $data = $prod->searchPrix($textPrix);
        if($prod->totalProduit()>0){
            $output .= 
            '<div id="flex-container" >
                <div class="ligne1">
                    <div class="card m-2 bg-secondary" id="ajouter-produit" data-toggle="modal" data-target="#addModal" style="width:150px;height:230px;">
                        <div class="card-body text-center">
                                <i class="fas fa-plus fa-5x  text-white m-3"></i>
                        </div>
                        <div class="card-footer">
                            <h6 class="text-center text-white">Ajouter Produit</h6>
                        </div>
                    </div>
                </div>';
            foreach($data as $row){
                $output .= 
                '<div class="ligne2">
                    <div class="card m-2 bg-white" id="produit" style="width:150px;height:230px;">
                        <img id="'. $row['id'].'" title="CLick pour voir le detail" class="card-img-top imageProdView" src="produit/uploads/'.$row['image'].'" data-toggle="modal" data-target="#viewModal" alt="image produit" width="149px" height="120px" style="cursor:pointer;">
                        <h5 id="prixcard"><span class="badge badge-danger ">'.$row['prix'].' $</span></h5>
                        <div class="card-body" style="padding:0px;">
                            <h5 class="d-flex justify-content-center"><span class="badge badge-info text-capitalize">'.$row['nom'].'</span></h5>
                            <p class="text-dark" style="margin:0px;">Stock : <span class="badge badge-pill badge-success ml-1">'.$row['stock'].'</span></p>
                            <div class="d-flex justify-content-end">
                                <a href="#" id="'. $row['id'].'" class="badge badge-pill badge-danger deletebtn" data-toggle="modal" data-target="#deleteModal" title="supprimet un produit"><i class="fas fa-trash text-white"></i></a>
                                <a href="#" id="'. $row['id'].'" class="badge badge-pill badge-warning mx-1 editbtn" data-toggle="modal" data-target="#editModal" title="modifier un produit"><i class="fas fa-edit  text-white"></i></a>
                            </div>
                        </div>
                        <div class="card-footer bg-dark justify-content-center"  style="padding:0px;">
                                <a href="commandep.php?id='. $row['id'].'" class="btn btn-outline-success text-white d-block btn-sm">
                                    <i class="fas fa-cart-plus fa-sm"></i> Commander
                                </a>
                        </div>
                    </div>
                </div>';
            }
            $output .=
            '</div>';
            echo $output;
        }else{
            $output .= 
            '<div class="row">
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="card my-2 bg-secondary" id="ajouter-produit" data-toggle="modal" data-target="#addModal" style="width:150px;height:230px;">
                        <div class="card-body text-center">
                                <i class="fas fa-plus fa-5x  text-white m-3"></i>
                        </div>
                        <div class="card-footer">
                            <h6 class="text-center text-white">Ajouter Produit</h6>
                        </div>
                    </div>
                </div>';
            $output .=
            '</div>';
            echo $output."</br>";
        }
    }

    //afficher tout les produits dans des cards filtrer par le fournisseur
    if(isset($_POST['action']) && $_POST['action'] == "searchFournisseur"){
        if($_POST['searchIdFournisseur']!= ""){
            $idFournisseur = $_POST['searchIdFournisseur'];
            $output = '';
            $data = $prod->searchFournisseur($idFournisseur);
            if($prod->totalProduit()>0){
                $output .= 
                '<div id="flex-container" >
                    <div class="ligne1">
                        <div class="card m-2 bg-secondary" id="ajouter-produit" data-toggle="modal" data-target="#addModal" style="width:150px;height:230px;">
                            <div class="card-body text-center">
                                    <i class="fas fa-plus fa-5x  text-white m-3"></i>
                            </div>
                            <div class="card-footer">
                                <h6 class="text-center text-white">Ajouter Produit</h6>
                            </div>
                        </div>
                    </div>';
                foreach($data as $row){
                    $output .= 
                    '<div class="ligne2">
                        <div class="card m-2 bg-white" id="produit" style="width:150px;height:230px;">
                            <img id="'. $row['id'].'" title="CLick pour voir le detail" class="card-img-top imageProdView" src="produit/uploads/'.$row['image'].'" data-toggle="modal" data-target="#viewModal" alt="image produit" width="149px" height="120px" style="cursor:pointer;">
                            <h5 id="prixcard"><span class="badge badge-danger ">'.$row['prix'].' $</span></h5>
                            <div class="card-body" style="padding:0px;">
                                <h5 class="d-flex justify-content-center"><span class="badge badge-info text-capitalize">'.$row['nom'].'</span></h5>
                                <p class="text-dark" style="margin:0px;">Stock : <span class="badge badge-pill badge-success ml-1">'.$row['stock'].'</span></p>
                                <div class="d-flex justify-content-end">
                                    <a href="#" id="'. $row['id'].'" class="badge badge-pill badge-danger deletebtn" data-toggle="modal" data-target="#deleteModal" title="supprimet un produit"><i class="fas fa-trash text-white"></i></a>
                                    <a href="#" id="'. $row['id'].'" class="badge badge-pill badge-warning mx-1 editbtn" data-toggle="modal" data-target="#editModal" title="modifier un produit"><i class="fas fa-edit  text-white"></i></a>
                                </div>
                            </div>
                            <div class="card-footer bg-dark justify-content-center"  style="padding:0px;">
                                    <a href="commandep.php?id='. $row['id'].'" class="btn btn-outline-success text-white d-block btn-sm">
                                        <i class="fas fa-cart-plus fa-sm"></i> Commander
                                    </a>
                            </div>
                        </div>
                    </div>';
                }
                $output .=
                '</div>';
                echo $output;
            }else{
                $output .= 
                '<div class="row">
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="card my-2 bg-secondary" id="ajouter-produit" data-toggle="modal" data-target="#addModal" style="width:150px;height:230px;">
                            <div class="card-body text-center">
                                    <i class="fas fa-plus fa-5x  text-white m-3"></i>
                            </div>
                            <div class="card-footer">
                                <h6 class="text-center text-white">Ajouter Produit</h6>
                            </div>
                        </div>
                    </div>';
                $output .=
                '</div>';
                echo $output."</br>";
            }
        }
    }

    //afficher tout les produits dans des cards filtrer par le categorie
    if(isset($_POST['action']) && $_POST['action'] == "searchCategorie"){
        if($_POST['searchIdCategorie']!= ""){
            $idCategorie = $_POST['searchIdCategorie'];
            $output = '';
            $data = $prod->searchCategorie($idCategorie);
            if($prod->totalProduit()>0){
                $output .= 
                '<div id="flex-container" >
                    <div class="ligne1">
                        <div class="card m-2 bg-secondary" id="ajouter-produit" data-toggle="modal" data-target="#addModal" style="width:150px;height:230px;">
                            <div class="card-body text-center">
                                    <i class="fas fa-plus fa-5x  text-white m-3"></i>
                            </div>
                            <div class="card-footer">
                                <h6 class="text-center text-white">Ajouter Produit</h6>
                            </div>
                        </div>
                    </div>';
                foreach($data as $row){
                    $output .= 
                    '<div class="ligne2">
                        <div class="card m-2 bg-white" id="produit" style="width:150px;height:230px;">
                            <img id="'. $row['id'].'" title="CLick pour voir le detail" class="card-img-top imageProdView" src="produit/uploads/'.$row['image'].'" data-toggle="modal" data-target="#viewModal" alt="image produit" width="149px" height="120px" style="cursor:pointer;">
                            <h5 id="prixcard"><span class="badge badge-danger ">'.$row['prix'].' $</span></h5>
                            <div class="card-body" style="padding:0px;">
                                <h5 class="d-flex justify-content-center"><span class="badge badge-info text-capitalize">'.$row['nom'].'</span></h5>
                                <p class="text-dark" style="margin:0px;">Stock : <span class="badge badge-pill badge-success ml-1">'.$row['stock'].'</span></p>
                                <div class="d-flex justify-content-end">
                                    <a href="#" id="'. $row['id'].'" class="badge badge-pill badge-danger deletebtn" data-toggle="modal" data-target="#deleteModal" title="supprimet un produit"><i class="fas fa-trash text-white"></i></a>
                                    <a href="#" id="'. $row['id'].'" class="badge badge-pill badge-warning mx-1 editbtn" data-toggle="modal" data-target="#editModal" title="modifier un produit"><i class="fas fa-edit  text-white"></i></a>
                                </div>
                            </div>
                            <div class="card-footer bg-dark justify-content-center"  style="padding:0px;">
                                    <a href="commandep.php?id='. $row['id'].'" class="btn btn-outline-success text-white d-block btn-sm">
                                        <i class="fas fa-cart-plus fa-sm"></i> Commander
                                    </a>
                            </div>
                        </div>
                    </div>';
                }
                $output .=
                '</div>';
                echo $output;
            }else{
                $output .= 
                '<div class="row">
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="card my-2 bg-secondary" id="ajouter-produit" data-toggle="modal" data-target="#addModal" style="width:150px;height:230px;">
                            <div class="card-body text-center">
                                    <i class="fas fa-plus fa-5x  text-white m-3"></i>
                            </div>
                            <div class="card-footer">
                                <h6 class="text-center text-white">Ajouter Produit</h6>
                            </div>
                        </div>
                    </div>';
                $output .=
                '</div>';
                echo $output."</br>";
            }
        }
    }

    //afficher tout les produits dans des cards filtrer par le souscategorie
    if(isset($_POST['action']) && $_POST['action'] == "searchSouscategorie"){
        if($_POST['searchIdSouscategorie']!= ""){
            $idSouscategorie = $_POST['searchIdSouscategorie'];
            $output = '';
            $data = $prod->searchSouscategorie($idSouscategorie);
            if($prod->totalProduit()>0){
                $output .= 
                '<div id="flex-container" >
                    <div class="ligne1">
                        <div class="card m-2 bg-secondary" id="ajouter-produit" data-toggle="modal" data-target="#addModal" style="width:150px;height:230px;">
                            <div class="card-body text-center">
                                    <i class="fas fa-plus fa-5x  text-white m-3"></i>
                            </div>
                            <div class="card-footer">
                                <h6 class="text-center text-white">Ajouter Produit</h6>
                            </div>
                        </div>
                    </div>';
                foreach($data as $row){
                    $output .= 
                    '<div class="ligne2">
                        <div class="card m-2 bg-white" id="produit" style="width:150px;height:230px;">
                            <img id="'. $row['id'].'" title="CLick pour voir le detail" class="card-img-top imageProdView" src="produit/uploads/'.$row['image'].'" data-toggle="modal" data-target="#viewModal" alt="image produit" width="149px" height="120px" style="cursor:pointer;">
                            <h5 id="prixcard"><span class="badge badge-danger ">'.$row['prix'].' $</span></h5>
                            <div class="card-body" style="padding:0px;">
                                <h5 class="d-flex justify-content-center"><span class="badge badge-info text-capitalize">'.$row['nom'].'</span></h5>
                                <p class="text-dark" style="margin:0px;">Stock : <span class="badge badge-pill badge-success ml-1">'.$row['stock'].'</span></p>
                                <div class="d-flex justify-content-end">
                                    <a href="#" id="'. $row['id'].'" class="badge badge-pill badge-danger deletebtn" data-toggle="modal" data-target="#deleteModal" title="supprimet un produit"><i class="fas fa-trash text-white"></i></a>
                                    <a href="#" id="'. $row['id'].'" class="badge badge-pill badge-warning mx-1 editbtn" data-toggle="modal" data-target="#editModal" title="modifier un produit"><i class="fas fa-edit  text-white"></i></a>
                                </div>
                            </div>
                            <div class="card-footer bg-dark justify-content-center"  style="padding:0px;">
                                    <a href="commandep.php?id='. $row['id'].'" class="btn btn-outline-success text-white d-block btn-sm">
                                        <i class="fas fa-cart-plus fa-sm"></i> Commander
                                    </a>
                            </div>
                        </div>
                    </div>';
                }
                $output .=
                '</div>';
                echo $output;
            }else{
                $output .= 
                '<div class="row">
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="card my-2 bg-secondary" id="ajouter-produit" data-toggle="modal" data-target="#addModal" style="width:150px;height:230px;">
                            <div class="card-body text-center">
                                    <i class="fas fa-plus fa-5x  text-white m-3"></i>
                            </div>
                            <div class="card-footer">
                                <h6 class="text-center text-white">Ajouter Produit</h6>
                            </div>
                        </div>
                    </div>';
                $output .=
                '</div>';
                echo $output."</br>";
            }
        }  
    }


?>