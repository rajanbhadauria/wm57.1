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
?>
