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
        try {
            if ($this->caesarView->isEncryptionPost()) {
                // TODO Set language
                $this->encryptPost();
            } else if ($this->caesarView->isDecryptionPost()) {
                $this->decryptPost();
            }
        } catch (\encrypt\model\IllegalCharacterException $e) {
            $this->caesarView->setMessage(\encrypt\view\Messages::INVALID_CHARACTER);
        } catch (\encrypt\model\EmptyStringException $e) {
            $this->caesarView->setMessage(\encrypt\view\Messages::NO_CHARACTERS_ENTERED);
        }
    }
    private function encryptPost () {
        $textInput = $this->getTextInputUncapitalized();
        $this->transferKeyFromViewToEncryption();
        $this->transferMessageFromEncryptionToView($textInput);
    }
    private function decryptPost () {
        $this->encryptionModel->setIsDecryption(true);
        $textInput = $this->getTextInputUncapitalized();
        $this->transferKeyFromViewToEncryption();
        $this->transferMessageFromEncryptionToView($textInput);
    }
    private function getTextInputUncapitalized () {
        $textInput = $this->caesarView->getTextInput();
        $textLowerChase = strtolower($textInput);
        return $textLowerChase;
    }
    private function transferKeyFromViewToEncryption () {
        $key = $this->caesarView->getRequestEncryptionKey();
        $this->encryptionModel->setKey($key);
    }
    private function transferMessageFromEncryptionToView($textInput) {
        $encryptedMessage = $this->encryptionModel->encryptStringWithKey($textInput);
        $this->caesarView->setEncryptedMessage($encryptedMessage);
    }
  }