
<!--===============FORMULAIRE MODIFIER PRODUIT===============-->
<div class ="modal fade" id="editModal"> 
    <div class="modal-dialog modal-md" >

        <form method="POST" id="edit-form-data" enctype="multipart/form-data"  action="<?php echo htmlspecialchars("produit/edit.php"); ?>">
            <div class="modal-content">

                <!--Modal header -->
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Modifier Un Produit 
                    <i class="fas fa-cube fa-sm"></i></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!--Modal body-->
                <div class="modal-body  bg-dark">

                    <div class="row">
                        <div class="col-md-12 form-control-inline d-flex justify-content-center">
                            <label for="editdate" class="text-white mr-1">Date:</label>
                            <input type="date" name="editdate" id="editdate" class="form-control form-control-sm w-50">
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex flex-column my-2">
                                <img src="" id="imageProdED" alt="image de Produit" class="mx-auto d-block" width="100" height="100">
                                <span class="text-white text-center" id="imageEditNom"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-center">   
                                <!--Photo-->
                                <div class="input-group mb-1">
                                    <input type="file" class="form-control-file text-white" name="photoEdit" id="photoEdit">
                                </div> 
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <!--Nom-->
                            <div class="form-group">
                                <label for="nomedit" class="text-white">Nom:</label>
                                <input type="text"  name="nomedit" id="nomedit" class="form-control form-control-sm" placeholder="Nom du produit">
                            </div>
                        </div> 
                        <div class="col-md-6">
                                <!--prix-->
                                <div class="form-group">
                                <label for="prixedit" class="text-white">Prix:</label>
                                <input type="number" name="prixedit" id="prixedit" min="0" class="form-control form-control-sm" placeholder="Quantité en stock">
                            </div>
                        </div>
                        <div class="col-md-6">
                                <!--stock-->
                                <div class="form-group">
                                <label for="stockedit" class="text-white">Stock:</label>
                                <input type="number" name="stockedit" id="stockedit" min="0" class="form-control form-control-sm" placeholder="Quantité en stock">
                            </div>
                        </div>
                        <div class="col-md-6" id="categorieParentEdit">
                            <!--AFFICHER LES CATEGORIES DANS UN SELECT SUR MODAL EDIT-->
                        </div> 
                        <div class="col-md-6" id="souscategorieParentEdit">
                            <!--AFFICHER LES SOUS-CATEGORIES DANS UN SELECT SUR MODAL EDIT-->
                        </div> 
                        <div class="col-md-6" id="fournisseurParentEdit">
                            <!--AFFICHER LES FOURNISSEURS DANS UN SELECT SUR MODAL EDIT-->
                        </div>
                        <div class="col-md-6">
                            <!--Description-->
                            <label for="categorie" class="text-white">Description:</label>
                            <textarea  id="descriptionedit" name="descriptionedit" class="form-control form-control-sm" required="required" rows="5" cols="12"></textarea>
                        </div> 
                    </div>       
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger">Fermer</button>
                    <input type="submit" name ="modifier" id="modifier" class="btn btn-outline-warning" value="modifier">
                    <input type="hidden" name="action" value="modifier">
                    <input type="hidden" name="idModifier" id="idModifier" value="">
                </div>

            </div>

        </form>

    </div>  
</div>  
<!--===============FORMULAIRE MODIFIER PRODUIT FIN===============-->