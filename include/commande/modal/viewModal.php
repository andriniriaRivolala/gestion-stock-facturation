<!--===============FORMULAIRE VIEW PRODUIT===============-->
<div class ="modal fade" id="viewModal"> 
    <div class="modal-dialog modal-md" >
        <div class="modal-content">

            <!--Modal header -->
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-white text-capitalize" id="nomview"></h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-5">
                        <img src="" alt="image de produit" id="imageviewed" width="150" height="150" class="mx-auto d-block mr-1">
                    </div>
                    <div class="col-md-7 col-7">
                        <h6 class="text-dark">Date de depot : <span id="dateview" class="text-info"></span></h6>
                        <h6 class="text-dark" >Prix Unitaire : <span id="prixview" class="text-info"></span></h6>
                        <h6 class="text-dark" >Nombre en stock : <span id="stockview" class="text-info "></span></h6>
                        <h6 class="text-dark" >Fouurnisseur : <span id="fournisseurview" class="text-info text-capitalize"></span></h6>
                        <h6 class="text-dark" >Categorie : <span id="categorieview" class="text-info text-capitalize"></span></h6>
                        <h6 class="text-dark" >Sous-categorie : <span id="souscategorieview" class="text-info text-capitalize"></span></h6>
                    </div>
                    <div class="col-md-12">
                        <h6 class="text-dark" >Description :</h6>
                        <div class="form-control bg-dark">
                            <p id="descriptionview" class="text-white"></p>
                        </div>
                    </div>
                </div>       
            </div> 

        </div> 
    </div>  
</div>  
<!--===============FORMULAIRE VIEW PRODUIT FIN===============-->