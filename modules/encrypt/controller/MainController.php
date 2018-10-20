<?php
namespace encrypt\controller;

class MainController {

    private $mainController;
    private $caesarView;
    private $englishAlphabet;
    private $encryptionModel;


    public function __construct (\encrypt\view\LayoutView $lv, \encrypt\view\CaesarView $cv, \encrypt\model\EnglishAlphabet $ea, \encrypt\model\EncryptionModel $em) {
        $this->layoutView = $lv;
        $this->caesarView = $cv;
        $this->englishAlphabet = $ea;
        $this->encryptionModel = $em;
    }
    
    public function handleRequest() {
        if ($this->caesarView->isEncryptionPost()) {
            $this->encryptPost();
        }
    }
    private function encryptPost () {
        $textInput = $this->caesarView->getTextInput();
        $key = $this->caesarView->getRequestEncryptionKey();
        $this->encryptionModel->setKey($key);
        $encryptedMessage = $this->encryptionModel->encryptStringWithKey($textInput);
        $this->caesarView->setEncryptedMessage($encryptedMessage);
        
    }
  }