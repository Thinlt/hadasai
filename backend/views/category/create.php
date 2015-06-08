<!DOCTYPE html>
<?php
use common\utilities\Common;
$this->title = 'Thêm mới loại hình dịch vụ';
$this->params['breadcrumbs'][] = $this->title;
$folder_updload = "media/category";
?>
<div class="box">
    <?php echo \yii\helpers\Html::beginForm('','POST',['style'=>'width:400px']); ?>
        <div class="box-body" style="width:800px">
            <?php if(!empty($error)) : ?>
            <div class="form-group">
                <div width="100"><strong>&nbsp;</strong></div>
                <div style="color: red;">
                    <?php foreach ($error as $val) : ?>
                    <?php echo $val[0].'<br/>'; ?>
                    <?php endforeach;?>
                </div>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label>Tên món ăn</label>
                <input type="text" class="form-control" name="name" id="username" placeholder="Nhập tên món ăn">
            </div>
            <div class="form-group">
                <label>Upload image</label>
                <br/>
                <input type="hidden" id="txtFileName" name='icon' readonly="readonly" style="width: 200px">
                <input type="text" id="urlFile" style="border:1px solid #DFDFDF; width: 200px;" readonly="readonly">
                <span id="span_icon_100x100"></span>
                <div class="flash" id="div_icon_100x100"></div>
            </div>
            <div class="form-group">
                <div class="clearfix">
                    <input type="hidden" id="picture" value=""/>
                    <div id="show_pic"></div>
                </div>
            </div>
            <div class="input-group col-lg-5">
                <label>Trạng thái</label>
                <select class="form-control" name="status">
                    <option value="0">Không kích hoạt</option>
                    <option value="1" selected="selected">Kích hoạt</option>
                </select>
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" name="description" rows="5" placeholder="Nhập vào mô tả cho món ăn ..."></textarea>
            </div>
            <div class="form-group">
                <label>Nội dung</label>
                <textarea id="editor1" name="editor1" rows="10" cols="80" placeholder="Nhập giới thiệu chi tiết về món ăn"></textarea>
            </div>
        </div>
        
        <div class="box-footer">
            <input type="submit" value="Submit" name="submit" class="btn btn-primary"/>
        </div>
    <?php echo \yii\helpers\Html::endForm(); ?>
    <?php $this->registerJsFile('//cdn.ckeditor.com/4.4.3/standard/ckeditor.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <?php $this->registerJsFile(Yii::$app->params['static_url'].'js/bootstrap3-wysihtml5.all.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>
    <script type="text/javascript" src="<?php echo Yii::$app->params['static_url']; ?>js/handlers.js"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->params['url_upload']; ?>lib_upload/js/swfupload.js"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->params['url_upload']; ?>lib_upload/js/swfupload.queue.js"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->params['url_upload']; ?>lib_upload/js/fileprogress.js"></script>
</div>
<!-- CK Editor -->
<script type="text/javascript">
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
    function uploadSuccess100x100(file, serverData) {
        try {
            var response = $.parseJSON(serverData);
            if(response.code==404){
                alert(response.message);return false;
            }
            var filename = response.filename;
            var path = response.path;
            var progress = new FileProgress(file, this.customSettings.progressTarget);
            progress.setComplete();
            progress.setStatus("Complete.");
            progress.toggleCancel(false);
            $('#txtFileName').val(filename);
//            $("#urlFile").val(path+'/'+filename);
            $("#show_pic").html('<img src="<?php echo Yii::$app->params["url_upload"].$folder_updload.'/';?>'+path +'/'+ filename +'" class="img-100" alt="pic" width="100px">')
        } catch (ex) {
            this.debug(ex);
        }
    }
    var swf_100x100 = {
        uploadUrl : '<?php echo Yii::$app->params["url_upload"]."/upload_picture.php?type=icon&folder_upload=".$folder_updload.'&t='.  Common::genUploadKey() ?>',
        progress_id: 'div_icon_100x100',
        button_id : 'span_icon_100x100',
        obj: 'swf_100x100',
        successFunc : uploadSuccess100x100
    };
    configUploadImg(swf_100x100);

    function configUploadImg(config){
        var settings = {
            flash_url : "<?php echo Yii::$app->params["url_upload"];?>lib_upload/js/swfupload.swf",
            upload_url: config.uploadUrl,
            post_params: {
                "PHPSESSID" : "261084",
                'create_date':<?php echo (isset($data['create_date']))?$data['create_date']:0; ?>
            },
            file_size_limit : "1MB",
            file_types : "*.jpg;*.jpeg;*.png;*.gif",
            file_types_description : "Image File",
            file_upload_limit : 50,
            file_queue_limit : 1,
            custom_settings : {
                progressTarget : config.progress_id
            },
            debug: false,

            button_image_url : "<?php echo Yii::$app->params["url_upload"];?>lib_upload/images/buttonUpload.png",
            button_placeholder_id : config.button_id,
            button_width: 61,
            button_height: 22,

            swfupload_loaded_handler : swfUploadLoadedOther,
            file_queued_handler : fileQueuedOther,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : config.successFunc,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete
        };
        config.obj = new SWFUpload(settings);
    }
</script>