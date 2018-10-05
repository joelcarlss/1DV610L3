<?php

namespace controller;
use Exception;
class RegisterController {
    
    private $rs;
    
    public function __construct (\model\RegisterServer $rs) {
        $this->rs = $rs;
    }

}