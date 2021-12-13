 <!--  Modal supprimer -->
 <div class="modal fade" id="deleteModal">
    <div class="modal-dialog ">
        <form action="" method="POST" id="delete-form-data"> 
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-dark">
                <h4 class="modal-title text-danger">Supprimer un produit</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body ">
                    <p class="alert alert-danger">Etes-vous sur de vouloir supprimer ?</p>  
                </div>
                    
                <!-- Modal footer -->
                <div class="modal-footer bg-dark">
                <div class="">
                            <a href="#" class="btn btn-outline-secondary" id="nonSupprimer">Non</a>
                            <button id="deleteConf" class="btn btn-outline-danger">Oui</button>
                        </div>
                </div>       
            
            </div>
        </form> 
    </div>
</div>