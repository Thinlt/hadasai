<?php
include_once './allowuploadwithkey.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
function removeSign($str) {
    $coDau = array ("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", "ê", "ù", "à" );

    $khongDau = array ("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", "e", "u", "a" );
    return str_replace ( $coDau, $khongDau, $str );
}

require_once "phpthumb/PhpThumbFactory.php";

/*
* Kiểm tra file có tồn tại hay ko?
* Tạo tên file mới
*/

$forder_upload = isset($_GET["folder_upload"]) ? $_GET["folder_upload"] : (isset($_GET["forder_upload"])? $_GET["forder_upload"] : "default");
$file_location = getcwd();
$file_location .= "/" . $forder_upload . "/";
if(isset($_REQUEST["create_date"]) && intval($_REQUEST["create_date"]) >0){
    $path = date("Y/md", intval($_REQUEST["create_date"]));
}else{
    $path = date("Y/md", time());
}
$file_location .= $path . "/";

if(isset($_FILES["resume_file"])){
    $ufile = $_FILES["resume_file"];
} else{
    $ufile = $_FILES["Filedata"];
}
if (isset($_GET['url'])){
    $headers  = get_headers($_GET['url'], 1);
    $filesize    = isset($headers['Content-Length']) ? intval($headers['Content-Length']):0;
    $temp_file = tempnam(sys_get_temp_dir(), 'exmob');

    copy($_GET['url'], $temp_file);
    $ufile = array('size'=>$filesize,"name"=>basename($_GET['url']),"tmp_name"=>$temp_file);
}

if(isset($ufile)) {

    if($ufile['size'] > 3072000 ) {
        $error = array("code"=>102,"message"=>"Dung lượng ảnh không được vượt quá 3Megabyte");
    } else if($ufile['size'] < 10) {
        $error = array("code"=>404,"message"=>"Ảnh không tồn tại");
    } else {
        // Tao bien chua ten file va file hinh anh
        $name_image = $ufile["name"];
        $tmp_image = $ufile["tmp_name"];

        // Khoi tao doi tuong xu ly anh
        try {
            $thumb = PhpThumbFactory::create($tmp_image);
        } catch(Exception $e) {
            $error = array("code"=>104,"message"=>"Ảnh không đúng định dạng");
            print_r($e);
        }

    }
} else {
    $error = array("code"=>404,"message"=>"Ảnh không tồn tại");
}
$output = array();
if(isset($thumb)) {

    if(@chdir($file_location) == false) mkdir($file_location, 0777, true);

    // Directory listing

    $fileslisting = @scandir($file_location);

    $name_image = str_replace(" ", "_", $name_image);
    $name_image = str_replace("%20", "_", $name_image);
    $name_image = removeSign($name_image);

    if(is_array($fileslisting)) {
        // kiem tra xem file nay da ton tai chua
        $count = 0;
        $file_info = pathinfo($name_image);
        $ext = $file_info["extension"];
        $file_info["filename"] =  trim($file_info["basename"], $file_info['extension']);
        $file_info["filename"] =  rtrim($file_info["filename"], ".");
        while( in_array($name_image, $fileslisting) ) {
            $count++;
            $name_image =  $file_info["filename"] . "_" . $count .  "." . $file_info["extension"];
        }
    }

    $thumb->save($file_location . $name_image);

    /*Banner*/
    if(@$_GET['type'] == 'banner' && 0){
        $thumb->resize(320, 50);
        $thumb->save($file_location . "320x50_" . $name_image);

	    $thumb->resize(320, 32);
        $thumb->save($file_location . "320x32_" . $name_image);

        $thumb->resize(300, 50);
        $thumb->save($file_location . "300x50_" . $name_image);

        $thumb->resize(216, 36);
        $thumb->save($file_location . "216x36_" . $name_image);

        $thumb->resize(168, 28);
        $thumb->save($file_location . "168x28_" . $name_image);

        $thumb->resize(120, 20);
        $thumb->save($file_location . "120x20_" . $name_image);

        $output["filename"] = $name_image;
        $output["path"] = $path;
        $output["message"] = "Tải File thành công";
        $output["code"] = 105;
    }

    /*icon*/
    if(@$_GET['type'] == 'icon'){
        
        $thumb->resize(120, 120);
        $thumb->save($file_location . '120x120_' . $name_image, 'png');
        
        $thumb->resize(90, 90);
        $thumb->save($file_location . "90x90_" . $name_image, "png");

        $output["filename"] = $name_image;
        $output["path"] = $path;
        $output["message"] = "Tải File thành công";
        $output["code"] = 105;
    }

    /*Interstitial*/
    if(@$_GET['type'] == 'interstitial' && 0){
        $thumb->resize(320, 480);
        $thumb->save($file_location . "/320x480_" . $name_image, "png");

        $output["filename"] = $name_image;
        $output["path"] = $path;
        $output["message"] = "Tải File thành công";
        $output["code"] = 105;
    }

    $output["filename"] = $name_image;
    $output["path"] = $path;
    $output["message"] = "Tải File thành công";
    $output["code"] = 105;  
}
else {
    $output["message"] = "File không tồn tại";
    $output["code"] = 404;
}
echo json_encode($output);
exit(0);
?>