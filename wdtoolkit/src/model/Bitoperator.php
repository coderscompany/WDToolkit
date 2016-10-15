<?php
/**
 * Created by PhpStorm.
 * User: seppel
 * Date: 21.06.16
 * Time: 17:52
 */

namespace src\model;

class Bitoperator {

    private $first_value;
    private $second_value;

    /**
     * @param $first
     * @param $second
     */
    function __construct($first, $second) {
        $temp = $this->addPadding(trim($first), trim($second));
        $this->first_value = $temp[0];
        $this->second_value = $temp[1];
    }

    /**
     * @param $a
     * @param $b
     * @return array
     */
    private function addPadding($a, $b) {
        $c = '';
        $d = '';
        $a_len = strlen($a);
        $b_len = strlen($b);
        $padding_length = 0;
        if ($a_len < $b_len) {
            $padding_length = $b_len - $a_len;
            for ($i = 0; $i < $padding_length; $i++) {
                $c .= '0';
            }
            return array($c .= $a, $d = $b);
        }
        elseif ($b_len < $a_len) {
            $padding_length = $a_len - $b_len;
            for ($i = 0; $i < $padding_length; $i++) {
                $d .= '0';
            }
            return array($c = $a, $d .= $b);
        }
        return array($a, $b);
    }

    /**
     * @param $mode
     * @return bool|null|string
     */
    function operate($mode) {
        $result = null;
        switch ($mode) {
            case 'and':
                for ($i = 0; $i < strlen($this->first_value); $i++) {
                    $result .= intval($this->first_value[$i]) & intval($this->second_value[$i]);
                }
                return $result;
                break;
            case 'or':
                for ($i = 0; $i < strlen($this->first_value); $i++) {
                    $result .= intval($this->first_value[$i]) | intval($this->second_value[$i]);
                }
                return $result;
                break;
            case 'xor':
                for ($i = 0; $i < strlen($this->first_value); $i++) {
                    $result .= intval($this->first_value[$i]) ^ intval($this->second_value[$i]);
                }
                return $result;
                break;
            default:
                return false;
                break;
        }
    }

}
