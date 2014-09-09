<?php

class Captcha
{

    public function make($str = '', $is_text = 'yes')
    {
        global $uri;


        $main_img = imagecreatetruecolor(235, 78);

        $bg_color = imagecolorallocate($main_img, 255, 255, 255);

        imagefill($main_img, 0, 0, $bg_color);

        $captcha_str = $str;

        if ($str == '') {
            $captcha_str = String::randAlpha(5);
        }

        $black = imagecolorallocate($main_img, 11, 85, 221);


        $font_file = ROOT_PATH . 'uploads/Eirik Raude.ttf';

        imagefttext($main_img, 60, 0, 15, 55, null, $font_file, $captcha_str);

//        Create session
        $hash = md5($uri);

        $_SESSION[$hash] = $captcha_str;

        if ($is_text == 'no') {
            header("Content-type: image/png");

            imagepng($main_img);
        } else {

            imagepng($main_img);

            $dataImg = ob_get_contents();
            ob_end_clean();

            echo 'data:image/png;base64,' . base64_encode($dataImg);
        }


    }

    public function verify($verifyId, $inputName = 'captcha_verify')
    {
        if (isset($_REQUEST[$inputName])) {

            $text = $_REQUEST[$inputName];

            $verifyStatus = ($text == $_SESSION[$verifyId]) ? true : false;

            return $verifyStatus;
        }
    }


}

?>