var swfu;
var swfu_file;
var swfu_other;
var swfu_3gp;
var swfu_mp4;

function configUpload(configUploadData){
    var settings = {
        flash_url : configUploadData.flash_url,
        upload_url: configUploadData.upload_url,
        post_params: {
            "PHPSESSID" : "261084",
            'create_date':configUploadData.create_date
        },
        file_size_limit : "50 MB",
        file_types : configUploadData.file_types,
        file_types_description : "All Files",
        file_upload_limit : configUploadData.file_upload_limit,
        file_queue_limit : configUploadData.file_queue_limit,
        custom_settings : {
            progressTarget : "fsUploadProgress"
        },
        debug: configUploadData.debug,

        button_image_url : configUploadData.button_image_url,
        button_placeholder_id : "spanButtonPlaceHolder",
        button_width: 61,
        button_height: 22,

        swfupload_loaded_handler : swfUploadLoaded,
        file_queued_handler : fileQueued,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete
    };

    swfu = new SWFUpload(settings);
}

function configUploadFile(configUploadData){
    var settings = {
        flash_url : configUploadData.flash_url,
        upload_url: configUploadData.upload_url,
        post_params: {
            "PHPSESSID" : "261084",
            'create_date':configUploadData.create_date
        },
        file_size_limit : "210 MB",
        file_types : configUploadData.file_types,
        file_types_description : "All Files",
        file_upload_limit : configUploadData.file_upload_limit,
        file_queue_limit : configUploadData.file_queue_limit,
        custom_settings : {
            progressTarget : "fsUploadProgress_file"
        },
        debug: configUploadData.debug,

        button_image_url : configUploadData.button_image_url,
        button_placeholder_id : "spanButtonPlaceHolder_file",
        button_width: 61,
        button_height: 22,

        swfupload_loaded_handler : swfUploadLoadedFile,
        file_queued_handler : fileQueuedFile,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccessFile,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete
    };

    swfu_file = new SWFUpload(settings);
}

function configUploadOther(configUploadData){
    var settings = {
        flash_url : configUploadData.flash_url,
        upload_url: configUploadData.upload_url,
        post_params: {
            "PHPSESSID" : "261084",
            'create_date':configUploadData.create_date
        },
        file_size_limit : "50 MB",
        file_types : configUploadData.file_types,
        file_types_description : "All Files",
        file_upload_limit : configUploadData.file_upload_limit,
        file_queue_limit : configUploadData.file_queue_limit,
        custom_settings : {
            progressTarget : "fsUploadProgress_other"
        },
        debug: configUploadData.debug,

        button_image_url : configUploadData.button_image_url,
        button_placeholder_id : "spanButtonPlaceHolder_other",
        button_width: 61,
        button_height: 22,

        swfupload_loaded_handler : swfUploadLoadedOther,
        file_queued_handler : fileQueuedOther,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccessOther,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete
    };

    swfu_other = new SWFUpload(settings);
}

function configUpload3gp(configUploadData){
    var settings = {
        flash_url : configUploadData.flash_url,
        upload_url: configUploadData.upload_url,
        post_params: {
            "PHPSESSID" : "261084",
            'create_date':configUploadData.create_date
        },
        file_size_limit : "50 MB",
        file_types : configUploadData.file_types,
        file_types_description : "All Files",
        file_upload_limit : configUploadData.file_upload_limit,
        file_queue_limit : configUploadData.file_queue_limit,
        custom_settings : {
            progressTarget : "fsUploadProgress_3gp"
        },
        debug: configUploadData.debug,

        button_image_url : configUploadData.button_image_url,
        button_placeholder_id : "spanButtonPlaceHolder_3gp",
        button_width: 61,
        button_height: 22,

        swfupload_loaded_handler : swfUploadLoaded3gp,
        file_queued_handler : fileQueued3gp,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess3gp,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete
    };

    swfu_3gp = new SWFUpload(settings);
}

function configUploadMp4(configUploadData){
    var settings = {
        flash_url : configUploadData.flash_url,
        upload_url: configUploadData.upload_url,
        post_params: {
            "PHPSESSID" : "261084",
            'create_date':configUploadData.create_date
        },
        file_size_limit : "50 MB",
        file_types : configUploadData.file_types,
        file_types_description : "All Files",
        file_upload_limit : configUploadData.file_upload_limit,
        file_queue_limit : configUploadData.file_queue_limit,
        custom_settings : {
            progressTarget : "fsUploadProgress_mp4"
        },
        debug: configUploadData.debug,

        button_image_url : configUploadData.button_image_url,
        button_placeholder_id : "spanButtonPlaceHolder_mp4",
        button_width: 61,
        button_height: 22,

        swfupload_loaded_handler : swfUploadLoadedMp4,
        file_queued_handler : fileQueuedMp4,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccessMp4,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete
    };

    swfu_mp4 = new SWFUpload(settings);
}

