<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function name_image($str, $addTime = true, $subLength = true)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/(_| )/', '-', $str);
        if($subLength == true){
            $str = substr($str, 0, 20);
        }

        if($addTime == true){
            $str .= '-' . time();
        }
        return $str;
    }

    public function saveImgBase64($param, $folder, $name = "image")
    {
        if (!is_dir('images/' . $folder)) {
            mkdir('images/' . $folder);
        }
        $name = ($name != null && $name != '') ? $name : 'image';
        $name = $name.'-'.time().'.jpg';
        $base64_str = substr($param, strpos($param, ",") + 1);
        $image = base64_decode($base64_str);
        $path = public_path('images/' . $folder . '/' . $name);
        file_put_contents($path, $image);
        return '/images/' . $folder . '/' . $name;
    }

    public function deleteFolder($folder)
    {
        if (is_dir($folder)) {
            $objects = scandir($folder);

            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($folder . '/' . $object) == "dir") remove_dir($folder . '/' . $object);
                    else unlink($folder . '/' . $object);
                }
            }
            reset($objects);
            rmdir($folder);
        }
    }
}
