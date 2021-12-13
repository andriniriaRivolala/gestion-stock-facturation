/**
 * FILTRE LE FACTURE PAR NOM 
 */
 function chercherParNom() {
    
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("nom");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablefacture");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }
    }
}

/**
 * FILTRE  PAR COMMANDE ID
 */
 function chercherParCommID() {
  
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("IdCommande");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablefacture");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[4];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }
    }
}

/**
 * FILTRE FACTURE PAR DATE
 */
 function chercherParDate() {
    
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("date");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablefacture");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }
    }
}

var jq = $.noConflict();

jq(document).ready(function(){
    
/************************* READ facture ******************** */
    afficherToutFacture();
    function afficherToutFacture(){
        jq.ajax({
            url: "facture/action.php",
            type: "POST",
            data: {action: "afficher"},
            success:function(response){
                jq("#afficherToutFacture").html(response);
                totalFacture();
            } 
        });
    }
    //afficher les totals de facture
    function totalFacture(){
        jq.ajax({
            url: "facture/action.php",
            type: "POST",
            data: {action: "total"},
            success:function(response){
                jq("#totalFacture").html(response);
            } 
        });
    }
/*************************FIN READ facture******************** */

/*************************TABLE FACTURE*******************/
    //check tout les ckeckbox si on click TOut crocher et check tout
    function selectionTout(){
        if(jq("#checkTout").prop("checked")){
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

/*************************FIN TABLE FACTURE*******************/

/************** VIEW UN FACTURE***************** */
    //View un produit
    jq("body").on("click",".voirDetailID",function(e){
        e.preventDefault();
        view_id = jq(this).attr("id");
        jq.ajax({
                url: "facture/action.php",
                type: "POST",
                data: {view_id:view_id},
                success:function(response){
                    data = JSON.parse(response);
                    console.log(data);
                    jq("#clientNom").text(data[0].clientNom);
                    jq("#clientPrenom").text(data[0].clientPrenom);
                    jq("#clientAddress").text(data[0].clientAddress);
                    jq("#clientTel").text(data[0].clientTel);
                    jq("#clientEmail").text(data[0].clientEmail);

                    jq("#factureId").text(data[0].factureId);
                    jq("#factureDate").text(data[0].factureDate);

                    jq("#clientNomPrenom").text(data[0].clientNom+" "+data[0].clientPrenom);

                    jq("#description").text(data[0].produitNom);
                    jq("#quantite").text(data[0].commandeQuantite);
                    jq("#prixUnitaire").text(data[0].PU);
                    jq("#Montant").text(data[0].commandeTotal);

                    jq("#factureTotal").text(data[0].commandeTotal);

                } 
            }); 
    });
/**************** VIEW UN FACTURE******************** */

/*************************DELETE FACTURE******************** */
    //supprimer commande 
    jq("body").on("click","#delete",function(e){
        if(jq("input[type=checkbox]").is(":checked")){
            e.preventDefault();
            jq.ajax({
                url: "facture/action.php",
                type: "POST",
                data: jq("#form-facture").serialize()+"&action=delete",
                success:function(response){
                    console.log(response);
                    swal.fire({
                        icon:'success',
                        title: 'Facture supprimer',
                        type: 'info'
                    })
                    afficherToutFacture(); 
                } 
            });
        }else{
            alert("Choissez le facture ");
            afficherToutFacture();
        }
    });
    
/*************************FIN DELETE FACTURE******************** */

/*************************PAYEMENT FACTURE******************** */
    //Payement facture par checkbox
    jq("body").on("click","#payer",function(e){
        if(jq("input[type=checkbox]").is(":checked")){
            e.preventDefault();
            jq.ajax({
                url: "facture/action.php",
                type: "POST",
                data: jq("#form-facture").serialize()+"&action=payements",
                success:function(response){
                    console.log(response);
                    afficherToutFacture();
                } 
            });
        }else{
            alert("Choissez le facture ");
            afficherToutFacture();
        }
    });

     //Payement facture par ligne btn
    jq("body").on("click",".payer",function(e){
        e.preventDefault();
        fact_id1= jq(this).attr("id");
        jq.ajax({
            url: "facture/action.php",
            type: "POST",
            data: {action:"payement",fact_id:fact_id1},
            success:function(response){
                console.log(response);
                swal.fire({
                    icon:'success',
                    title: 'Un facture a payer',
                    type: 'info'
                })
                afficherToutFacture();
            } 
        });
    });
/*************************FIN PAYER FACTURE******************** */

/************************* imprimer facture ******************** */
jq("body").on("click","#imprimer", function(){
    var printContent = document.getElementById("corpsImprimer");
    var WinPrint = window.open("","","width:2100px,height:2970px");
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
});
/*************************Fin imprimer facture******************** */
}); 