function swfUploadLoaded() {
    try {
        var urlFileButton = document.getElementById("urlFileButton");

        if (urlFileButton){
            urlFileButton.onclick = doUploadUrlFile;
        }
    } catch (e) {}
}

function swfUploadLoadedFile() {
    try {
        var urlFileButton = document.getElementById("urlFileButtonFile");

        if (urlFileButton){
            urlFileButton.onclick = doUploadUrlFileFile;
        }
    } catch (e) {}
}

function swfUploadLoadedOther() {
    try {
        var urlFileButton = document.getElementById("urlFileButtonOther");

        if (urlFileButton){
            urlFileButton.onclick = doUploadUrlFileOther;
        }
    } catch (e) {}
}

function swfUploadLoaded3gp() {
    try {
        var urlFileButton = document.getElementById("urlFileButton3gp");

        if (urlFileButton){
            urlFileButton.onclick = doUploadUrlFile3gp;
        }
    } catch (e) {}
}

function swfUploadLoadedMp4() {
    try {
        var urlFileButton = document.getElementById("urlFileButtonMp4");

        if (urlFileButton){
            urlFileButton.onclick = doUploadUrlFileMp4;
        }
    } catch (e) {}
}

function isImage(s) {
    var regexp = /((http|https):\/\/([ \S]+\.(jpg|png|gif)))/ig;
    return regexp.test(s);
}

function valiUrl(url,file_types){
    var extension = file_types;
    if(extension == ""){
        return false;
    }else{
        extension = file_types.replace(/;\*\./g,"|");
        extension = extension.replace('*.','');
    }
    var regexp = new RegExp('((http|https):\/\/([^\\s\?&\!%@]+\\.('+extension+')))','ig');
    return regexp.test(url);
}

function doUploadUrlFile(){
    var urlFile = $("#urlFile").val();
    var link = swfu.settings.upload_url + "?jsoncallback=?";
    if(strpos(swfu.settings.upload_url,'?')!=false){
        link =  swfu.settings.upload_url + "&jsoncallback=?";
    }
    if(isImage(urlFile)) {
        $("#fsUploadProgress").html("<span class='legend'>File upload</span><p style='color:blue'>Äang xá»­ lĂ½....</p>");
        $.getJSON(link,{
            urlFile: urlFile
        }, function(data){
            data  = array2json(data);
            uploadResponse(data);
            $("#fsUploadProgress").html("<span class='legend'>File upload</span>");
        });
    } else {
        alert("ÄÆ°á»ng dáº«n file báº¡n nháº­p khĂ´ng chĂ­nh xĂ¡c");
    }
}

function doUploadUrlFileFile(){
    var urlFile = $("#urlFile_file").val();
    var file_type = swfu_file.settings.file_types;
    var link = swfu_file.settings.upload_url + "?jsoncallback=?";
    if(strpos(swfu_file.settings.upload_url,'?')!=false){
        link =  swfu_file.settings.upload_url + "&jsoncallback=?";
    }
    if(valiUrl(urlFile,file_type)) {
        $("#fsUploadProgress_file").html("<p style='color:blue'>Uploading...</p>");
        $.getJSON(link,{
            urlFile: urlFile,
            create_date:swfu_file.settings.post_params.create_date
        }, function(data){
            data  = array2json(data);
            uploadResponseFile(data);
            var response = $.parseJSON(data);
            if(response.code==105){
                $("#fsUploadProgress_file").html("<p style='color:blue'>Complete.</p>");
            }else{
                $("#fsUploadProgress_file").html("");
            }

        });
    } else {
        alert("ÄÆ°á»ng dáº«n file báº¡n nháº­p khĂ´ng há»£p lá»‡");
    }
}

function doUploadUrlFileOther(){
    var urlFile = $("#urlFile_other").val();
    var file_type = swfu_other.settings.file_types;
    var link = swfu_other.settings.upload_url + "?jsoncallback=?";
    if(strpos(swfu_other.settings.upload_url,'?')!=false){
        link =  swfu_other.settings.upload_url + "&jsoncallback=?";
    }
    if(valiUrl(urlFile,file_type)) {
        $("#fsUploadProgress_other").html("<p style='color:blue'>Uploading....</p>");
        $.getJSON(link,{
            urlFile: urlFile
        }, function(data){
            data  = array2json(data);
            uploadResponseOther(data);
            var response = $.parseJSON(data);
            if(response.code==105){
                $("#fsUploadProgress_other").html("<p style='color:blue'>Complete.</p>");
            }else{
                $("#fsUploadProgress_other").html("");
            }
        });
    } else {
        alert("ÄÆ°á»ng dáº«n file báº¡n nháº­p khĂ´ng há»£p lá»‡");
    }
}

