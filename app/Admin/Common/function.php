<?php

function attach($attach, $type) {
    if (false === strpos($attach, 'http://')) {
        //本地附件
        $img_url = __ROOT__ . '/' . C('pin_attach_path') . $type . '/' . $attach;
        $img_path = realpath('./').'/'. C('pin_attach_path') . $type . '/' . $attach;

        if(is_file($img_path)){
            return $img_url;
        }else{
            $img_url = __ROOT__ . '/data/image/nopicture.gif';
            return  $img_url;
        }
        //远程附件
        //todo...
    } else {
        //URL链接
        return $attach;
    }
}