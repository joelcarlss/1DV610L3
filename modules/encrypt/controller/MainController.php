<?php
namespace encrypt\controller;

class MainController {

    private $mainController;
    private $caesarView;


    public function __construct (\encrypt\view\LayoutView $lv, \encrypt\view\CaesarView $cv) {
        $this->layoutView = $lv;
        $this->caesarView = $cv;
    }
    
    public function handleRequest() {
        if ($this->caesarView->isEncryptionPost()) {
            
        }
    }
    private function encryptPost () {
        $textInput = $this->caesarView->getRequestTextInput();
        
    }
  }