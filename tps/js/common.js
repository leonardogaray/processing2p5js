
function reload(id){
    executeP5JS(id)
}

function executeP5JS(id){
    var pid = "p_" + id;
    var uid = "u_" + id;

    $.ajax({
        type: "POST",
        url: "backend/__processing2p5js.php",
        data: {
            "containerName": uid,
            "pde": $("#" + pid).text(),
        },
        success: function(result){
            $("#" + uid).find("i").remove();
            $("#p5js" + uid).append(result);

            if($("#" + uid).find("canvas").length > 0)
                $("#" + uid).find("canvas")[0].remove();

            try{    
                eval(result);
                
                setTimeout(function(){
                    if($("#" + uid).find("canvas").length > 0){
                        $("#" + uid).find("canvas")[0].style.width = "600px";
                        $("#" + uid).find("canvas")[0].style.height = "400px";
                    }
                }, 1000);
            }catch(e){
                console.error(result, e);
            }
        },
        error: onError,
        dataType: "text"
    });
}

function onError(result){
    console.error("Hubo un error:", result);
}

function copyToClipboard(id) {
    const copyText = document.getElementById(id).textContent;
    const textArea = document.createElement('textarea');
    textArea.textContent = copyText;
    document.body.append(textArea);
    textArea.select();
    document.execCommand("copy");
}
