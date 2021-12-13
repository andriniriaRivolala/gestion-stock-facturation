var jq = $.noConflict();

jq(document).ready(function(){
    //afficher les categories dans select
    afficherCategories();
    function afficherCategories(){
        jq.ajax({
            url: "sous-categorie/action.php",
            type: "POST",
            data: {action: "afficherCategorie"},
            success:function(response){
                jq("#selectAfficherCategorie").html(response);
            } 
        });
    }

/*************************READ SOUS-CATEGORIE******************** */
    afficherToutSousCategories();
    // fonction afficher les sous-categories 
    function afficherToutSousCategories(){
        jq.ajax({
            url: "sous-categorie/action.php",
            type: "POST",
            data: {action: "afficher"},
            success:function(response){
                jq("#afficherToutSousCategorie").html(response);
                totalSousCategories();
            } 
        });
    }
    //afficher les totals de sous-categories
    function totalSousCategories(){
        jq.ajax({
            url: "sous-categorie/action.php",
            type: "POST",
            data: {action: "total"},
            success:function(response){
                jq("#totalSousCategories").html(response);
            } 
        });
    }
/*************************FIN READ SOUS-CATEGORIE******************** */

/*************************INSERT UN SOUS-CATEGORIE******************** */
    //insert un sous-categorie 
    jq("#insert").on("click",function(e){
        var texte ="Pas de categorie dans le database";
        if(jq("#selectAfficherCategorie").text() == texte ){
            alert("Pas de categorie parent,donc ajouter un categorie");
        }else{

            if(jq("#form-data")[0].checkValidity()){
                e.preventDefault();
                jq.ajax({
                    url: "sous-categorie/action.php",
                    type: "POST",
                    data: jq("#form-data").serialize()+"&action=insert",
                    beforesend: function(){
    
                    },
                    success:function(response){
                        console.log(response);
                        swal.fire({
                            icon: 'success',
                            title: 'Un nouveau sous-categorie est ajouter',
                            type: 'success'
                        })
                        jq("#form-data")[0].reset();
                        afficherToutSousCategories();
                    },
                    error: function(){
                        console.log("Ooops error");
                    }  
                });
            }
        }
        
    });
/*************************FIN INSERT UN SOUS-CATEGORIE******************** */

/*************************EDIT UN SOUS-CATEGORIE******************** */
    //edit un sous-categorie donner les valeurs de id
    jq("body").on("click",".editbtn",function(e){
        e.preventDefault();
        edit_id = jq(this).attr("id");
        jq.ajax({
                url: "sous-categorie/action.php",
                type: "POST",
                data: {edit_id:edit_id},
                success:function(response){
                    data = JSON.parse(response);
                    console.log(data);
                    jq("#idedit").val(data[0].id);
                    jq("#nomedit").val(data[0].nom);
                    jq("#categoriedefinie").text(data[0].category);
                    jq("#categoriedefinie").attr("value",data[0].categorie_id);  
                } 
            }); 
    });
    //afficher les categories dans select sur le modal edit
    editafficherCategories();
    function editafficherCategories(){
        jq.ajax({
            url: "sous-categorie/action.php",
            type: "POST",
            data: {action: "afficherCategorieedit"},
            success:function(response){
                jq("#editcategorieParent").html(response);
            } 
        });
    }
    //Update un sous-categorie 
    jq("#modifier").on("click",function(e){
        if(jq("#edit-form-data")[0].checkValidity()){
            e.preventDefault();
            jq.ajax({
                url: "sous-categorie/action.php",
                type: "POST",
                data: jq("#edit-form-data").serialize()+"&action=modifier",
                beforesend: function(){

                },
                success:function(response){
                    console.log(response);
                    jq("#editModal").modal("hide");
                    swal.fire({
                        icon:'success',
                        title: 'Un sous-categorie est modifier',
                        type: 'success'
                    })
                    jq("#edit-form-data")[0].reset();
                    afficherToutSousCategories();
                },
                error: function(){
                    console.log("Ooops error");
                }  
            });
        }
    });
/*************************EDIT UN SOUS-CATEGORIE******************** */

/*************************DELETE UN  SOUS-CATEGORIE******************** */
    //recuperer id de selection sur les buttons de delete 
    jq("body").on("click",".deletebtn",function(e){
        e.preventDefault();
        var td = jq(this).closest('tr');
        delete_id = jq(this).attr("id");
        jq.ajax({
                url: "sous-categorie/action.php",
                type: "POST",
                data: {delete_id:delete_id},
                success:function(response){
                    data = JSON.parse(response);
                    jq("#iddelete").val(data[0].id);     
                } 
            }); 
    });
    //supprimer un sous-categorie  
    jq("#delete").on("click",function(e){
        if(jq("#delete-form-data")[0].checkValidity()){
            e.preventDefault();
            jq.ajax({
                url: "sous-categorie/action.php",
                type: "POST",
                data: jq("#delete-form-data").serialize()+"&action=delete",
                beforesend: function(){

                },
                success:function(response){
                    console.log(response);
                    jq("#deleteModal").modal("hide");
                    swal.fire({
                        icon:'success',
                        title: 'Un sous-categorie est supprimer',
                        type: 'info'
                    })
                    jq("#delete-form-data")[0].reset();
                    afficherToutSousCategories();
                },
                error: function(){
                    console.log("Ooops error");
                } 
            });
        }
    });
    //clique sur non sur le modal supprimer 
    jq("#nonSupprimer").on("click",function(e){
        jq("#deleteModal").modal("hide");
        afficherToutSousCategories();
    });
/*************************DELETE UN  SOUS-CATEGORIE******************** */

});