<?php
    require_once "payement.php";

    $pay = new payement();

    //afficher tout les donnes des facture à payer sur un tableau
    if(isset($_POST['action']) && $_POST['action'] == "afficher"){
        $output = '';
        $data = $pay->readPayement();
        if($pay->totalPayement()>0){
            $output .= 
            '<form method="post" id="form-facture">
                <table class="table table-striped table-hover table-border table-sm table-dark" id="tablePayement">
                <tdead >
                    <tr>
                        <th class="text-success">ID</th>
                        <th class="text-success">Client</th>
                        <th class="text-success">Date</th>
                        <th class="text-success">Id Facture</th>
                        <th class="text-success">Id Commande</th>
                        <th class="text-success">Total</th>
                    </tr>
                </tdead>
                <tbody>';
                $total = 0;
                foreach($data as $row){
                    $output .= 
                    '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['client'].'</td>
                        <td>'.$row['date'].'</td>
                        <td>'.$row['factureId'].'</td>
                        <td>'.$row['commandeValiderId'].'</td>
                        <td>'.$row['total'].'</td>';
                        $total += $row['total'];
                        $output .= 
                    '</tr>';    
                }
                $output .=
                    '<tr class="">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <span class="btn btn-info d-block"> Prix total de vente </span> 
                        </td>
                        <td>
                            <span class="btn btn-danger">'.$total.' $</span> 
                        </td>
                    </tr>   
                </tbody>
            </table>
            </form>' ;
            echo $output;
        }else{
            echo '<h3 class="text-center text-danger">Pas de payement dans le database</h3>';
        }
    }
    
    //afficher le nombre total des factures à payer
    if(isset($_POST['action']) && $_POST['action'] == "total"){
        $total = $pay->totalPayement(); 
        echo $total;  
    }

    