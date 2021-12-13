var  jq = $.noConflict();
jq(document).ready(function(){
/**************FILTRER UN PRODUIT******************** */
    //afficher les fournisseur dans select sur le filtre
    afficherFournisseurF();
    function afficherFournisseurF(){
        jq.ajax({
            url: "produit/action.php",
            type: "POST",
            data: {action:"afficherFournisseurF"},
            success:function(response){
                jq("#fournisseurParentF").html(response);
            } 
        });
    } 

    //afficher les categories dans select sur sur le filtre
    afficherCategoriesF();
    function afficherCategoriesF(){
        jq.ajax({
            url: "produit/action.php",
            type: "POST",
            data: {action: "afficherCategorieF"},
            success:function(response){
                jq("#categorieParentF").html(response);
            } 
        });
    }
    
    //afficher les sous-categories dans select sur sur le filtre
    afficherSouscategoriesF();
    function afficherSouscategoriesF(){
        jq.ajax({
            url: "produit/action.php",
            type: "POST",
            data: {action: "afficherSouscategorieF"},
            success:function(response){
                jq("#souscategorieParentF").html(response);
            } 
        });
    }
    
/**************FILTRER UN PRODUIT******************** */
    
/**************READ UN PRODUIT******************** */
    //afficher les produits dans des cards
    afficherToutProduit();
    function afficherToutProduit(){
        jq.ajax({
            url: "produit/action.php",
            type: "POST",
            data: {action: "afficher"},
            beforeSend: function(){
                jq("#overlay").fadeIn();
            },
            success:function(response){
                jq("#overlay").fadeOut();
                jq("#afficherToutProduit").html(response);
            }
        });
    }
/**************FIN READ UN PRODUIT**************** */
    
    //afficher les totals des produits
    totalProduit();
    function totalProduit(){
        jq.ajax({
            url: "produit/action.php",
            type: "POST",
            data: {action: "totalProduit"},
            success:function(response){
                jq("#totalProduit").html(response);
            } 
        });
    }
    
/**************INSERT UN PRODUIT****************** */
    //afficher les fournisseurs dans select sur le modal insert
    afficherFournisseur();
    function afficherFournisseur(){
        jq.ajax({
            url: "produit/action.php",
            type: "POST",
            data: {action: "afficherFournisseur"},
            success:function(response){
                jq("#fournisseurParent2").html(response);
            } 
        });
    }
    //afficher les categories dans select sur le modal insert
    afficherCategories();
    function afficherCategories(){
        jq.ajax({
            url: "produit/action.php",
            type: "POST",
            data: {action: "afficherCategorie"},
            success:function(response){
                jq("#categorieParent2").html(response);
            } 
        });
    }
    //afficher les sous-categories dans select sur le modal insert
    afficherSouscategories();
    function afficherSouscategories(){
        jq.ajax({
            url: "produit/action.php",
            type: "POST",
            data: {action: "afficherSouscategorie"},
            success:function(response){
                jq("#souscategorieParent2").html(response);
            } 
        });
    }
    //Ajouter un utilisateur
    jq(document).on("submit", "#addform", function (e){
        e.preventDefault();
        jq.ajax({
            url:"produit/action.php",
            type:"POST",
            dataType:"json",
            data: new FormData(this),
            processData: false,
            contentType: false, 
            beforeSend: function(){

            },
            success: function(response){
                console.log(response);
                jq("#addform")[0].reset();
                jq("#addModal").modal("hide");
                swal.fire({
                    icon:'success',
                    title: 'Un produit est ajouter',
                    type: 'info'
                })
                afficherToutProduit(); 
            },
            error: function(){
               // alert("Pas de fournisseur,ou pas de categorie, ou pas de sous-categorie dans le database");
                //jq("#addModal").modal("hide");
                //afficherToutProduit();
            },
        });
    });

/****************FIN INSERT UN PRODUIT************ */
    
/**************SUPPRIMER UN PRODUIT*************** */
    //recuperer id de selection sur les buttons de delete 
    jq("body").on("click",".deletebtn",function(e){
        e.preventDefault();
        delete_id = jq(this).attr("id");
        jq.ajax({
            url: "produit/action.php",
            type: "POST",
            data: {delete_id:delete_id},
            success:function(response){
                data = JSON.parse(response);
                console.log(data);
                jq("#iddelete").val(data[0].id);  
            } 
        }); 
    });
    //supprimer un produit  
    jq("#delete").on("click",function(e){
        if(jq("#delete-form-data")[0].checkValidity()){
            e.preventDefault();
            jq.ajax({
                url: "produit/action.php",
                type: "POST",
                data: jq("#delete-form-data").serialize()+"&action=delete",
                success:function(response){
                    console.log(response);
                    jq("#deleteModal").modal("hide");
                    swal.fire({
                        icon:'success',
                        title: 'Un produit est supprimer',
                        type: 'info'
                    })
                    jq("#delete-form-data")[0].reset();
                    afficherToutProduit();
                } 
            });
        }
    });
    //clique sur non sur le modal supprimer 
    jq("#nonSupprimer").on("click",function(e){
        jq("#deleteModal").modal("hide");
        afficherToutProduit();
    });
/**************FIN SUPPRIMER UN PRODUIT*********** */
    
/**************EDIT UN PRODUIT******************** */
    //afficher les fournisseurs dans select sur le modal edit
    afficherFournisseurEdit();
    function afficherFournisseurEdit(){
        jq.ajax({
            url: "produit/action.php",
            type: "POST",
            data: {action: "afficherFournisseurEdit"},
            success:function(response){
                jq("#fournisseurParentEdit").html(response);
            } 
        });
    }
    //afficher les categories dans select sur le modal edit
    afficherCategoriesEdit();
    function afficherCategoriesEdit(){
        jq.ajax({
            url: "produit/action.php",
            type: "POST",
            data: {action: "afficherCategorieEdit"},
            success:function(response){
                jq("#categorieParentEdit").html(response);
            } 
        });
    }
    //afficher les sous-categories dans select sur le modal edit
    afficherSouscategoriesEdit();
    function afficherSouscategoriesEdit(){
        jq.ajax({
            url: "produit/action.php",
            type: "POST",
            data: {action: "afficherSouscategorieEdit"},
            success:function(response){
                jq("#souscategorieParentEdit").html(response);
            } 
        });
    }
    //edit un produit donner les valeurs des champs selon id selectionner 
    jq("body").on("click",".editbtn",function(e){
        e.preventDefault();
        edit_id = jq(this).attr("id");
        jq.ajax({
                url: "produit/action.php",
                type: "POST",
                data: {edit_id:edit_id},
                success:function(response){
                    data = JSON.parse(response);
                    console.log(data);
                    jq("#imageProdED").attr("src","produit/uploads/"+data[0].image);
                    jq("#editdate").val(data[0].date);
                    jq("#nomedit").val(data[0].nom);
                    jq("#imageEditNom").text("Photo : "+data[0].image);
                    jq("#stockedit").val(data[0].stock);
                    jq("#prixedit").val(data[0].prix);
                    jq("#descriptionedit").val(data[0].description);
                    jq("#fournisseurdefinie").text(data[0].fournisseur);
                    jq("#fournisseurdefinie").attr("value",data[0].idFournisseur); 
                    jq("#categoriedefinie").text(data[0].categorie);
                    jq("#categoriedefinie").attr("value",data[0].idCategorie); 
                    jq("#souscategoriedefinie").text(data[0].souscategorie);
                    jq("#souscategoriedefinie").attr("value",data[0].idSouscategorie);
                    jq("#idModifier").val(data[0].id); 
                } 
            }); 
    });
    //update un produit
    jq(document).on("submit", "#edit-form-data", function (e){
        e.preventDefault();
        jq.ajax({
            url:"produit/action.php",
            type:"POST",
            dataType:"json",
            data: new FormData(this),
            processData: false,
            contentType: false, 
            beforeSend: function(){
            },
            success: function(response){
                console.log(response);
                jq("#edit-form-data")[0].reset();
                jq("#editModal").modal("hide");
                swal.fire({
                    icon:'success',
                    title: 'Un produit est modifier',
                    type: 'info'
                })
                afficherToutProduit(); 
            },
            error: function(){
                console.log("Oops! error");
            },
        });
    });
/************* FIN EDIT UN PRODUIT**************** */
    
/************** VIEW UN PRODUIT***************** */
    //View un produit
    jq("body").on("click",".imageProdView",function(e){
        e.preventDefault();
        view_id = jq(this).attr("id");
        jq.ajax({
                url: "produit/action.php",
                type: "POST",
                data: {view_id:view_id},
                success:function(response){
                    data = JSON.parse(response);
                    console.log(data);
                    jq("#nomview").text(data[0].nom);
                    jq("#imageviewed").attr("src","produit/uploads/"+data[0].image);
                    jq("#dateview").text(data[0].date);
                    jq("#prixview").text(data[0].prix + " $");
                    jq("#stockview").text(data[0].stock);
                    jq("#fournisseurview").text(data[0].fournisseur);
                    jq("#categorieview").text(data[0].categorie);
                    jq("#souscategorieview").text(data[0].souscategorie);
                    jq("#descriptionview").html(data[0].description);
                } 
            }); 
    });
/**************** VIEW UN PRODUIT******************** */

/**************** SEARCH UN PRODUIT******************** */
    //Chercher le card produit par le nom de produit
    jq("#nomfilter").on('keyup', function(){
        const searchNom = jq(this).val();
        if(searchNom == ''){
            afficherToutProduit();
        }else{
            jq.ajax({
                url: "produit/action.php",
                type: "POST",
                data: {searchNom:searchNom, action: "searchNom"},
                beforeSend: function(){

                },
                success:function(response){
                    jq("#afficherToutProduit").html(response);   
                },
                error: function(){

                }
            });
        }
    });

    //Chercher le card produit par le prix inferieur de produit
    jq("#prixinferieur").on('keyup', function(){
        const searchPrix = jq(this).val();
        if(searchPrix == ''){
            afficherToutProduit();
        }else{
            jq.ajax({
                url: "produit/action.php",
                    type: "POST",
                    data: {searchPrix:searchPrix, action: "searchPrix"},
                    beforeSend: function(){
    
                    },
                    success:function(response){
                        jq("#afficherToutProduit").html(response);   
                    },
                    error: function(){
    
                    }
            });
        }
    });

    //Chercher le card produit par le fournisseur 
    jq("body").on("change","#selectFournisseurF",function(){
        var selectval = jq("#selectFournisseurF option:selected").val()
        if(selectval == ""){
            afficherToutProduit();
        }else{
            const searchIdFournisseur = selectval;
            jq.ajax({
                url: "produit/action.php",
                type: "POST",
                data: {searchIdFournisseur:searchIdFournisseur, action: "searchFournisseur"},
                beforeSend: function(){

                },
                success:function(response){
                    jq("#afficherToutProduit").html(response);   
                },
                error: function(){

                }
            });
        }
    });

    //Chercher le card produit par  categorie 
    jq("body").on("change","#selectCategorieF",function(){
        var selectval = jq("#selectCategorieF option:selected").val();
        if(selectval == ""){
            afficherToutProduit();
        }else{
            const searchIdCategorie = selectval;
            jq.ajax({
                url: "produit/action.php",
                type: "POST",
                data: {searchIdCategorie:searchIdCategorie, action: "searchCategorie"},
                beforeSend: function(){

                },
                success:function(response){
                    jq("#afficherToutProduit").html(response);   
                },
                error: function(){

                }
            });
        }
    });
   
    //Chercher le card produit par  souscategorie
    jq("body").on("change","#selectSouscategorieF",function(){
        var selectval = jq("#selectSouscategorieF option:selected").val();
        if( selectval == ""){
            afficherToutProduit();
        }else{
            const searchIdSouscategorie = selectval;
            jq.ajax({
                url: "produit/action.php",
                type: "POST",
                data: {searchIdSouscategorie:searchIdSouscategorie, action: "searchSouscategorie"},
                beforeSend: function(){

                },
                success:function(response){
                    jq("#afficherToutProduit").html(response);   
                },
                error: function(){

                }
            });
        }
    });

/**************** SEARCH UN PRODUIT******************** */
});