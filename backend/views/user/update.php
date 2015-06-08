<!DOCTYPE html>
<?php

$this->title = 'Sửa thông tin người dùng';
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
                <input type="text" class="form-control" name="username" id="username" value="<?php echo $model['username']?>" placeholder="Nhập tên tài khoản" disabled="disable">
            </div>
            <div class="input-group col-lg-5">
                <label>Nhóm</label>
                <select class="form-control" name="group">
                    <?php foreach ($group as $row): ?>
                    <option value="<?php echo $row['name']; ?>" <?php if ($model['group'] == $row['name']) echo 'selected=:selected';?>><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br/>
            <div class="input-group col-lg-5">
                <label>Trạng thái</label>
                <select class="form-control" name="status">
                    <option value="0" <?php if($model['status'] == 0) echo 'selected=:selected'; ?>>Không kích hoạt</option>
                    <option value="1" <?php if ($model['status'] == 1) echo 'selected=:selected';?>>Kích hoạt</option>
                </select>
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <input type="submit" value="Xác nhận" name="submit" class="btn btn-primary"/>
            <a href="<?php echo \Yii::$app->urlManager->createUrl(['user/index'])?>" type="submit" class="btn btn-primary">Quay lại</a>
        </div>
    <?php echo \yii\helpers\Html::endForm(); ?>
</div>