<?php
namespace encrypt\controller;
require_once('modules/encrypt/view/Messages.php');

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
            try {
                // TODO Set language
                $this->encryptPost();
            } catch (\encrypt\model\IllegalCharacterException $e) {
                $this->caesarView->setMessage(\encrypt\view\Messages::INVALID_CHARACTER);
            }
        }
    }
    private function encryptPost () {
        $textInput = $this->caesarView->getTextInput();
        $textLowerChase = strtolower($textInput);
        $key = $this->caesarView->getRequestEncryptionKey();
        $this->encryptionModel->setKey($key);
        $encryptedMessage = $this->encryptionModel->encryptStringWithKey($textLowerChase);
        $this->caesarView->setEncryptedMessage($encryptedMessage);
        
    }
  }