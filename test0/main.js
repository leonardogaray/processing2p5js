$(document).ready(function() {
    $("#processing").on("change", function(){
        $.ajax({
            type: "POST",
            url: "processing2p5js.php",
            data: {
                "containerName": "p5jssketch",
                "pde": $("#processing").val(),
            },
            success: onSucess,
            error: onError,
            dataType: "text"
        });

        function onSucess(result){
            try{
                $("#p5js").val(result);
                if($("#p5jssketch").find("canvas").length > 0)
                    $("#p5jssketch").find("canvas")[0].remove();
                eval(result);
                $("#p5jssketch").find("canvas")[0].style.width = "300px";
                $("#p5jssketch").find("canvas")[0].style.height = "300px";
            }catch(error){
                $("#p5js").val(error + "\n" + result);
            }
        }

        function onError(result){
            console.error("Hubo un error:", result);
        }
    })
});