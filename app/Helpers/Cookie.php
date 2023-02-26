<?php
error_reporting(0); // hatalari gosterme

class Cookie
{


    function encrypt_decrypt($action, $string)
    {
        if ($action == 'encrypt') {
            return urlencode(base64_encode($string));
        } else if ($action == 'decrypt') {
            return base64_decode(urldecode($string));
        }
    }

    function cookie($par)
    {
        $par = encrypt_decrypt('encrypt', urlencode($par));
        if ($_COOKIE[$par]) {
            return encrypt_decrypt('decrypt', $_COOKIE[$par]);
        } else {
            return false;
        }
    }

    function set_cookie($name, $value, $time)
    {
        $name = urlencode(encrypt_decrypt('encrypt', $name));
        $value = encrypt_decrypt('encrypt', $value);
        return setcookie($name, $value, $time);
    }

}
