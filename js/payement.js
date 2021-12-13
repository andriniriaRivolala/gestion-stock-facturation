var jq = $.noConflict();

jq(document).ready(function(){
     
/************************* READ PAYEMENT ******************** */
    afficherToutPayement();
    function afficherToutPayement(){
        jq.ajax({
            url: "payement/action.php",
            type: "POST",
            data: {action:"afficher"},
            success:function(response){
                jq("#afficherToutPayement").html(response);
                totalPayement();
            } 
        });
    }
    //afficher les nombres totals des factures à paeyer
    function totalPayement(){
        jq.ajax({
            url: "payement/action.php",
            type: "POST",
            data: {action: "total"},
            success:function(response){
                jq("#totalPayement").html(response);
            } 
        });
    }
/*************************FIN READ PAYEMENT******************** */

});


/**
 * FILTRE PAR NOM CLIENT
 */
 function chercherParNom() {

    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("nom");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablePayement");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
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
    table = document.getElementById("tablePayement");
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

/**
 * FILTRE FACTURE PAR DATE
 */
 function chercherParDate() {
    
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("date");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablePayement");
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