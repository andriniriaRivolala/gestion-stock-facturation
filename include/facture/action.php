<?php
        require_once "facture.php";
    
        $fact = new facture();

    //afficher tout les donnes des facture sur un tableau
    if(isset($_POST['action']) && $_POST['action'] == "afficher"){
        $output = '';
        $data = $fact->readFacture();
        if($fact->totalFacture()>0){
            $output .= 
            '<form method="post" id="form-facture">
             <table id="tablefacture" class="table table-striped table-hover table-border table-sm table-dark">
                <tdead >
                    <tr>
                        <th class="text-info">
                        </th>
                        <th class="text-info">ID</th>
                        <th class="text-info">Client</th>
                        <th class="text-info">Date</th>
                        <th class="text-info">Commande concerner</th>
                        <th class="text-info">Action</th>
                    </tr>
                </tdead>
                <tbody>';
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
                        <td>'.$row['client'].'</td>
                        <td>'.$row['date'].'</td>
                        <td>'.$row['commandeValiderId'].'</td>
                        <td>
                            <a href="#" id="'.$row['id'].'" class="voirDetailID" data-toggle="modal" data-target="#viewModal"  title="détail de commande">
                                <i class="fas fa-eye fa-lg text-success"></i>
                            </a>
                            <a href="#" id="'.$row['id'].'" class="pdfID">
                                <i class="fas fa-file fa-lg text-warning" titlte="pdf"></i>
                            </a>';
                            if($row['payer'] == "0"){
                                $output .=
                                '<a href="#" id="'.$row['id'].'" class="btn btn-sm btn-danger payer">
                                    <i class="far fa-credit-card" title="payer"></i>
                                </a>';
                            }else{
                                $output .=
                                '<span id="'. $row['id'].'"  class="btn btn-sm btn-success"  title="Déja facture" >
                                     <i class="fas fa-check"></i>
                                 </span>';
                            }
                            $output .=
                        '</td>
                    </tr>';    
                }
                $output .=
                ' </tbody>
            </table>
            <div class=" my-2" id="btn-flex">
                <div class="ligne1 m-2">
                    <div class="custom-control custom-checkbox" id="checkToutLink">
                        <input type="checkbox" class="custom-control-input" id="checkTout" name="checkbox">
                        <label class="custom-control-label" for="checkTout">Tout</label>
                    </div>
                </div>
                <div class="ligne2 m-2">   
                    <button class="btn btn-outline-danger btn-sm" id="delete" title="supprimer le facture"><i class="fas fa-trash"></i> Supprimer</button>
                </div>
                <div class="ligne3 m-2">
                    <a href="../include/payment.php" class="btn  btn-outline-info btn-sm" id="payer" title="payer le facture" > <i class="far fa-credit-card fa-lg "></i> Payement</a>
                </div>
            </div>
            </form>' ;
            echo $output;
        }else{
            echo '<h3 class="text-center text-danger">Pas de facture dans le database</h3>';
        }
    }
    
    //afficher le total facture
    if(isset($_POST['action']) && $_POST['action'] == "total"){
        $total = $fact->totalFacture(); 
        echo $total;  
    }

    //Recuperer les valerurs selon id cliquer view
    if(isset($_POST['view_id'])){
        $id = $_POST['view_id'];
        $row = $fact->getFactureById($id);
        echo json_encode($row);
        exit();
    }

    //supprimer facture 
    if(isset($_POST['action']) && $_POST['action'] == "delete"){
        if(isset($_POST['checkbox'][0])){
            foreach($_POST['checkbox'] as $id){
                $fact->delete($id);
            }
        }
    }

    //payement facture
    if(isset($_POST['action']) && $_POST['action'] == "payement"){
        $id = $_POST['fact_id'];
        $fact->insertpayement($id);
    }

    if(isset($_POST['action']) && $_POST['action'] == "payements"){
        if(isset($_POST['checkbox'][0])){
            foreach($_POST['checkbox'] as $id){
                $fact->insertpayement($id);
            } 
        }
    }


?>