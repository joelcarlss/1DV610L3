<?php
namespace encrypt\controller;

class MainController {

    private $mainController;
    private $caesarView;
    private $englishAlphabet;


    public function __construct (\encrypt\view\LayoutView $lv, \encrypt\view\CaesarView $cv, \encrypt\model\englishAlphabet $ea) {
        $this->layoutView = $lv;
        $this->caesarView = $cv;
        $this->englishAlphabet = $ea;
    }
    
    public function handleRequest() {
        if ($this->caesarView->isEncryptionPost()) {
            
            echo $this->encryptPost();
        }
    }
    private function encryptPost () {
        $textInput = $this->caesarView->getTextInput();
        echo $textInput;
        
    }
  }