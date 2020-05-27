$(document).ready(function() {
    $(".processing-codes").each(function(){
        var id = "u_" + $( this ).attr("id").replace("p_","");
        $.ajax({
            type: "POST",
            url: "backend/processing2p5js.php",
            data: {
                "containerName": id,
                "pde": $( this ).text(),
            },
            success: function(result){
                $("#" + id).find("i").remove();
                $("#p5js" + id).append(result);

                if($("#" + id).find("canvas").length > 0)
                    $("#" + id).find("canvas")[0].remove();

                eval(result);
                setTimeout(function(){
                    if($("#" + id).find("canvas").length > 0){
                        $("#" + id).find("canvas")[0].style.width = "280px";
                        $("#" + id).find("canvas")[0].style.height = "280px";
                    }
                }, 3000);
            },
            error: onError,
            dataType: "text"
        });
    });

    function onError(result){
        console.error("Hubo un error:", result);
    }
});