<!--Modal edit -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
        <form action="" method="POST" id="edit-form-data">
            <div class="modal-content">
      
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Modifier un categorie</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-bod bg-dark p-2">
                    <input type="hidden" name="idedit" id="idedit">
                    <!--Nom--> 
                    <div class="form-group">
                        <label for="nom" class="text-white">Nom : </label>
                        <input type="text" id="nomedit" name="nomedit" class="form-control" minlength="2" width="100" required>                        
                    </div>                                
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" name ="modifier" id="modifier" class="btn btn-outline-success" data-dismiss="modal" value="Modifier">
                </div>

            </div>
        </form>
    </div>
</div>