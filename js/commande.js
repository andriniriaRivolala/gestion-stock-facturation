var jq = $.noConflict();

jq(document).ready(function(){
    
    //afficher les clients dans select
    afficherClient();
    function afficherClient(){
        jq.ajax({
            url: "commande/action.php",
            type: "POST",
            data: {action: "afficherClient"},
            success:function(response){
                jq("#selectAfficherClient").html(response);
            } 
        });
    }

/*************************READ COMMANDE EN ATTENTE******************** */
    afficherToutCommande();
    function afficherToutCommande(){
        jq.ajax({
            url: "commande/action.php",
            type: "POST",
            data: {action: "afficher"},
            success:function(response){
                jq("#afficherToutCommande").html(response);
                totalCommande();
            } 
        });
    }
    //afficher les totals de commande
    function totalCommande(){
        jq.ajax({
            url: "commande/action.php",
            type: "POST",
            data: {action: "total"},
            success:function(response){
                jq("#totalCommande").html(response);
            } 
        });
    }
/*************************FIN READ COMMANDE EN ATTENTE********************* */

/*************************READ COMMANDE VALIDER ******************** */
    afficherToutCommandeValider();
    function afficherToutCommandeValider(){
        jq.ajax({
            url: "commande/action.php",
            type: "POST",
            data: {action: "afficherValider"},
            success:function(response){
                jq("#afficherToutCommandeValider").html(response);
                totalCommandeValider();
            } 
        });
    }
    //afficher les totals de commande
    totalCommandeValider() 
    function totalCommandeValider(){
        jq.ajax({
            url: "commande/action.php",
            type: "POST",
            data: {action: "totalValider"},
            success:function(response){
                jq("#totalCommandeValider").html(response);
            } 
        });
    }
/*************************FIN READ COMMANDE VALIDER******************* */

/*************************INSERT COMMANDE ******************** */
    //afficher les detail produit selectionner pour commander
    afficherProduit();
    function afficherProduit(){
        idProd = jq("#idProd").val();
        jq.ajax({
            url: "commande/action.php",
            type: "POST",
            data: {idProd:idProd},
            success:function(response){
                console.log(response);
                data = JSON.parse(response);
                if(data == ""){
                    
                }else{
                    jq("#AttenteCOMM").css({"display":"inline-block"});
                    jq("#produitC").val(data[0].nom);
                    jq("#prixC").val(data[0].prix);
                    jq("#prixUC").val(data[0].prix);
                    jq("#stock").val(data[0].stock);
                    jq("#quantiteC").val(0);
                    jq("#quantiteC").attr("max",data[0].stock);
                }
            }          
        }); 
    }
    
    //Afficher le total du commande selon le quantité choisi
    jq("body").on("click","#btnTotal", function(){
        var prix = jq("#prixUC").val();
        var quant = jq("#quantiteC").val();
        var stock =   jq("#stock").val();
        if(quant>stock){
            alert("Le quantite est toujour inferieur au stock !")
        }else{
            jq("#totalCom").val(prix*quant);
            jq("#totalCom").removeClass("bg-secondary"); 
            jq("#totalCom").addClass("bg-primary"); 
        } 
    });
 
    //insert un commande
    jq(document).on("submit","#add-form-data", function(e){
        console.log(jq("#prixUC").val());
        if(jq("#produitC").val() != ""){
            e.preventDefault();
            jq.ajax({
                url: "commande/action.php",
                type: "POST",
                datatype: "json",
                data: new FormData(this),
                processData: false,
                contentType: false, 
                beforeSend: function(){

                },
                success: function(response){
                    console.log(response);
                    swal.fire({
                        icon:'success',
                        title: 'Un commande est ajouter',
                        type: 'info'
                    })
                    jq("#AttenteCOMM").css({"display":"none"});
                    jq("#produitC").val("");
                    jq("#prixC").val("");
                    jq("#prixUC").val("");
                    jq("#stock").val("");
                    jq("#quantiteC").val("");
                    jq("#totalCom").val("");
                    jq("#totalCom").removeClass("bg-primary"); 
                    jq("#totalCom").addClass("bg-secondary"); 
                    jq("#add-form-data")[0].reset();
                    afficherToutCommande(); 
                }
            });
        }else{
            alert("Selectionner le produit commander dans le page produit");
        }
    });
                 
/*************************FIN INSERT COMMANDE******************** */

/************* EDIT UN COMMANDE EN-ATTENTE **************** */
    //edit un commande en-attente donner les valeurs des champs selon id selectionner 
    jq("body").on("click","#commandeEdit",function(e){
        if(jq("input[type=checkbox]").is(":checked")){
           alert(jq(".custom-control-input").val());
           jq("#editModalCommande").modal("show");
        }else{
            alert("Choissez le commande");
            afficherToutCommande(); 
        }
    });

    //update un commande en-attente
    jq(document).on("submit", "#edit-form-data", function (e){
        e.preventDefault();
        jq.ajax({
            url:"commande/action.php",
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
                afficherToutCommande();
            },
            error: function(){
                console.log("Oops! error");
            },
        });
    });
/************* FIN EDIT UN COMMANDE EN-ATTENTE**************** */

/*************************DELETE COMMANDE******************** */
    //supprimer commande 
    jq("body").on("click","#delete",function(e){
        if(jq("input[type=checkbox]").is(":checked")){
            e.preventDefault();
            jq.ajax({
                url: "commande/action.php",
                type: "POST",
                data: jq("#form-commande").serialize()+"&action=delete",
                success:function(response){
                    console.log(response);
                    swal.fire({
                        icon:'success',
                        title: 'Commande supprimer',
                        type: 'info'
                    })
                    afficherToutCommande(); 
                } 
            });
        }else{
            alert("Choissez le commande");
            afficherToutCommande(); 
        }
    });
/*************************FIN DELETE UN  COMMANDE******************** */

/*************************TABLE COMMANDE EN ATTENTE*******************/
    //check tout les ckeckbox si on click TOut crocher et check tout
    function selectionTout(){
        if(jq("#checkTout").is(":checked")){
            jq("input[type=checkbox]").each(function(){
                jq("#"+this.id).prop("checked",true);
           });
        }else{
            jq("input[type=checkbox]").each(function(){
                jq("#"+this.id).prop("checked",false);
           });
        }
        jq("input[type=checkbox]").each(function(){
            console.log(this.id);
       });
    }

    jq("body").on("click","#checkTout", function(e){
        selectionTout();
    });
    
/*************************VALIDER COMMANDE EN ATTENTE******************** */
    //valider un commande en attente 
    jq("body").on("click","#valider",function(e){
        if(jq("input[type=checkbox]").is(":checked")){
            e.preventDefault();
            jq.ajax({
                url: "commande/action.php",
                type: "POST",
                data: jq("#form-commande").serialize()+"&action=valider",
                success:function(response){
                    console.log(response);
                    swal.fire({
                        icon:'success',
                        title: 'Un commande en-attente est valider',
                        type: 'info'
                    })
                    afficherToutCommandeValider(); 
                } 
            });
        }else{
            alert("Choissez le commande ");
            afficherToutCommande(); 
        }
    });
/*************************FIN TABLE DE UN  COMMANDE EN ATTENTE******************** */

/*************************AJOUTER AU FACTURER COMMANDE VALIDER******************** */
    //Ajouter une facture de commande valider 
    jq("body").on("click",".addfacturebtn",function(e){
        e.preventDefault();
        com_vald_Id1 = jq(this).attr("id");
        com_vald_Id1= parseInt(com_vald_Id1);
        jq.ajax({
            url: "commande/action.php",
            type: "POST",
            data: {action:"addfacture",com_vald_Id:com_vald_Id1},
            success:function(response){
                console.log(response);
                swal.fire({
                    icon:'success',
                    title: 'Un commande valider est  ajouter au facture',
                    type: 'info'
                })
                afficherToutCommandeValider();
            } 
        });
    });

    //Ajouter des factures des commande validers 
    jq("body").on("click",".addfacturesbtn",function(e){
        e.preventDefault();
        com_vald_Cli_Id1 = jq(this).attr("id");
        jq.ajax({
            url: "commande/action.php",
            type: "POST",
            data: {action:"addfactures",com_vald_Cli_Id:com_vald_Cli_Id1},
            success:function(response){
                console.log(response);
                swal.fire({
                    icon:'success',
                    title: 'Des commandes validers sont  ajouter au facture',
                    type: 'info'
                })
                afficherToutCommandeValider();
            } 
        });
    });
/************************* AJOUTER AU FACTURER COMMANDE VALIDER******************** */

});
