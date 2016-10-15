<?php

namespace src\model;
class Colors {

    /**
     * @param $hexcolor
     * @return array
     */
     static function hex2grb($hexcolor) {
        if($hexcolor[0] == '#') {
            $hexcolor = substr($hexcolor, 1);
        }
        if (strlen($hexcolor) == 3) {
            $r = hexdec(substr($hexcolor,0,1).substr($hexcolor,0,1));
            $g = hexdec(substr($hexcolor,1,1).substr($hexcolor,1,1));
            $b = hexdec(substr($hexcolor,2,1).substr($hexcolor,2,1));
        }
        else {
            $r = hexdec(substr($hexcolor,2,2));
            $g = hexdec(substr($hexcolor,0,2));
            $b = hexdec(substr($hexcolor,4,2));
        }
        return array('r' => $r, 'g' => $g, 'b' => $b);
    }

}