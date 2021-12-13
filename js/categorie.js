var jq = $.noConflict();
jq(document).ready(function(){
    
    afficherToutCategories();
    //fonction pour afficher les categories
    function afficherToutCategories(){
        jq.ajax({
            url: "categorie/action.php",
            type: "POST",
            data: {action: "afficher"},
            success:function(response){
                jq("#afficherToutCategorie").html(response);
                totalCategories();
            } 
        });
    }

    //fonction affichr le total categorie
    function totalCategories(){
        jq.ajax({
            url: "categorie/action.php",
            type: "POST",
            data: {action: "total"},
            success:function(response){
                jq("#totalCategories").html(response);
            } 
        });
    }

    /** CREATE UN CATEGORIE */
    //insert un categorie
    jq("#insert").on("click",function(e){
        if(jq("#form-data")[0].checkValidity()){
            e.preventDefault();
            jq.ajax({
                url: "categorie/action.php",
                type: "POST",
                data: jq("#form-data").serialize()+"&action=insert",
                beforesend: function(){

                },
                success:function(response){
                    console.log(response);
                    swal.fire({
                        icon:'success',
                        title: 'Un nouveau categorie est ajouter',
                        type: 'success'
                    })
                    jq("#form-data")[0].reset();
                    afficherToutCategories();
                },
                error: function(){
                    console.log("Opps error");
                }  
            });
        }
    });
    /** FIN CREATE UN CATEGORIE */

    /** EDIT UN CATEGORIE */
    //edit a categorie donner les valeurs de id
    jq("body").on("click",".editbtn",function(e){
       e.preventDefault();
       edit_id = jq(this).attr("id");
       jq.ajax({
                url: "categorie/action.php",
                type: "POST",
                data: {edit_id:edit_id},
                success:function(response){
                    data = JSON.parse(response);
                    jq("#idedit").val(data[0].id);
                    jq("#nomedit").val(data[0].nom);  
                }, 
                error: function(){
                    console.log("Opps error");
                } 
           }); 
    });
    // update un categorie
    jq("#modifier").on("click",function(e){
       if(jq("#edit-form-data")[0].checkValidity()){
           e.preventDefault();
           jq.ajax({
                url: "categorie/action.php",
                type: "POST",
                data: jq("#edit-form-data").serialize()+"&action=modifier",
                beforesend: function(){

                },
                success:function(response){
                    console.log(response);
                    jq("#editModal").modal("hide");
                    swal.fire({
                        icon:'success',
                        title: 'Un categorie est modifier',
                        type: 'success'
                    })
                    jq("#edit-form-data")[0].reset();
                    afficherToutCategories();
                },
                error: function(){
                    console.log("Opps error");
                } 


           });
       }
    });
    /**FIN EDIT UN CATEGORIE */

    /** DELETE UN CATEGORIE */
    //recuperer id de selection sur les buttons de delete 
    jq("body").on("click",".deletebtn",function(e){
       e.preventDefault();
       var td = jq(this).closest('tr');
       delete_id = jq(this).attr("id");
       jq.ajax({
                url: "categorie/action.php",
                type: "POST",
                data: {delete_id:delete_id},
                success: function(response){
                    data = JSON.parse(response);
                    jq("#iddelete").val(data[0].id);     
                },
                error: function(){
                    console.log("Opps error");
                } 
           }); 
    });
    //supprimer un categorie     
    jq("#delete").on("click",function(e){
       if(jq("#delete-form-data")[0].checkValidity()){
           e.preventDefault();
           jq.ajax({
                url: "categorie/action.php",
                type: "POST",
                data: jq("#delete-form-data").serialize()+"&action=delete",
                beforesend: function(){

                },
                success:function(response){
                    console.log(response);
                    jq("#deleteModal").modal("hide");
                    swal.fire({
                        icon:'success',
                        title: 'Un categorie est supprimer',
                        type: 'info'
                    })
                    jq("#delete-form-data")[0].reset();
                    afficherToutCategories();
                }, 
                error: function(){
                    console.log("Opps error");
                }
           });
       }
    });
    //clique sur non sur le modal supprimer 
    jq("#nonSupprimer").on("click",function(e){
        jq("#deleteModal").modal("hide");
        afficherToutCategories();
    });
    /** FIN DELETE UN CATEGORIE */

});