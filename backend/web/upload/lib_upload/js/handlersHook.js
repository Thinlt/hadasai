function uploadResponse(serverData){
    try {
        $("#txtFileName").val(""); 
        var urlFile = document.getElementById("urlFile");
        if (urlFile){  
            var response = serverData;
            var filename = response['filename'];
            var path = response['path'];
            var message = response['message'];
            var code = response['code'];
            $("#urlFile").val("");
        }else{
            var response = eval( "(" + serverData + ")" );        
            var filename = response.filename;    
            var path = response.path;
            var message = response.message;
            var code = response.code;
        }
        alert(path);
    } catch (e) {

    };
}

