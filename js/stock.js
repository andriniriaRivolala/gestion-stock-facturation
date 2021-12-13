var jq = $.noConflict();

jq(document).ready(function(){
    
/************************* READ stock ******************** */
    afficherToutStock();
    function afficherToutStock(){
        jq.ajax({
            url: "stock/action.php",
            type: "POST",
            data: {action: "afficher"},
            success:function(response){
                jq("#afficherToutStock").html(response);
                totalStock();
            } 
        });
    }
    //afficher les totals de facture
    function totalStock(){
        jq.ajax({
            url: "stock/action.php",
            type: "POST",
            data: {action: "total"},
            success:function(response){
                jq("#totalStock").html(response);
            } 
        });
    }
/*************************FIN READ stock******************** */


});