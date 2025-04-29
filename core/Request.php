<?php

class Request {

    protected array $_post;
    protected array $_files;

    public function __construct() {
        $this->_post  = $_POST;
        $this->_files = $_FILES;
    }

    public function post($item, $default = null) {
        return Arr::get($this->_post, $item, $default);
    }

    public function file($item) {
        return Arr::get($this->_files, $item);
    }

}
