<?php

if (!function_exists('my_asset')) {
    function my_asset($path, $secure = null){
        return asset('/public/assets/' . trim($path, '/'), $secure);
    }
}

if(!function_exists('uploads_url')) {
    function uploads_url($path, $secure = null){
        return asset('/public/uploads/' . trim($path, '/'), $secure);
    }
}

if(!function_exists('get_user_image')) {
    function get_user_image($path){
        if($path == "" || $path == null) {
            return uploads_url('images/user/user-img-white.jpg');
        } elseif(strpos($path, 'ttp')) {
            return $path;
        } else {
            return uploads_url('images/user/'.$path);
        }
    }
}
?>
