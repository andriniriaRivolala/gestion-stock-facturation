<?php
  
    require_once "sous-categorie.php";
    
    $souscat = new souscategorie();

    //afficher tout les donnes des categories sur un select
    if(isset($_POST['action']) && $_POST['action'] == "afficherCategorie"){
        $output = '';
        $data = $souscat->readCategorie();
        if($souscat->totalCategorie()>0){
            $output .=
            '<select name="categorie-parente" class="custom-select" id="select1" required>
                <option selected></option>';
                foreach($data as $row){
                    $output .=
                    '<option value="'.$row['id'].'">'.$row['nom'].'</option>';
                }
            $output .=
            '</select>';
            echo $output;
        }else{
           echo '<h4 class="text-center text-danger">Pas de categorie dans le database</h4>';
        }
    }
    
    //afficher tout les donnes des sous-categories sur un tableau
    if(isset($_POST['action']) && $_POST['action'] == "afficher"){
        $output = '';
        $data = $souscat->readSousCategorie();
        if($souscat->totalsouscategorie()>0){
            $output .= 
            '<table class="table table-striped table-hover table-border table-sm table-dark">
                <thead>
                    <tr>
                        <th class="text-info">ID</th>
                        <th class="text-info">Sous-categorie</th>
                        <th class="text-info">Categorie parente</th>
                        <th class="text-info">Action</th>
                    </tr>
                </thead> 
                <tbody>';
                foreach($data as $row){
                    $output .= 
                    '<tr>
                        <td class="text-white">'.$row['id'].'</td>
                        <td class="text-white">'.$row['nom'].'</td>
                        <td class="text-white">'.$row['category'].'</td>
                        <td class="">
                            <a href="#" id="'. $row['id'].'" class="btn btn-outline-warning btn-block editbtn" data-toggle="modal" data-target="#editModal" title="modifier un categorie" ><i class="fas fa-pencil-alt" id="icon"></i> Modifier</button></a>
                        </td>
                        <td class="">
                            <a href="#" id="'. $row['id'].'" class="btn btn-outline-danger btn-block deletebtn" data-toggle="modal" data-target="#deleteModal" title="supprimer un categorie"><i class="fas fa-trash" id="icon"></i> Supprimer</button></a>
                        </td>
                    </tr>';    
                }
                $output .=
                ' </tbody>
            </table>';
            echo $output;
        }else{
           echo '<h3 class="text-center text-danger">Pas de sous-categorie dans le database</h3>';
        }
    }
    
    //afficher le total sous-categorie
    if(isset($_POST['action']) && $_POST['action'] == "total"){
         $total = $souscat->totalsouscategorie(); 
         echo $total;  
    }

    
    //insert un nouveau sous-categorie
    if(isset($_POST['action']) && $_POST['action'] == "insert"){
        $nom = $souscat->test_input($_POST['nom']);
        $categorieParent = $souscat->test_input($_POST['categorie-parente']);

        $souscat->insert($nom,$categorieParent);   
    }
    
    //afficher tout les donnes des categories sur un select dans le modal edit
    if(isset($_POST['action']) && $_POST['action'] == "afficherCategorieedit"){
        $output = '';
        $data = $souscat->readCategorie();
        if($souscat->totalCategorie()>0){
            $output .=
            '<select name="editcategorie-parente" class="custom-select" id="select2" required>
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

    //Recuperer les valerurs selon id cliquer edit
    if(isset($_POST['edit_id'])){
        $id = $souscat->test_input($_POST['edit_id']);
        $row = $souscat->getsouscategorieById($id);
        echo json_encode($row);
    }

    //insert le sous-categorie modifier
    if(isset($_POST['action']) && $_POST['action'] == "modifier"){
        $id =  $souscat->test_input($_POST['idedit']);
        $nom = $souscat->test_input($_POST['nomedit']);
        $categorieParent = $_POST['editcategorie-parente'];
        
        $souscat->update($nom,$categorieParent,$id);   
    }

    //Recuperer les valerurs selon id cliquer delete
    if(isset($_POST['delete_id'])){
        $id = $souscat->test_input($_POST['delete_id']);
        $row = $souscat->getsouscategorieById($id);
        echo json_encode($row);
    }

    //supprimer le sous-categorie modifier
    if(isset($_POST['action']) && $_POST['action'] == "delete"){
        $id =  $souscat->test_input($_POST['iddelete']);
        $souscat->delete($id);   
    }
?>