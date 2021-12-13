<?php
        require_once "stock.php";
    
        $stock = new stock();

    //afficher tout les donnes des facture sur un tableau
    if(isset($_POST['action']) && $_POST['action'] == "afficher"){
        $output = '';
        $data = $stock->readStock();
        if($stock->totalStock()>0){
            $output .= 
            '<table class="table table-striped table-hover table-border table-sm table-dark">
                <tdead >
                    <tr>
                        <th class="text-info">ID</th>
                        <th class="text-info">Produit</th>
                        <th class="text-info">Quantité début</th>
                        <th class="text-info">Quantité Commander</th>
                        <th class="text-info">Quantité Restant</th>
                    </tr>
                </tdead>
                <tbody>';
                foreach($data as $row){
                    $output .= 
                    '<tr class="">
                        <td >'.$row['id'].'</td>
                        <td >'.$row['nom'].'</td>
                        <td >'.$row['DebutStock'].'</td>';
                        $cons = number_format($row['DebutStock'])-number_format($row['stock']);
                    $output .=
                        '<td  class="text-success">'.$cons.'</td>
                        <td class="text-warning">'.$row['stock'].'</td>
                    </tr>';    
                }
                $output .=
                ' </tbody>
            </table>' ;
            echo $output;
        }else{
            echo '<h3 class="text-center text-danger">Pas de Produit dans le database</h3>';
        }
    }
    
    //afficher le total stock
    if(isset($_POST['action']) && $_POST['action'] == "total"){
        $total = $stock->totalStock();
        echo  $total;  
    }
?>