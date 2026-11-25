<?php

/*function admin_models_actions($model,) {


    return array(
        (object) array('slug' => 'ar','title' => 'Arabic','country' => 'Saudi Arabia','city' => 'Saudi Arabia'),
        //   (object) array('slug' => 'en','title' => 'English','country' => 'United States of America')
//        (object) array('slug' => 'tr','title' => 'Turkish','country' => 'Turkey')
    );
}*/

function make_slug($string, $separator = '-') {
    if (is_null($string)) {
        return "";
    }

    $string = trim($string);

    $string = mb_strtolower($string, "UTF-8");;

    $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

    $string = preg_replace("/[\s-]+/", " ", $string);

    $string = preg_replace("/[\s_]/", $separator, $string);

    return $string;
}

function phone_remove_spaces_and_plus() {
    if (setting('phone')) {
        $string = str_replace(' ', '', setting('phone'));
        $phone = str_replace('+', '', $string);
        return $phone;
    }else{
        return "";
    }
}

?>
