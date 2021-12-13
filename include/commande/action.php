<?php
  
    require_once "commande.php";
    
    $comm = new commande();

    //afficher tout les donnes les clients sur un select
    if(isset($_POST['action']) && $_POST['action'] == "afficherClient"){
        $output = '';
        $data = $comm->readClient();
        if($comm->totalClient()>0){
            $output .=
            '<select name="client" class="custom-select custom-select-sm ml-2" id="select1" required>
                <option selected></option>';
                foreach($data as $row){
                    $output .=
                    '<option value="'.$row['id'].'" class="text-capitalize">'.$row['nom'].' '.$row['prenom'].'</option>';
                }
            $output .=
            '</select>';
            echo $output;
        }else{
           echo '<h6 class="text-center text-danger">Pas de client dans le database</h6>';
        }
    }

    //afficher le produit, prix unitaire, stock selon le commande de client
    //Recuperer les valerurs selon id cliquer de produit commander
    if(isset($_POST['idProd'])){
        $id = $_POST['idProd'];
        $row = $comm->getProduitById($id);
        echo json_encode($row);
    }
    
    //afficher tout les donnes des commandes en-attente sur un tableau
    if(isset($_POST['action']) && $_POST['action'] == "afficher"){
        $output = '';
        if($comm->totalCommande()>0){
            $output .= 
            '<form method="post" id="form-commande">
            <table class="table table-striped table-hover table-border table-sm table-dark">
                <thead >
                    <tr>
                        <th class="text-info">
                        
                        </th>
                        <th class="text-info">ID</th>
                        <th class="text-info">Date</th>
                        <th class="text-info">Produit</th>
                        <th class="text-info">Quantité</th>
                        <th class="text-info">P.U</th>
                        <th class="text-info">Total</th>
                    </tr>
                </thead>
                <tbody>';
                $data1 = $comm->readClientCommande();
                foreach($data1 as $row1){
                    $data = $comm->readCommmande($row1['client_id']);
                            $output .= 
                        '<tr>
                            <td></td>
                            <td></td>
                            <td class="text-center text-danger">Commande de <span class="text-warning">"'.$row1['nom'].' '.$row1['prenom'].'"</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>';
                        $total = 0;
                        foreach($data as $row){
                            $output .=     
                        '<tr>
                            <td id="boxCheck">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="'.$row['id'].'" name="checkbox[]" value="'.$row['id'].'">
                                    <label class="custom-control-label" for="'.$row['id'].'"></label>
                                </div>
                            </td>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['date'].'</td>
                            <td>'.$row['nom'].'</td>
                            <td>'.$row['quantite'].'</td>
                            <td>'.$row['prix'].'</td>
                            <td>'.$row['total'].' $</td>';
                            $total += $row['total']; 
                            $output .= 
                        '</tr>';    
                        }
                        $output .= 
                        '<tr>
                            <td>  
                            </td>
                            <td></td>
                            <td class="text-center text-info"> Fin de commande</td>
                            <td></td>
                            <td></td>
                            <td > 
                                <span class="btn btn-info"> Total </span> 
                            </td>
                            <td>
                                <span class="btn btn-danger">'.$total.' $</span> 
                            </td>
                        </tr>'; 
                }
                $output .=
                '</tbody>
            </table>  
            <div class=" my-2" id="btn-flex">
                <div class="ligne2 m-2">
                    <div class="custom-control custom-checkbox" id="checkToutLink">
                    <input type="checkbox" class="custom-control-input" id="checkTout" name="checkbox">
                    <label class="custom-control-label" for="checkTout" >Tout</label>
                </div>
                </div> 
                <div class="ligne2 m-2">    
                    <button class="btn btn-outline-danger btn-sm " id="delete" title="Supprimer commande"><i class="fas fa-trash"></i> Supprimer</button>
                </div>
                <div class="ligne3 m-2">
                    <button id="commandeEdit" data-toogle="modal" data-target="#editModalCommande" class="btn  btn-outline-warning btn-sm" title="Modifier commande"><i class="fas fa-pencil-alt"></i> Modifier</button>
                </div>
                <div class="ligne4 m-2"> 
                    <button class="btn  btn-outline-success btn-sm" id="valider" title="Valider commande"> <i class="fas fa-check"></i> Valider </button>
                </div>
            </div>
            </form>' ;
            echo $output;
        }else{
            echo '<h3 class="text-center text-danger">Pas de commande en-attente dans le database</h3>';
        }
    }
    
    //afficher le total commande
    if(isset($_POST['action']) && $_POST['action'] == "total"){
         $total = $comm->totalCommande(); 
         echo $total;  
    }

    //afficher tout les donnes des commandes valider sur un tableau
    if(isset($_POST['action']) && $_POST['action'] == "afficherValider"){
        $output = '';
        if($comm->totalCommandeValider()>0){
            $output .= 
            '<form method="post" id="form-commande-valider">
                <table class="table table-striped table-hover table-border table-sm table-dark">
                <thead >
                    <tr>
                        <th class="text-info">Client</th>
                        <th class="text-info">ID</th>
                        <th class="text-info">Date</th>
                        <th class="text-info">Produit</th>
                        <th class="text-info">Quantité</th>
                        <th class="text-info">Prix</th>
                        <th class="text-info">Facturer</th>
                    </tr>
                </thead>
                <tbody>';
                $data2 = $comm->readClientCommandeValider();
                foreach($data2 as $row2){
                    $data = $comm->readCommmandeValider($row2['client_id']);
                    $output .= 
                    '<tr class="">
                        <td class="text-warning">';
                            $output .= $row2['nom'].' '.$row2['prenom'];
                            $output .=
                        '</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>';
                    foreach($data as $row){
                         $output .= 
                    '<tr>
                        <td></td>
                        <td>' .$row['id'].'</td>
                        <td>' .$row['date'].'</td>
                        <td>'.$row['nom'].'</td>
                        <td>'.$row['quantite'].'</td>
                        <td>'.$row['total'].'</td>
                        <td>';
                            if($row['facturer'] == "0"){
                                $output .= 
                                '<a href="#" id="'. $row['id'].'"  class="btn btn-sm btn-outline-success btn-block addfacturebtn"  title="Ajouter un commande valider au facture" > facturer</a>';
                            }else{
                                $output .= 
                                '<span id="'. $row['id'].'"  class="btn btn-sm btn-danger btn-block"  title="Déja facture" > <i class="fas fa-check"></i></span>';
                            }
                            $output .= 
                        '</td>
                    <tr>'; 
                    }
                    $total = 0;
                    foreach($data as $row){
                        $total += $row['total']; 
                    }
                    $output .= 
                    '<tr class="">
                        <td class="text-center text-info"> Fin de commande</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <span class="btn btn-info"> Total </span> 
                        </td>
                        <td>
                            <span class="btn btn-danger">'.$total.' $</span> 
                        </td>
                        <td>
                            <a href="../facture.php" id="'.$row2['client_id'].'" class="btn btn-outline-success btn-block addfacturesbtn">Tout facturer</button></a>
                        </td>
                    </tr>';    
                }
                $output .=
                ' </tbody>
            </table>  
            </form>' ;
            echo $output;
        }else{
            echo '<h3 class="text-center text-danger">Pas de commande valider dans le database</h3>';
        }
    }
    
    //afficher le total commande valider
    if(isset($_POST['action']) && $_POST['action'] == "totalValider"){
         $total = $comm->totalCommandeValider(); 
         echo $total;  
    }
    
    //insert un nouveau commande
    if(isset($_POST['action']) && $_POST['action'] == "addCommande"){
        $date = $client = $produit = $quantite = $PU = "";

        $date = $comm->test_input($_POST['date']);
        $client = $comm->test_input($_POST['client']);
        $produit = $comm->test_input($_POST['idProd']);
        $quantite = $comm->test_input($_POST['quantiteC']);
        $PU = $comm->test_input($_POST['prixUC']);

        $commande = $comm->insert($date, $client,$produit,$quantite,$PU); 
        echo json_encode($commande);
    }

    //supprimer commande 
     if(isset($_POST['action']) && $_POST['action'] == "delete"){
        if(isset($_POST['checkbox'][0])){
            foreach($_POST['checkbox'] as $id){
                $comm->delete($id);
            }
        }
    }
    
    // modifier commande par le client, le produit, la quantite
    if(isset($_POST['action']) && $_POST['action'] == "modifier"){
        if(isset($_POST['checkbox'][0])){
            if(isset( $_POST['quantite']) && isset( $_POST['client']) && isset( $_POST['produit'])){
                $quantite = $_POST['quantite'];
                $clientId = $_POST['client'];
                $produitId = $_POST['quantite'];

                $comm-> update_CommandeEnAttente($clientId, $produitId, $quantite,$id);
            } 
            elseif (isset( $_POST['quantite']) && isset( $_POST['quantite'])) {
                $quantite = $_POST['quantite'];
                $clientId = $_POST['client'];
                $produitId = $_POST['quantite'];

                $comm-> update_CommandeEnAttente($clientId, $produitId, $quantite,$id);
            }
        }
    }

    //Valider lr commande en attente (ajouter au commmande valider) 
    if(isset($_POST['action']) && $_POST['action'] == "valider"){
        if(isset($_POST['checkbox'][0])){
            foreach($_POST['checkbox'] as $id){
                $date =  date("d/m/Y");
                $lastId = $comm->insertCommandeValider($id);
                $comm->delete($id);
            }
        }
    }

    //insert un nouveau facture
    if(isset($_POST['action']) && $_POST['action'] == "addfacture"){
        $date = $idCommande="";
        $_POST['com_vald_Id'];
        $idCommande = $_POST['com_vald_Id'];
        $date =  date("Y/m/d");
        $comm->insertFacture($date,$idCommande);
    }
    
    //insert des nouveaux factures
    if(isset($_POST['action']) && $_POST['action'] == "addfactures"){
        $date = $commandevaliderId ="";
        echo $comm->test_input($_POST['com_vald_Cli_Id']);

    }

   
?>