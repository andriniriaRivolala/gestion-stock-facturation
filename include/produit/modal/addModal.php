<!--===============FORMULAIRE AJOUTER PRODUIT===============-->
<div class ="modal fade" id="addModal"> 
    <div class="modal-dialog" >
        <form method="POST" id="addform" enctype="multipart/form-data">
            
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success">Ajouter Un Produit 
                    <i class="fas fa-cube fa-sm"></i></h5>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body bg-dark">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <!--Nom-->
                            <div class="form-group">
                                <label for="nom" class="text-white">Nom :</label>
                                <input type="text"  name="nom" id="nom" minlenght="2" class="form-control form-control-sm" placeholder="Nom du produit" required>
                            </div>
                        </div> 
                        <div class="col-md-6 col-sm-6">
                            <!--prix-->
                            <div class="form-group">
                                <label for="prix" class="text-white">Prix :</label>
                                <input type="number" name="prix" id="prix" min="0" class="form-control form-control-sm" placeholder="Prix de produit" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <!--stock-->
                            <div class="form-group">
                                <label for="stock" class="text-white">Stock :</label>
                                <input type="number" name="stock" id="stock" min="0" class="form-control form-control-sm" placeholder="Quantité en stock" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6" id="categorieParent2">
                            <!--AFFICHER LES CATEGORIES PARENT DANS UN SELECT-->
                        </div> 
                        <div class="col-md-6 col-sm-6" id="souscategorieParent2">
                            <!--AFFICHER LES SOUS-CATEGORIES PARENT DANS UN SELECT-->
                        </div> 
                        <div class="col-md-6 col-sm-6" id="fournisseurParent2">
                            <!--AFFICHER LES FOURNISSEURS PARENTE DANS UN SELECT-->
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <!--Description-->
                            <label for="categorie" class="text-white">Description :</label>
                            <textarea  id="description" name="description" class="form-control form-control-sm" required="required" rows="5" cols="12"></textarea>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="date" class="text-white mr-1">Date :</label>
                                <input type="date" class="form-control form-control-sm" name="date" id="date" required>
                            </div> 
                        </div>
                        <!--Photo-->
                        <div class="col-md-12 my-1">
                            <div class="form-group">
                                <label for="photo1" class="text-white">Photo:</label>
                                <input type="file" class="form-control-file text-white" name="photo1" id="photo1" required>
                            </div>
                        </div> 
                    </div>       
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger">Fermer</button>
                    <input type="submit" class="btn btn-outline-success" name ="add" id="add" value="insert">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="prodid" id="prodid" value="">    
                </div>
            </div> 

        </form>  
    </div>  
</div>  
<!--===============FORMULAIRE AJOUTER PRODUIT FIN===============-->