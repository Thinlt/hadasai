<?php

namespace common\utilities;

use Yii;

class Common
{

    public static function show_paging($maxPage,$currentPage, $path = '',$object = '',$first = '',$last = '') {
        $url = new \yii\helpers\Url;        
        if($maxPage <=1){
            $html = "";return $html;
        }
        $nav = array(
        // bao nhiêu trang bên trái currentPage
        'left' => 2,
        // bao nhiêu trang bên phải currentPage
        'right' => 2,
        );

        // nếu maxPage < currentPage thì cho currentPage = maxPage
        if ($maxPage < $currentPage) {
            $currentPage = $maxPage;
        }

        // số trang hiển thị
        $max = $nav['left'] + $nav['right'];

        // phân tích cách hiển thị
        if ($max >= $maxPage) {
            $start = 1;
            $end = $maxPage;
        } elseif ($currentPage - $nav['left'] <= 0) {
            $start = 1;
            $end = $max + 1;
        } elseif (($right = $maxPage - ($currentPage + $nav['right'])) <= 0) {
            $start = $maxPage - $max;
            $end = $maxPage;
        } else {
            $start = $currentPage - $nav['left'];
            if ($start == 2) {
                $start = 1;
            }

            $end = $start + $max;
            if ($end == $maxPage - 1) {
                ++$end;
            }
        }
        $navig = '';
        if ($currentPage >= 2) {
            // thêm nút "Trước"
            $navig .= '<li class="fl"><a href="' . $path . 'page'.$object.'=' . ceil($currentPage - 1) . '"><strong>← Previous</strong></a></li>';
            if ($currentPage >= $nav['left']) {
                if ($currentPage - $nav['left'] > 2 && $max < $maxPage) {
                    // thêm nút "1"
                    $navig .= '<li class="fl"><a href="' . $path . 'page'.$object.'=1' . '"><strong>'. $first .'1'. $last .'</strong></a></li>';
                    $navig .= '<li class="fl">...</li>';
                }
            }
        }

        for ($i = $start; $i <= $end; $i++) {
            // trang hiện tại
            if ($i == $currentPage) {
                $navig .= '<li class="fl active"><a href="' . $path . 'page'.$object.'=' . $i . '"><strong>'. $first . $i . $last .'</strong></a></li>';
            }
            // trang khác
            else {
                //     $pg_link = $path.'page='.$i;
                $navig .= '<li class="fl"><a href="' . $path . 'page'.$object.'=' . $i . '"><strong>'. $first . $i . $last .'</strong></a></li>';
            }
        }

        if ($currentPage <= $maxPage - 1) {
            if ($currentPage + $nav['right'] < $maxPage - 1 && $max + 1 < $maxPage) {
                // trang cuoi
                $navig .= '<li class="fl">...</li>';
                $navig .= '<li class="fl"><a href="' . $path . 'page'.$object.'=' . $maxPage . '"><strong>'. $first . $maxPage . $last .'</strong></a></li>';
            }
            $navig .= '<li class="fl"><a href="' . $path . 'page'.$object.'=' . ($currentPage + 1) . '"><strong>Next →</strong></a></li>';
        }

        // hiển thị kết quả
        return $navig;
    }
    
    public static function getCurrentUrl(){
        $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        if ($_SERVER["SERVER_PORT"] != "80")
        {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        }
        else
        {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
    
    public static function genUploadKey() {
        $_fn_key = 'tuenv_findnex@*&^$#*2015.com.' . date('Y-m-d H');
        $cipherText_dec = json_encode(array('ok'=>true));
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CFB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

        $cipherText = mcrypt_encrypt(MCRYPT_BLOWFISH, $_fn_key, $cipherText_dec, MCRYPT_MODE_CFB, $iv);
        $cipherText = $iv . $cipherText;
        return urlencode(base64_encode($cipherText));
    }
}