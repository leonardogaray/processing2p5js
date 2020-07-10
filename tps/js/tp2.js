$(document).ready(function() {
    $("#download-github").on("click", function(){
        $.ajax({
            type: "GET",
            url: "backend/pullFromGithub.php",
            success: onSuccess,
            error: onError,
            dataType: "text"
        });

        function onSuccess(result){
            location.reload();
        }

        function onError(result){
            console.error("Hubo un error:", result);
        }
    })
    
});