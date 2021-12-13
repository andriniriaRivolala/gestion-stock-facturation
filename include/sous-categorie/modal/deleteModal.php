
  <!--  Modal supprimer -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-lg">
        <form action="" method="POST" id="delete-form-data"> 
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-dark">Supprimer un sous-categorie</h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body bg-dark">
                    <input type="hidden" name="iddelete" id="iddelete">
                    <p class="alert alert-danger">Etes-vous sur de vouloir supprimer ?</p>  
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="">
                        <a href="#" class="btn btn-outline-secondary" id="nonSupprimer">Non</a>
                        <input type="submit" name="delete" id="delete" class="btn btn-outline-danger" value="Oui">
                    </div>
                </div>
                
            </div>
        </form> 
    </div>
</div>