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

// sorting date array in assending
if(!function_exists('dateSort')) {
    function dateSort( $a, $b ) {
        return strtotime($a) - strtotime($b);
    }
}

// return year from date
if(!function_exists('getYear')) {
    function getYear($date ) {
        return date('Y', strtotime($date));
    }
}

if(!function_exists('time_ago')) {
    function time_ago ($timestamp, $level=6) {
        $lang = array(
            'second' => 'second',
            'seconds' => 'seconds',
            'minute' => 'minute',
            'minutes' => 'minutes',
            'hour' => 'hour',
            'hours' => 'hours',
            'day' => 'day',
            'days' => 'days',
            'month' => 'month',
            'months' => 'months',
            'year' => 'year',
            'years' => 'years',
            'and' => 'and',
        );
        $date = new DateTime();
        $date->setTimestamp($timestamp);
        $date = $date->diff(new DateTime());
        // build array
        $since = json_decode($date->format('{"year":%y,"month":%m,"day":%d,"hour":%h,"minute":%i,"second":%s}'), true);
        // remove empty date values
        $since = array_filter($since);
        // output only the first x date values
        $since = array_slice($since, 0, $level);
        // build string
        $last_key = key(array_slice($since, -1, 1, true));
        $string = '';
        foreach ($since as $key => $val) {
            // separator
            if ($string) {
                $string .= $key != $last_key ? ', ' : ' ' . $lang['and'] . ' ';
            }
            // set plural
            $key .= $val > 1 ? 's' : '';
            // add date value
            $string .= $val . ' ' . $lang[ $key ];
        }
        return $string;
    }
}


?>
