<?php

namespace src\model;

class Encoder {

    function __construct() {}

    function encode($string, $algo, $compress, $strength) {
        switch ($algo) {
            case 'base64':
                if ($compress == 'true') {
                    return base64_encode(gzdeflate($string, $strength));
                }
                return base64_encode($string);
                break;

            case 'rot_13':
                return str_rot13($string);
                break;

            case 'url':
                return urlencode($string);
                break;

            case 'json':
                return json_encode($string);
                break;

            case 'hex':
                $hex = '\x';
                $j = 0;
                for ($i = 0; $i < strlen($string); $i++) {
                    $hex .= dechex(ord($string[$i]));
                    $j++;
                    if ($j == 1) {
                        $hex .= '\x';
                        $j = 0;
                    }
                }
                return substr($hex,0,strlen($hex) - 2);
                break;

            case 'bin':
                $len = strlen($string);
                $bin = '';
                for($i = 0; $i < $len; $i++  )
                {
                    $bin .= strlen(decbin(ord($string[$i]))) < 8 ? str_pad(decbin(ord($string[$i])), 8, 0, STR_PAD_LEFT) : decbin(ord($string[$i]));
                }
                return $bin;

                break;
        }
        return false;
    }

     function decode($string, $algo, $compress) {
        switch ($algo) {
            case 'base64':
                if ($compress == 'true') {
                    return gzinflate(base64_decode($string));
                }
                return base64_decode($string);
                break;

            case 'rot_13':
                return str_rot13($string);
                break;

            case 'url':
                return urldecode($string);
                break;

            case 'json':
                return json_decode($string);
                break;

            case 'hex':
                return pack('H*', str_replace('\X', '', $string));
                break;

            case 'bin':
                $text_str = '';
                $chars = explode("\n", chunk_split(str_replace("\n", '', $string), 8));
                $_I = count($chars);
                for($i = 0; $i < $_I; $text_str .= chr(bindec($chars[$i])), $i++  );
                return substr($text_str, 0, -1);




        }
        return false;
    }


}