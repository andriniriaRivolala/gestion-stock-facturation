<?php
  
    require_once "categorie.php";

    $cat = new categorie();
    
    //afficher tout les donnes des categories sur un tableau
    if(isset($_POST['action']) && $_POST['action'] == "afficher"){
        $output = '';
        $data = $cat->read();
        if($cat->totalCategorie()>0){
            $output .= 
            '<table class="table table-striped table-dark table-sm">
                <thead>
                    <tr>
                        <th class="text-info">ID</th>  
                        <th class="text-info">Categorie</th>
                        <th class="text-info">Modifier</th>
                        <th class="text-info">Supprimer</th>
                    </tr>
                </thead> 
                <tbody>';
                foreach($data as $row){
                    $output .= 
                    '<tr>
                        <td>'. $row['id'].'</td>
                        <td>'.$row['nom'].'</td>
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
           echo '<h3 class="text-center text-danger">Pas de categorie dans le database</h3>';
        }
    }
    
    //afficher le total des categories
    if(isset($_POST['action']) && $_POST['action'] == "total"){
         $total = $cat->totalCategorie(); 
         echo $total;  
    }

    
    //insert un nouveau categorie
    if(isset($_POST['action']) && $_POST['action'] == "insert"){
        $nom = $cat->test_input($_POST['nom']);
        $cat->insert($nom);   
    }
     
    //Recuperer les valerurs selon id cliquer edit
    if(isset($_POST['edit_id'])){
        $id = $cat->test_input($_POST['edit_id']);
        $row = $cat->getCategorieById($id);
        echo json_encode($row);
    }

    //insert le categorie modifier
    if(isset($_POST['action']) && $_POST['action'] == "modifier"){
        $id =  $cat->test_input($_POST['idedit']);
        $nom = $cat->test_input($_POST['nomedit']);
        $cat->update($nom,$id);   
    }

    //Recuperer les valerurs selon id cliquer delete
    if(isset($_POST['delete_id'])){
        $id = $cat->test_input($_POST['delete_id']);
        $row = $cat->getCategorieById($id);
        echo json_encode($row);
    }

      //Supprimer un categorie 
      if(isset($_POST['action']) && $_POST['action'] == "delete"){
        $id =  $cat->test_input($_POST['iddelete']);
        $cat->delete($id);   
    }
?>

