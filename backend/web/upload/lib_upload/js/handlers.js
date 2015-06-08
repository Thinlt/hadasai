var swfu;

function configUpload(configUploadData){
    var settings = {
        flash_url : configUploadData.flash_url,
        upload_url: configUploadData.upload_url,
        post_params: {
            "PHPSESSID" : "261084",
            'create_date':configUploadData.create_date
        },
        file_size_limit : "100 MB",
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

function configUploadOther(configUploadData){    
    var settings = {
        flash_url : configUploadData.flash_url,
        upload_url: configUploadData.upload_url,
        post_params: {
            "PHPSESSID" : "261084",
            'create_date':configUploadData.create_date
        },
        file_size_limit : "100 MB",
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

    swfu = new SWFUpload(settings);
}

function configUpload3gp(configUploadData){    
    var settings = {
        flash_url : configUploadData.flash_url,
        upload_url: configUploadData.upload_url,
        post_params: {
            "PHPSESSID" : "261084",
            'create_date':configUploadData.create_date
        },
        file_size_limit : "100 MB",
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

    swfu = new SWFUpload(settings);
}

function configUploadMp4(configUploadData){    
    var settings = {
        flash_url : configUploadData.flash_url,
        upload_url: configUploadData.upload_url,
        post_params: {
            "PHPSESSID" : "261084",
            'create_date':configUploadData.create_date
        },
        file_size_limit : "100 MB",
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

    swfu = new SWFUpload(settings);
}

function swfUploadLoaded() {
    try {
        var urlFileButton = document.getElementById("urlFileButton");

        if (urlFileButton){  
            urlFileButton.onclick = doUploadUrlFile;
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

function doUploadUrlFile(){    
    var urlFile = $("#urlFile").val();
    var link = swfu.settings.upload_url + "?jsoncallback=?";
    if(strpos(swfu.settings.upload_url,'?')!=false){
        link =  swfu.settings.upload_url + "&jsoncallback=?";
    }
    if(isImage(urlFile)) {
        $("#fsUploadProgress").html("<span class='legend'>File upload</span><p style='color:blue'>Đang xử lý....</p>");
        $.getJSON(link,{
            urlFile: urlFile
        }, function(data){          
            uploadResponse(data);   
            $("#fsUploadProgress").html("<span class='legend'>File upload</span>");         
        });        
    } else {
        alert("Đường dẫn ảnh bạn nhập không chính xác");
    }
}

function doUploadUrlFileOther(){    
    var urlFile = $("#urlFile_other").val();
    var link = swfu.settings.upload_url + "?jsoncallback=?";
    if(strpos(swfu.settings.upload_url,'?')!=false){
        link =  swfu.settings.upload_url + "&jsoncallback=?";
    }
    if(isImage(urlFile)) {
        $("#fsUploadProgress_other").html("<span class='legend'>File upload</span><p style='color:blue'>Đang xử lý....</p>");
        $.getJSON(link,{
            urlFile: urlFile
        }, function(data){          
            uploadResponseOther(data);   
            $("#fsUploadProgress_other").html("<span class='legend'>File upload</span>");         
        });        
    } else {
        alert("Đường dẫn ảnh bạn nhập không chính xác");
    }
}

function doUploadUrlFile3gp(){    
    var urlFile = $("#urlFile_3gp").val();
    var link = swfu.settings.upload_url + "?jsoncallback=?";
    if(strpos(swfu.settings.upload_url,'?')!=false){
        link =  swfu.settings.upload_url + "&jsoncallback=?";
    }
    if(isImage(urlFile)) {
        $("#fsUploadProgress_3gp").html("<span class='legend'>File upload</span><p style='color:blue'>Đang xử lý....</p>");
        $.getJSON(link,{
            urlFile: urlFile
        }, function(data){          
            uploadResponse3gp(data);   
            $("#fsUploadProgress_3gp").html("<span class='legend'>File upload</span>");         
        });        
    } else {
        alert("Đường dẫn ảnh bạn nhập không chính xác");
    }
}

function doUploadUrlFileMp4(){    
    var urlFile = $("#urlFile_mp4").val();
    var link = swfu.settings.upload_url + "?jsoncallback=?";
    if(strpos(swfu.settings.upload_url,'?')!=false){
        link =  swfu.settings.upload_url + "&jsoncallback=?";
    }
    if(isImage(urlFile)) {
        $("#fsUploadProgress_mp4").html("<span class='legend'>File upload</span><p style='color:blue'>Đang xử lý....</p>");
        $.getJSON(link,{
            urlFile: urlFile
        }, function(data){          
            uploadResponseMp4(data);   
            $("#fsUploadProgress_mp4").html("<span class='legend'>File upload</span>");         
        });        
    } else {
        alert("Đường dẫn ảnh bạn nhập không chính xác");
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
        /* hiển thị dữ liệu trả về */
        uploadResponse(serverData);
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
        /* hiển thị dữ liệu trả về */
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
        /* hiển thị dữ liệu trả về */
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
        /* hiển thị dữ liệu trả về */
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
