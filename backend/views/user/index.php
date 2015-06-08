<!DOCTYPE html>
<?php 
use common\utilities\Common;
$common = new Common();
$current_url = $common->getCurrentUrl();
$path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
$path_paging = str_replace("?page=".$page."&","?",$path_paging);
$path_paging = str_replace("&page=".$page."&","&",$path_paging);
$this->title = 'Danh sách quản trị viên';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-body table-responsive">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row">
                <div class="col-xs-6" style="float:right">
                    <a href="<?php echo \Yii::$app->urlManager->createUrl(['user/create'])?>" class="btn btn-primary" style="float:right">Tạo mới</a>
                </div>
            </div>
            <br/>
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
                                Search: <input type="search" name='keyword' aria-controls="example1" width="16em" value='<?php echo $keyword; ?>'>
                                <!--<input type='submit'/>-->
                            </form>
                        </label>
                    </div>
                </div>
            </div>
            <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                <thead>
                    <tr role="row">
                        <th rowspan="1" role="columnheader" colspan="1"><center>STT</center></th>
                        <th rowspan="1" role="columnheader" colspan="1"><center>Tài khoản</center></th>
                        <th rowspan="1" role="columnheader" colspan="1"><center>Họ tên</center></th>
                        <th rowspan="1" role="columnheader" colspan="1"><center>Email</center></th>
                        <th rowspan="1" role="columnheader" colspan="1"><center>Group</center></th>
                        <th rowspan="1" role="columnheader" colspan="1"><center>Trạng thái</center></th>
                        <th rowspan="1" role="columnheader" colspan="1"><center>Sửa</center></th>
                        <th rowspan="1" role="columnheader" colspan="1"><center>Xóa</center></th>
                    </tr>
                </thead>

                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <?php if ($data) : ?>
                    <?php $i = 0; ?>
                        <?php foreach ($data as $row) : ?>
                        <?php $i++ ?>
                        <tr class="odd">
                            <td class=" "><center><?php echo ($page -1)*$row_per_page+$i; ?></center></td>
                            <td class=" "><center><?php echo $row['username'] ?></center></td>
                            <td class=" "><center><?php echo $row['full_name'] ?></center></td>
                            <td class=" "><center><?php echo $row['email'] ?></center></td>
                            <td class=" "><center><?php echo $row['group'] ?></center></td>
                            <td class=" "><center><?php echo ($row['status'] == 1) ? 'Đã kích hoạt' : 'Không kích hoạt'; ?></center></td>
                            <td class=" "><a href="<?php echo \Yii::$app->urlManager->createUrl(['user/update', 'id' => $row['id']])?>"><center><p class="fa fa-edit"></p></center></a></td>
                            <td class=" "><a href="<?php echo \Yii::$app->urlManager->createUrl(['user/delete', 'id' => $row['id']])?>" data-confirm="Are you sure you want to delete this item?"><center><p class="glyphicon glyphicon-trash"></p></center></a></td>
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
        var url = '<?php echo \Yii::$app->urlManager->createUrl('user/index')?>';
        var row_per_page = $('#row_per_page').val();
        var keyword = '<?php echo $keyword; ?>'
        
        var params = '';
        if (row_per_page != '') {
            params += "?row_per_page="+row_per_page;
        }
        if (keyword != '') {
            params += "&keyword="+keyword;
        }
        
    window.location = url+params;
    }
</script>