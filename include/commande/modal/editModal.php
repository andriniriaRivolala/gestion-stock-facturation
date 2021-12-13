
<!--===============FORMULAIRE MODIFIER COMMANDE EN-ATTENTE==============-->
<div class ="modal fade" id="editModalCommande"> 
    <div class="modal-dialog modal-md" >

        <form method="POST" id="edit-form-data" enctype="multipart/form-data"  action="<?php echo htmlspecialchars("produit/edit.php"); ?>">
            <div class="modal-content">

                <!--Modal header -->
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Modifier un commande en-attente
                    <i class="fas fa-cube fa-sm"></i></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!--Modal body-->
                <div class="modal-body  bg-dark m-1">

                    <div class="row">
                        <input type="hidden" name="editdate" id="editdate" value="<?php echo date("Y/m/d"); ?>" >
                        <input type="hidden" name="editidProd" id="editidProd" value="<?php echo $_GET["id"]; ?>">

                        <div class="row text-white">
                            <div class="col-sm-6">
                                <!--Client-->
                                <div class="form-group mr-3">
                                    <label for="editnom">Client :</label>
                                    <div id="editselectAfficherClient">
                                        <!--SELECT POUR AFFICHER LES NOMS DES CLIENTS -->
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <!--Quantite-->
                                <div class="form-group mr-3">
                                    <label for="editquantiteC">Quantité :</label>
                                    <input type="number" name="editquantiteC" id="editquantiteC"  min="1" max=""  class="form-control form-control-sm  mx-2 " placeholder="Qunatité de produit" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!--stock-->
                                <div class="form-group mr-3">
                                    <label for="editstock">Stock :</label>
                                    <input type="number" name="editstock" id="editstock" value="" class="form-control form-control-sm bg-secondary text-white  mx-2" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!--Produit-->
                                <div class="form-group mr-3">
                                    <label for="editproduitC">Produit :</label>
                                    <input type="text"  name="editproduitC" id="editproduitC" value="" class="form-control form-control-sm bg-secondary text-white text-capitalize ml-2" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!--PU-->
                                <div class="form-group mr-3">
                                    <label for="editprixUC">PU :</label>
                                    <input type="number" name="editprixC" id="editprixC"  class="form-control form-control-sm bg-secondary text-white mx-2" disabled>
                                    <input type="hidden" name="editprixUC" id="editprixUC" /> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!--Total-->
                                <div class="form-group mr-3">
                                    <label for="totalCom">Total :</label>
                                    <input type="number" name="edittotalCom" id="edittotalCom"  class="form-control form-control-sm bg-secondary text-white  mx-2"  disabled>
                                </div>
                            </div>
                        </div> 
                    </div>     
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary  btn-block" id="editbtnTotal">Calcul de total</button>
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger">Fermer</button>
                    <input type="submit" name ="modifier" id="editmodifier" class="btn btn-outline-warning" value="modifier">
                    <input type="hidden" name="action" value="modifier">
                    <input type="hidden" name="idModifier" id="editidModifier" value="">
                </div>

            </div>

        </form>

    </div>  
</div>  
<!--===============FORMULAIREMODIFIER COMMANDE EN-ATTENTE FIN===============-->