function doUploadUrlFile3gp(){
    var urlFile = $("#urlFile_3gp").val();
    var file_type = swfu_3gp.settings.file_types;
    var link = swfu_3gp.settings.upload_url + "?jsoncallback=?";
    if(strpos(swfu_3gp.settings.upload_url,'?')!=false){
        link =  swfu_3gp.settings.upload_url + "&jsoncallback=?";
    }
    if(valiUrl(urlFile,file_type)) {
        $("#fsUploadProgress_3gp").html("<p style='color:blue'>Uploading....</p>");
        $.getJSON(link,{
            urlFile: urlFile
        }, function(data){
            data  = array2json(data);
            uploadResponse3gp(data);
            var response = $.parseJSON(data);
            if(response.code==105){
                $("#fsUploadProgress_3gp").html("<p style='color:blue'>Complete.</p>");
            }else{
                $("#fsUploadProgress_3gp").html("");
            }

        });
    } else {
        alert("ÄÆ°á»ng dáº«n file báº¡n nháº­p khĂ´ng há»£p lá»‡");
    }
}

function doUploadUrlFileMp4(){
    var urlFile = $("#urlFile_mp4").val();
    var file_type = swfu_mp4.settings.file_types;
    var link = swfu_mp4.settings.upload_url + "?jsoncallback=?";
    if(strpos(swfu_mp4.settings.upload_url,'?')!=false){
        link =  swfu_mp4.settings.upload_url + "&jsoncallback=?";
    }
    if(valiUrl(urlFile,file_type)) {
        $("#fsUploadProgress_mp4").html("<p style='color:blue'>Uploading....</p>");
        $.getJSON(link,{
            urlFile: urlFile
        }, function(data){
            data  = array2json(data);
            uploadResponseMp4(data);
            var response = $.parseJSON(data);
            if(response.code==105){
                $("#fsUploadProgress_mp4").html("<p style='color:blue'>Complete.</p>");
            }else{
                $("#fsUploadProgress_mp4").html("");
            }
        });
    } else {
        alert("ÄÆ°á»ng dáº«n file báº¡n nháº­p khĂ´ng chĂ­nh xĂ¡c");
    }
}

function fileQueued(file) {
    try {
        var txtFileName = document.getElementById("txtFileName");
        txtFileName.value = file.name;

        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setStatus("Pending...");
        progress.toggleCancel(true, this);
    } catch (ex) {
        this.debug(ex);
    }
}

function fileQueuedFile(file) {
    try {
        var txtFileName = document.getElementById("txtFileName_file");
        txtFileName.value = file.name;

        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setStatus("Pending...");
        progress.toggleCancel(true, this);
    } catch (ex) {
        this.debug(ex);
    }
}

function fileQueuedOther(file) {
    try {
        var txtFileName = document.getElementById("txtFileName_other");
        txtFileName.value = file.name;

        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setStatus("Pending...");
        progress.toggleCancel(true, this);
    } catch (ex) {
        this.debug(ex);
    }
}

function fileQueued3gp(file) {
    try {
        var txtFileName = document.getElementById("txtFileName_3gp");
        txtFileName.value = file.name;

        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setStatus("Pending...");
        progress.toggleCancel(true, this);
    } catch (ex) {
        this.debug(ex);
    }
}

function fileQueuedMp4(file) {
    try {
        var txtFileName = document.getElementById("txtFileName_mp4");
        txtFileName.value = file.name;

        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setStatus("Pending...");
        progress.toggleCancel(true, this);
    } catch (ex) {
        this.debug(ex);
    }
}

function fileQueueError(file, errorCode, message) {
    try {
        if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
            alert("You have attempted to queue too many files.\n" + (message === 0 ? "You have reached the upload limit." : "You may select " + (message > 1 ? "up to " + message + " files." : "one file.")));
            return;
        }

        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setError();
        progress.toggleCancel(false);

        switch (errorCode) {
            case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
                progress.setStatus("File is too big.");
                this.debug("Error Code: File too big, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                break;
            case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
                progress.setStatus("Cannot upload Zero Byte files.");
                this.debug("Error Code: Zero byte file, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                break;
            case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
                progress.setStatus("Invalid File Type.");
                this.debug("Error Code: Invalid File Type, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                break;
            default:
                if (file !== null) {
                    progress.setStatus("Unhandled Error");
                }
                this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                break;
        }
    } catch (ex) {
        this.debug(ex);
    }
}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
    try {
        /* I want auto start the upload and I can do that here */
        this.startUpload();
    } catch (ex)  {
        this.debug(ex);
    }
}

function uploadStart(file) {
    try {
        /* I don't want to do any file validation or anything,  I'll just update the UI and
         return true to indicate that the upload should start.
         It's important to update the UI here because in Linux no uploadProgress events are called. The best
         we can do is say we are uploading.
         */
        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setStatus("Uploading...");
        progress.toggleCancel(true, this);
    }
    catch (ex) {}

    return true;
}

function uploadProgress(file, bytesLoaded, bytesTotal) {
    try {
        var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);

        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setProgress(percent);
        progress.setStatus("Uploading...");
    } catch (ex) {
        this.debug(ex);
    }
}

