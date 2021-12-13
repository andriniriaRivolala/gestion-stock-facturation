<!--===============FORMULAIRE VIEW DETAIL DE FACTURE===============-->
<div class ="modal fade" id="viewModal"> 
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">

            <!--Modal header -->
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-white text-capitalize" id="nomview"></h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <!--Modal body-->
            <div class="modal-body" id="corpsImprimer">
                <div class="card m-2  border border-white">
                    <div class="card-header">                 
                        <h4 class="text-md text-info" >FACTURE :</h4>                      
                    </div>
                    <!--card body-->
                    <div class="card-body ">
                        <div class="row">

                            <div class="col-md-6 mb-2">
                                <!--Client-->
                                <h5 class="font-italic text-info">Client :</h5> 
                                <span class="font-weight-bold"> Nom: </span> <span id="clientNom" class="text-capitalize"></span> </br>
                                <span class="font-weight-bold">Prenom: </span>  <span id="clientPrenom" class="text-capitalize"></span> </br>
                                <span class="font-weight-bold">Adresse: </span> <span id="clientAddress"></span> </br>
                                <span class="font-weight-bold">N° de télephone : </span> <span id="clientTel"></span></br>
                                <span class="font-weight-bold">Email : </span> <span id="clientEmail"></span> </br>
                            </div>

                            <div class="col-md-6">
                            <h5 class="font-italic text-info">Facture</h5> 
                                <table class="table table-bordered table-sm w-75">
                                    <tbody>
                                        <tr>
                                            <th class="bg-light">N° de facture </th>
                                            <td class="pl-2" id="factureId"></td>                                         
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Date de la facture</th>
                                            <td class="pl-2" id="factureDate"></td>                                         
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Date déchéance </th>
                                            <td class="pl-2"><?php echo date("Y/m/d") ?></td>                                         
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-12">
                                <span class="font-weight-bold ">Facturer à:</span>  <span id="clientNomPrenom" class="text-black"></span>
                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Description</th>
                                                <th>Quantité</th>
                                                <th>Prix unitaire</th>
                                                <th>Montant</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="description"></td>
                                                <td id="quantite" ></td>
                                                <td id="prixUnitaire"></td>
                                                <td id="Montant"></td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <th></th>
                                                <th ></th>
                                                <th class="text-center">Total</th>
                                                <th id="factureTotal"></th>
                                            </tr>  
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Modal footer-->
            <div class="modal-footer bg-dark">
                <button class="btn btn-info" id="imprimer">imprimer</button>
            </div>
        </div> <!-- modal-content-->
    </div>  
</div>  
<!--===============FORMULAIRE VIEW PRODUIT FIN===============-->