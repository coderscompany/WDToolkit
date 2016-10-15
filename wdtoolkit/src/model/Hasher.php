<?php

namespace src\model;

class Hasher {

    private $content;
    private $algorithm;
    private $file;

    /**
     * @param null $content
     * @param $algorithm
     * @param null $file
     */
     function __construct($content = null, $algorithm, $file = null) {
        $this -> content = $content;
        $this -> algorithm = $algorithm;
        if ($file != null) {
            $this->file = $file;
        }
    }

    /**
     * @param null $salt
     * @return string
     */
     function getHash($salt = null) {
        if ($this->file == null) {
            if ($this->content != null) {
                if ($salt != null) {
                    return hash($this->algorithm, $this->content . $salt);
                }
                return hash($this->algorithm, $this->content);
            }
        }
        $hash = hash_file($this->algorithm, $this->file);
        unlink($this->file);
        return $hash;
    }

}