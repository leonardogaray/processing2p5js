$(document).ready(function() {
    $(".processing-codes").each(function(){
        var id = $( this ).attr("id").replace("p_","");
        executeP5JS(id);
    });

});