function uploadSuccess(file, serverData) {
    try {
        /* hiá»ƒn thá»‹ dá»¯ liá»‡u tráº£ vá» */
        uploadResponse(serverData);
        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setComplete();
        progress.setStatus("Complete.");
        progress.toggleCancel(false);

    } catch (ex) {
        this.debug(ex);
    }
}

function uploadSuccessFile(file, serverData) {
    try {
        /* hiá»ƒn thá»‹ dá»¯ liá»‡u tráº£ vá» */
        uploadResponseFile(serverData);

        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setComplete();
        progress.setStatus("Complete.");
        progress.toggleCancel(false);

    } catch (ex) {
        this.debug(ex);
    }
}

function uploadSuccessOther(file, serverData) {
    try {
        /* hiá»ƒn thá»‹ dá»¯ liá»‡u tráº£ vá» */
        uploadResponseOther(serverData);

        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setComplete();
        progress.setStatus("Complete.");
        progress.toggleCancel(false);

    } catch (ex) {
        this.debug(ex);
    }
}

function uploadSuccess3gp(file, serverData) {
    try {
        /* hiá»ƒn thá»‹ dá»¯ liá»‡u tráº£ vá» */
        uploadResponse3gp(serverData);

        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setComplete();
        progress.setStatus("Complete.");
        progress.toggleCancel(false);

    } catch (ex) {
        this.debug(ex);
    }
}

function uploadSuccessMp4(file, serverData) {
    try {
        /* hiá»ƒn thá»‹ dá»¯ liá»‡u tráº£ vá» */
        uploadResponseMp4(serverData);

        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setComplete();
        progress.setStatus("Complete.");
        progress.toggleCancel(false);

    } catch (ex) {
        this.debug(ex);
    }
}

function uploadError(file, errorCode, message) {
    try {
        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setError();
        progress.toggleCancel(false);

        switch (errorCode) {
            case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
                progress.setStatus("Upload Error: " + message);
                this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + message);
                break;
            case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
                progress.setStatus("Upload Failed.");
                this.debug("Error Code: Upload Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                break;
            case SWFUpload.UPLOAD_ERROR.IO_ERROR:
                progress.setStatus("Server (IO) Error");
                this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + message);
                break;
            case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
                progress.setStatus("Security Error");
                this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + message);
                break;
            case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
                progress.setStatus("Upload limit exceeded.");
                this.debug("Error Code: Upload Limit Exceeded, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                break;
            case SWFUpload.UPLOAD_ERROR.FILE_VALIDATION_FAILED:
                progress.setStatus("Failed Validation.  Upload skipped.");
                this.debug("Error Code: File Validation Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                break;
            case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
                // If there aren't any files left (they were all cancelled) disable the cancel button
                if (this.getStats().files_queued === 0) {
                    document.getElementById(this.customSettings.cancelButtonId).disabled = true;
                }
                progress.setStatus("Cancelled");
                progress.setCancelled();
                break;
            case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
                progress.setStatus("Stopped");
                break;
            default:
                progress.setStatus("Unhandled Error: " + errorCode);
                this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                break;
        }
    } catch (ex) {
        this.debug(ex);
    }
}

function uploadComplete(file) {

}

function queueComplete(numFilesUploaded) {

}

function strpos (haystack, needle, offset) {
    var i = (haystack + '').indexOf(needle, (offset || 0));
    return i === -1 ? false : i;
}

function array2json(arr) {
    var parts = [];
    var is_list = (Object.prototype.toString.apply(arr) === '[object Array]');

    for(var key in arr) {
        var value = arr[key];
        if(typeof value == "object") { //Custom handling for arrays
            if(is_list) parts.push(array2json(value)); /* :RECURSION: */
            else parts[key] = array2json(value); /* :RECURSION: */
        } else {
            var str = "";
            if(!is_list) str = '"' + key + '":';

            //Custom handling for multiple data types
            if(typeof value == "number") str += value; //Numbers
            else if(value === false) str += 'false'; //The booleans
            else if(value === true) str += 'true';
            else str += '"' + value + '"'; //All other things
            // :TODO: Is there any more datatype we should be in the lookout for? (Functions?)

            parts.push(str);
        }
    }
    var json = parts.join(",");

    if(is_list) return '[' + json + ']';//Return numerical JSON
    return '{' + json + '}';//Return associative JSON
}
