<!DOCTYPE html>
<?php

$this->title = 'Thêm tài khoản';
$this->params['breadcrumbs'][] = $this->title;
//yii\helpers\Html::beginForm();
?>
<div class="box">
    <?php echo \yii\helpers\Html::beginForm('','POST',['style'=>'width:400px']); ?>
        <div class="box-body">
            <?php if(!empty($error)) : ?>
            <div class="form-group">
                <div width="100"><strong>&nbsp;</strong></div>
                <div style="color: red;">
                    <?php echo $error;?>
                </div>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label>User name</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Nhập tên tài khoản">
            </div>
            <div class="form-group">
                <label>Full name</label>
                <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Nhập tên đầy đủ">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label>Xác nhận mật khẩu</label>
                <input type="password" class="form-control" name="re-password" id="re-password" placeholder="Nhập lại password">
            </div>
            <label>Email</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <br/>
            <div class="input-group col-lg-5">
                <label>Nhóm</label>
                <select class="form-control" name="group">
                    <?php foreach ($group as $row): ?>
                    <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br/>
            <div class="input-group col-lg-5">
                <label>Trạng thái</label>
                <select class="form-control" name="status">
                    <option value="0">Không kích hoạt</option>
                    <option value="1" selected="selected">Kích hoạt</option>
                </select>
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <input type="submit" value="Submit" name="submit" class="btn btn-primary"/>
        </div>
    <?php echo \yii\helpers\Html::endForm(); ?>
</div>