<!DOCTYPE html>
<style>
    .ui-widget {
        font-family: Verdana,Arial,sans-serif;
        font-size: 1.1em;
      }
    .ui-widget-content {
        border: 1px solid #aaaaaa;
        background: #ffffff 50% 50% repeat-x;
        color: #222222;
      }
</style>
<?php 
use app\utilities\Common;
$common = new \common\utilities\Common;
$current_url = $common->getCurrentUrl();
$path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
$path_paging = str_replace("?page=".$page."&","?",$path_paging);
$path_paging = str_replace("&page=".$page."&","&",$path_paging);
$folder_updload = "media/category";
$this->title = 'Danh sách các dịch vụ';
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="<?php echo Yii::$app->params['static_url'].'/css/jquery-ui.min.css'; ?>" rel="stylesheet" type="text/css" />
<?php $this->registerJsFile(Yii::$app->params['static_url'].'/js/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<h2><a class="btn btn-success" href="<?php echo \Yii::$app->urlManager->createUrl(['category/create'])?>">Thêm mới loại hình dịch vụ</a></h2>
<div class="box">
    <div class="box-body table-responsive">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row">
                
                <div class="col-xs-6">
                    <div id="example1_length" class="dataTables_length">
                        <label>
                            Hiển thị
                            <select size="1" name="example1_length" id="row_per_page" aria-controls="example1" onchange="changeUrl()">
                                <option value="10" <?php if ($row_per_page == 10) echo 'selected=:selected'?>>10</option>
                                <option value="20" <?php if ($row_per_page == 20) echo 'selected=:selected'?>>20</option>
                                <option value="50" <?php if ($row_per_page == 50) echo 'selected=:selected'?>>50</option>
                                <option value="100" <?php if ($row_per_page == 100) echo 'selected=:selected'?>>100</option>
                            </select>
                            bản ghi
                        </label>
                    </div>
                </div>
                <div class="col-xs-6" style="float:right">
                    <div class="dataTables_filter" id="example1_filter">
                        <label style="float:right">
                            <form method='GET' action=''>
                                <input type="hidden" value="<?php echo $row_per_page ?>" name="row_per_page"/>
                                <div class="ui-widget">
                                    <label for="mobile">Search: </label>
                                    <input type="search" name='mobile' id="mobile" aria-controls="example1" width="16em" value='<?php echo $keyword; ?>'>
                                </div>
                            </form>
                        </label>
                    </div>
                </div>
            </div>
            <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                <thead>
                    <tr role="row">
                        <th rowspan="1" role="columnheader" colspan="1" width="8%"><center>STT</center></th>
                        <th rowspan="1" role="columnheader" colspan="1" width="20%"><center>Ảnh</center></th>
                        <th rowspan="1" role="columnheader" colspan="1" width="15%"><center>Tên</center></th>
                        <th rowspan="1" role="columnheader" colspan="1" width="10%"><center>Trạng thái</center></th>
                        <th rowspan="1" role="columnheader" colspan="1" width="15%"><center>Quản trị</center></th>
                    </tr>
                </thead>

                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <?php if ($data) : ?>
                    <?php $i = 0 ?>
                        <?php foreach ($data as $row) : ?>
                        <?php $path = $folder_updload.date('/Y/md/').$row['icon']; ?>
                        <?php $i++ ?>
                        <tr class="odd">
                            <td class=" "><center><?php echo $i + ($page -1)*$row_per_page ?></center></td>
                            <td class=" "><center><img width="85" src="<?php echo Yii::$app->params['url_upload'].$path?>"></center></td>
                            <td class=" "><center><?php echo $row['name'] ?></center></td>
                            <td class=" "><center><span class="<?php echo ($row['status'] == 1) ? 'fa fa-toggle-off' : 'fa fa-toggle-on' ?>"</center></td>
                            <td class=" ">
                            <center>
                                <a href="<?php echo \Yii::$app->urlManager->createUrl(['category/detail', 'id' => $row['id']])?>"><span class=" glyphicon glyphicon-eye-open"></span></a>
                                <a href="<?php echo \Yii::$app->urlManager->createUrl(['category/delete', 'id' => $row['id']])?>" data-confirm="Are you sure you want to delete this item?"><span class=" glyphicon glyphicon-trash"></span></a>
                            </center>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-6">
                    <div class="dataTables_info" id="example1_info">
                        <?php echo 'Tìm thấy ' . $count . ' kết quả trong ' . $max_page . ' trang ' ?>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="dataTables_paginate paging_bootstrap">
                        <ul class="pagination" style="float:right">
                            <?php
                                echo $common->show_paging($max_page,$page,$path_paging);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>

<script type="text/javascript">
    function changeUrl() {
        var url = '<?php echo \Yii::$app->urlManager->createUrl('customer/index')?>';
        var row_per_page = $('#row_per_page').val();
        var mobile = '<?php echo $keyword; ?>'
        
        var params = '';
        if (row_per_page != '') {
            params += "?row_per_page="+row_per_page;
        }
        if (mobile != '') {
            params += "&mobile="+mobile;
        }
        
    window.location = url+params;
    }
    
    $(function() {
    function log( message ) {
      $( "#log" ).scrollTop( 0 );
    }
 
    $( "#mobile" ).autocomplete({
      source: "<?php echo \Yii::$app->urlManager->createUrl('customer/autocomplete')?>",
      minLength: 1,
    });
  });

</script>