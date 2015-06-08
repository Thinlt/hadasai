<?php
    /**
    * UploadFile Library Definition File
    * 
    * @parameter watermark_position_horizontal : left, center, right
    * @parameter watermark_position_vertical : top, middle, bottom
    * @parameter watermark_direction : >=0 and <=360
    * 
    * @author nguyen duy dat <duydat.nguyen@gmail.com> 
    * @license http://www.opensource.org/licenses/mit-license.php The MIT License
    * @version 1.0
    * @package UploadFile
    * @filesource
    */
    class UploadFile
    {
        /**
        * the format image allowed     
        * @var array
        */
        private $imageType = array("jpg", "png", "gif");

        /**
        * image name without extension     
        * @var string
        */
        private $name;   

        private $tmp_name;

        /**
        * image new name without extension     
        * @var string
        */
        private $newName;

        /**
        * image folder image
        * @var string
        */
        private $fileLocation;

        /**
        * background image     
        * #ffffff is default
        * @var color
        */
        protected $background_color;

        /**
        * image width
        * @var int
        */
        protected $width;

        /**
        * image height
        * @var int
        */
        protected $height;       

        /**
        * position water mark horizontal
        * default is center
        * @var string
        */
        protected $watermark_position_horizontal;

        /**
        * position water mark vertical
        * default is middle
        * @var string
        */
        protected $watermark_position_vertical;

        /**
        * water mark direction
        * default is 0 and direction >= 0 and direction <= 360
        * @var int
        */
        protected $watermark_direction;

        /**
        * is background default false     
        * nếu is background là true thì sẽ thêm background vào
        * @var boolean
        */
        protected $isBackground=false;

        /**
        * address ftp          
        * @var string
        */
        protected $address="210.211.97.12"; 

        /**
        * user ftp          
        * @var string
        */
        protected $username="hdcChuotTui";

        /**
        * password ftp          
        * @var string
        */
        protected $password="HDCchuottui!@#";

        /**
        * path in ftp server          
        * @var string
        */
        protected $ftpPath="";

        public function __construct($fileLocation)
        {        
            $this->fileLocation = $fileLocation;        
            if(@chdir($this->fileLocation) == false) mkdir($this->fileLocation, 0777, true);

            $this->name = "";
            $this->newName = "";
            $this->background_color = "#ffffff";
            $this->width = "";
            $this->height = "";
            $this->watermark_text = "";
            $this->watermark_position_horizontal = "center";
            $this->watermark_position_vertical = "middle";
            $this->watermark_direction = 0;
        }

        public function createFile($fileInfo,$type=0){ 
            if(in_array($fileInfo["extension"], $this->imageType)){
                $fileInfo = $this->createImage($fileInfo,$type);    
            } else {
                $file = $this->fileLocation . $fileInfo["filename"] . "." . $fileInfo["extension"]; 
                file_put_contents($file, $fileInfo["data"], FILE_APPEND | LOCK_EX);

                if(!empty($this->ftpPath)){
                    $fileInfo = $this->ftpUpload($fileInfo);    
                }
            }
            return $fileInfo;
        }

        public function setBackgroundColor($color)
        {
            $this->background_color = $color;
        }

        private function set_img_color(&$image){        
            $this->background_color = strtolower($this->background_color);
            $red = 255;
            $green = 255;
            $blue = 255;
            if( eregi( "[#]?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})", $this->background_color, $ret ) )
            {
                $red = hexdec( $ret[1] );
                $green = hexdec( $ret[2] );
                $blue = hexdec( $ret[3] );
            }
            return imagecolorallocate($image, $red, $green, $blue);
        }

        public function setSize($width, $height){
            $this->width = $width;
            $this->height = $height;
            $this->isBackground = true;
        }

        public function resize($width, $height){
            $this->width = $width;
            $this->height = $height;
            $this->isBackground = false;
        }

        private function createImage($fileInfo,$type=0){        
            $this->name = $fileInfo["filename"];
            $this->newName = $fileInfo["newFileName"];
            $extension   = isset($fileInfo["extension"])? $fileInfo["extension"]:'jpg';

            $width = $this->width;
            $height = $this->height;                        
            $image = @imagecreatefromstring($fileInfo["data"]);
            if(empty($width) && empty($height)){
                // code cu cua dat
                /* if(!@is_file($this->fileLocation . $fileInfo["filename"] . ".jpg")){
                @imagejpeg($image, $this->fileLocation . $fileInfo["filename"] . ".jpg", "100");                
                } */ 
                if(!@is_file($this->fileLocation . $fileInfo["filename"] . $extension)){
                    if($extension=='png'){
                        @imagepng($image, $this->fileLocation . $fileInfo["filename"] . ".png");  
                    }
                    else if($extension=='gif'){      
                            $new_filename = $fileInfo["filename"] . ".gif";
                            $url_file = $fileInfo["url_file"];
                            $this->uploadImageGif($image,$new_filename,$url_file);
                        }                                              
                        else {
                            @imagejpeg($image, $this->fileLocation . $fileInfo["filename"] . ".jpg", "100");  
                    }              
                }             

            } elseif(!empty($width) && !empty($height)) {

                $width_orig = @imagesx($image);
                $height_orig = @imagesy($image);
                $ratio_orig = $width_orig / $height_orig; 
                if($type==0){
                    if (1 > $ratio_orig) {
                        /* vertical image */
                        $widthm = $height * $ratio_orig;
                        $heightm = $height;
                    } else {
                        /* horizontal image */ 
                        $widthm = $width;
                        $heightm = $width / $ratio_orig;
                        $bol = true;
                        if($heightm > $height){
                            $heightm = $height;
                            $widthm = $height * $ratio_orig;
                            $bol = false;
                        }  
                    }
                }else{
                    if($ratio_orig < 1){
                        $widthm = $width;
                        $height = $widthm / $ratio_orig;
                    }else{
                        $heightm = $width / $ratio_orig;
                    }
                }
                if($this->isBackground){

                    $result = @imagecreatetruecolor($width , $height);            
                    @imagefill($result , 0, 0 , $this->set_img_color($result));
                    if (1 > $ratio_orig) {
                        /* vertical image */
                        $sample = @imagecopyresampled($result, $image, ($width - $widthm)/2, 0, 0, 0, $widthm, $heightm, $width_orig, $height_orig);
                    } else {
                        /* horizontal image */ 
                        if($bol){
                            $sample = @imagecopyresampled($result, $image, 0, ($height - $heightm)/2, 0, 0, $widthm, $heightm, $width_orig, $height_orig);
                        }else{
                            $sample = @imagecopyresampled($result, $image, ($width - $widthm)/2, 0, 0, 0, $widthm, $heightm, $width_orig, $height_orig);
                        }
                    } 

                } else {
                    if (1 > $ratio_orig) {
                        /* vertical image */ 
                        $result = @imagecreatetruecolor($widthm , $height);                  
                        $sample = @imagecopyresampled($result, $image, 0, 0, 0, 0, $widthm, $height, $width_orig, $height_orig);                
                    } else {
                        /* horizontal image */                    
                        $result = @imagecreatetruecolor($width , $heightm);   
                        $sample = @imagecopyresampled($result, $image, 0, 0, 0, 0, $width, $heightm, $width_orig, $height_orig);                                        
                    }
                }                            
                if ($sample == false) return false;

                if(!empty($fileInfo["newFileName"])){
                    //$save = @imagejpeg($result, $this->fileLocation . $fileInfo["newFileName"] . ".jpg", "100");
                    $file_name_new  = $fileInfo["newFileName"];

                } else {
                    //$save = @imagejpeg($result, $this->fileLocation . $fileInfo["filename"] . ".jpg", "100");
                    $file_name_new  = $fileInfo["filename"];   
                }  

                // ducnv
                if($extension=='png'){
                    $save=@imagepng($result, $this->fileLocation . $file_name_new . ".png"); 
                }
                else if($extension=='gif'){
                        
                        $save = @imagegif($result, $this->fileLocation . $file_name_new . ".gif", "100");   
                    }                                              
                    else {
                        $save=@imagejpeg($result, $this->fileLocation . $file_name_new . ".jpg", "100");  
                }
                // end ducnv
                @imagedestroy($image);
                @imagedestroy($result);
            }
            if(!empty($this->ftpPath)){
                $fileInfo = $this->ftpUpload($fileInfo);    
            }

            return $fileInfo;                
        }

        public function startFtpUpload($ftpPath){
            $this->ftpPath = $ftpPath;    
        }

        private function ftpUpload($fileInfo) 
        {                       
            $error = array();
            $conn = @ftp_connect($this->address, 21);
            if(!$conn){
                $error["code"] = 500;
                $error["msg"] = "Không thể kết nối FTP";
            }

            if(!ftp_login($conn, $this->username, $this->password)){
                $error["code"] = 500;
                $error["msg"] = "Sai tài khoản hoặc mật khẩu";
            }      

            /* Upload file */          
            $cotainsSlash = strstr($this->ftpPath, "/");
            if($cotainsSlash) {
                $ftpPath = explode("/", $this->ftpPath);            
                if(count($ftpPath) > 1){                
                    /* Create each folder on ftp */
                    foreach ($ftpPath as $fpc_ftp_path) {
                        if (!@ftp_chdir($conn, $fpc_ftp_path)) {
                            if (!@ftp_mkdir($conn, $fpc_ftp_path)) {
                                $error["code"] = 500;
                                $error["msg"] = "Không đủ quyền để tạo thư mục trên Server";
                            } else {
                                if (!@ftp_chdir($conn, $fpc_ftp_path)) {
                                    $error["code"] = 500;
                                    $error["msg"] = "Không thể đọc được folder trên Server";
                                }
                            }
                        }
                    }
                }
            } else {
                if (!@ftp_chdir($conn, $this->ftpPath)) {
                    $error["code"] = 500;
                    $error["msg"] = "Không thể đọc được folder trên Server";
                }
            }

            if(!empty($fileInfo["newFileName"])){
                $ftpFilename = $fileInfo["newFileName"];            
                $localFileName = $fileInfo["newFileName"];            
            } else {
                $ftpFilename = $fileInfo["filename"];
                $localFileName = $fileInfo["filename"];            
            }        
            $localFile = $this->fileLocation . $localFileName . "." . $fileInfo["extension"];

            $fileslisting = ftp_nlist($conn, ".");    
            if(is_array($fileslisting)){              
                $count = 0;
                if(in_array($fileInfo["extension"], $this->imageType)){                
                    while(in_array($ftpFilename . ".jpg", $fileslisting) ) {
                        $count++;
                        $ftpFilename = $localFileName . "_" . $count;
                    }    
                } else {
                    while(in_array($ftpFilename . "." . $fileInfo["extension"], $fileslisting) ) {
                        $count++;
                        $ftpFilename = $localFileName . "_" . $count;
                    }   
                }            
            }

            $ftpFile = $ftpFilename . "." . $fileInfo["extension"];                        
            $upload = ftp_put($conn, $ftpFile, $localFile, FTP_BINARY);         
            if(!$upload){
                $error["code"] = 500;
                $error["msg"] = "Không thể tải file lên Server";
            } else {            
                $error["code"] = 105;
                $error["msg"] = "Tải File thành công";
                unlink($localFile);
            }            
            ftp_close($conn);

            $fileInfo["filename"] = $ftpFilename;
            return $fileInfo;
        } 

        public function createPositionWatermark($position_horizontal, $position_vertical, $watermark_direction=0){
            $this->watermark_position_horizontal = $position_horizontal;
            $this->watermark_position_vertical = $position_vertical;
            $this->watermark_direction = $watermark_direction;
        }

        public function createWatermarkImage($watermarkImage)
        {        
            $position_horizontal = $this->watermark_position_horizontal;
            $position_vertical = $this->watermark_position_vertical;        
            $watermark = imagecreatefrompng(dirname(realpath( __FILE__ )) . "/images/". $watermarkImage);   

            $watermark_width = @imagesx($watermark);
            $watermark_height = @imagesy($watermark);  

            if(!empty($this->newName)){
                $image_path = $this->fileLocation . $this->newName . ".jpg";
            } else {
                $image_path = $this->fileLocation . $this->name . ".jpg";
            }
            $image = @imagecreatefromjpeg($image_path);

            if ($image === false) {
                return false;
            }

            $size = @getimagesize($image_path);

            $dest_x = $size[0] - $watermark_width - 5;
            $dest_y = $size[1] - $watermark_height - 5;

            if($position_horizontal == "left"){
                $dest_x = 0;   
            } else if($position_horizontal == "center") {
                    $dest_x = $dest_x / 2;
                } else if($position_horizontal == "right") {
                        $dest_x = $dest_x;
                    }

                    if($position_vertical == "top"){
                $dest_y = 0;   
            } else if($position_vertical == "middle") {
                    $dest_y = $dest_y / 2;
                } else if($position_vertical == "bottom") {
                        $dest_y = $dest_y;
                    }

                    @imagealphablending($image, true);
            @imagealphablending($watermark, true);

            @imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height);
            @imagejpeg($image, $image_path, "100");

            @imagedestroy($image);
            @imagedestroy($watermark);  
        }    

        public function createWatermarkText($watermarkText) 
        {                
            $position_horizontal = $this->watermark_position_horizontal;
            $position_vertical = $this->watermark_position_vertical;        
            if(!empty($this->newName)){
                $filename = $this->newName; 
            } else {
                $filename = $this->name;
            } 

            list($width, $height) = @getimagesize($this->fileLocation . $filename . ".jpg");
            $image_p = @imagecreatetruecolor($width, $height);
            $image = @imagecreatefromjpeg($this->fileLocation . $filename . ".jpg");

            @imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
            $black = @imagecolorallocate($image_p, 0, 0, 0);       
            $font = dirname(realpath( __FILE__ )) . "/images/arial.ttf";        
            $font_size = 10;

            $image_path = $this->fileLocation . $filename . ".jpg";

            $image = @imagecreatefromjpeg($image_path);        
            if ($image === false) {
                return false;
            }                

            $dest_x = $width - 5;
            $dest_y = $height - 5;

            if($position_horizontal == "left"){
                $dest_x = 0;   
            } else if($position_horizontal == "center") {
                    $dest_x = $dest_x / 2;
                } else if($position_horizontal == "right") {
                        $dest_x = $dest_x;
                    }

                    if($position_vertical == "top"){
                $dest_y = 0;   
            } else if($position_vertical == "middle") {
                    $dest_y = $dest_y / 2;
                } else if($position_vertical == "bottom") {
                        $dest_y = $dest_y;
                    }

                    @imagettftext($image_p, $font_size, $this->watermark_direction, $dest_x, $dest_y, $black, $font, $watermarkText);
            if (!empty($this->fileLocation)) {
                @imagejpeg ($image_p, $image_path, 100);
            } 
            @imagedestroy($image);
            @imagedestroy($image_p);
        }

        public function getImageInfo($urlFile) 
        {
            $fileInfo = array();
            $size = @getimagesize($urlFile);        
            if($size!= false){            
                $fileInfo["newFileName"] = "";
                $fileInfo["mime"] = $size["mime"];    
                $fileInfo["data"] = $this->getContents($urlFile);  
                $fileInfo["filesize"] = 0;  
                $this->tmp_name = "";
                $fileInfo["url_file"] = $urlFile;
                $file_info = pathinfo($urlFile);                        
                $fileInfo["extension"] = $file_info["extension"];            

                $fileInfo["filename"] = $file_info["basename"];                                                                    
                $fileInfo["filename"] = $this->cleanFileName($fileInfo["filename"]);

                $file_info = pathinfo($fileInfo["filename"]);                                    
                $fileInfo["filename"] = basename($fileInfo["filename"], "." . $fileInfo["extension"]);

                $fileslisting = @scandir($this->fileLocation);

                // ducnv
                $extension=$fileInfo["extension"];
                if(!in_array($extension,array('png','gif'))){
                    $extension='jpg';  
                }
                // ducnv                
                if(is_array($fileslisting)){              
                    $count = 0;
                    while(in_array($fileInfo["filename"].".".$extension, $fileslisting) ) {
                        $count++;
                        $fileInfo["filename"] = $file_info["filename"] . "_" . $count;
                    }
                }

                //if(in_array($fileInfo["extension"], $this->imageType)){
                //                    $fileInfo["extension"] = "jpg";
                //                }
            }
            return $fileInfo;
        }

        public function getFileInfo($urlFile){
            $fileInfo = array();      
            $fileInfo["newFileName"] = "";
            $fileInfo["mime"] = $urlFile["type"];
            $this->tmp_name = $urlFile["tmp_name"];
            $fileInfo["url_file"] = "";
            $fileInfo["data"] = file_get_contents($urlFile["tmp_name"]);  
            $fileInfo["filesize"] = $this->returnFileSize(filesize($urlFile["tmp_name"]));

            $fileInfo["filename"] = $urlFile["name"];
            $fileInfo["filename"] = $this->cleanFileName($fileInfo["filename"]);

            $file_info = pathinfo($fileInfo["filename"]);                        
            $fileInfo["extension"] = $file_info["extension"];

            $fileInfo["filename"] = basename($fileInfo["filename"], "." . $fileInfo["extension"]);                            

            $fileslisting = @scandir($this->fileLocation);
            // ducnv
            $extension=$fileInfo["extension"];
            if(!in_array($extension,array('png','gif'))){
                $extension='jpg';  
            }
            // ducnv              
            if(is_array($fileslisting)){              
                $count = 0;
                if(in_array($fileInfo["extension"], $this->imageType)){
                    while(in_array($fileInfo["filename"] . ".".$extension, $fileslisting) ) {
                        $count++;
                        $fileInfo["filename"] = $file_info["filename"] . "_" . $count;
                    }    
                } else {
                    while(in_array($fileInfo["filename"] . "." . $fileInfo["extension"], $fileslisting) ) {
                        $count++;
                        $fileInfo["filename"] = $file_info["filename"] . "_" . $count;
                    }   
                }            
            }

            /*if(in_array($fileInfo["extension"], $this->imageType)){
            $fileInfo["extension"] = "jpg";
            }*/

            return $fileInfo;
        } 

        private function getContents($url)
        {
            $options = array(
            CURLOPT_RETURNTRANSFER => true
            , CURLOPT_HEADER         => false
            , CURLOPT_FOLLOWLOCATION => true
            , CURLOPT_ENCODING       => ""
            , CURLOPT_USERAGENT      => ""
            , CURLOPT_AUTOREFERER    => true
            , CURLOPT_CONNECTTIMEOUT => 120
            , CURLOPT_TIMEOUT        => 120
            , CURLOPT_MAXREDIRS      => 10
            );

            $ch      = curl_init( $url );
            curl_setopt_array( $ch, $options );
            $content = curl_exec( $ch );
            $err     = curl_errno( $ch );
            $errmsg  = curl_error( $ch );
            $header  = curl_getinfo( $ch );
            curl_close( $ch );

            $header['errno']   = $err;
            $header['errmsg']  = $errmsg;
            $header['content'] = $content;
            return $header["content"];
        }   

        private function cleanFileName($string) {        
            $string = $this->change($string);        
            $string = preg_replace("/(^|&\S+;)|(<[^>]*>)/U", "", $string);
            $string = trim(preg_replace('/[^\w\s\(.)\-]/', '', $string));        
            $string = strtolower(preg_replace('/[\s\-]+/', '_', $string));    
            $string = preg_replace("/[^A-Za-z0-9\(.)\_]/", "", $string);     
            $string = str_replace("small","s_mall",$string);
            $string = str_replace("medium","m_deium",$string);   
            return $string;
        }

        private function change($text) {
            $chars = array("a","A","e","E","o","O","u","U","i","I","d","D","y","Y");
            $uni[0] = array("á","à","ạ","ả","ã","â","ấ","ầ","ậ","ẩ","ẫ","ă","ắ","ằ","ặ","ẳ","ẵ","� �");
            $uni[1] = array("Á","À","Ạ","Ả","Ã","Â","Ấ","Ầ","Ậ","Ẩ","Ẫ","Ă","Ắ","Ằ","Ặ","Ẳ","Ẵ","� �");
            $uni[2] = array("é","è","ẹ","ẻ","ẽ","ê","ế","ề","ệ","ể","ễ");
            $uni[3] = array("É","È","Ẹ","Ẻ","Ẽ","Ê","Ế","Ề","Ệ","Ể","Ễ");
            $uni[4] = array("ó","ò","ọ","ỏ","õ","ô","ố","ồ","ộ","ổ","ỗ","ơ","ớ","ờ","ợ","ở","ỡ","� �");
            $uni[5] = array("Ó","Ò","Ọ","Ỏ","Õ","Ô","Ố","Ồ","Ộ","Ổ","Ỗ","Ơ","Ớ","Ờ","Ợ","Ở","Ỡ","� �");
            $uni[6] = array("ú","ù","ụ","ủ","ũ","ư","ứ","ừ","ự","ử","ữ");
            $uni[7] = array("Ú","Ù","Ụ","Ủ","Ũ","Ư","Ứ","Ừ","Ự","Ử","Ữ");
            $uni[8] = array("í","ì","ị","ỉ","ĩ");
            $uni[9] = array("Í","Ì","Ị","Ỉ","Ĩ");
            $uni[10] = array("đ");
            $uni[11] = array("Đ");
            $uni[12] = array("ý","ỳ","ỵ","ỷ","ỹ");
            $uni[13] = array("Ý","Ỳ","Ỵ","Ỷ","Ỹ");

            for($i=0; $i<=13; $i++) {
                $text = str_replace($uni[$i],$chars[$i],$text);
            }
            return $text;
        }
        public function returnFileSize($fileSize) {
            switch ($fileSize) :
            case ($fileSize < 1024):
                return $fileSize.' bit';
            case ($fileSize > 1024 && $fileSize < 1048576):
                return round($fileSize/1024, 1).' KB';
            case ($fileSize > 1048576 && $fileSize < 1073741824):
                return round($fileSize/1048576, 1).' MB';
            case ($fileSize > 1073741824 && $fileSize < 1099511627776 ):
                return round($fileSize/1073741824, 1).' GB';
            case ($fileSize > 1099511627776 && $fileSize < 1125899906842624):
                return round($fileSize/1099511627776, 1).' TB';
            case ($fileSize > 1125899906842624):
                return round($fileSize/1125899906842624, 1).' PB';
            default:
                return $fileSize;
                endswitch;
        }

        function uploadImageGif($image,$new_filename,$url_file){           
            $upload_dir = $this->fileLocation.$new_filename;
            if($this->tmp_name !=""){                
                @copy($this->tmp_name, "$upload_dir");     
            }else{
                if($url_file !=""){
                    @copy($url_file,$upload_dir);
                }else{
                    @imagegif($image, $this->fileLocation . $new_filename, "100");
                }
            }

        }
    }  
?>
