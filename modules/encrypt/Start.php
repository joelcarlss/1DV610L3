<?php
namespace encrypt;

require_once('modules/encrypt/model/EnglishAlphabet.php');
require_once('modules/encrypt/model/EncryptionModel.php');
require_once('modules/encrypt/view/CaesarView.php');
require_once('modules/encrypt/view/LayoutView.php');
require_once('modules/encrypt/controller/MainController.php');

class Start {

  private $englishAlphabet;
  private $layoutView;
  private $mainController;
  private $caesarView;

  public function __construct () {
    $this->englishAlphabet = new \encrypt\model\EnglishAlphabet();
    $this->encryptionModel = new \encrypt\model\EncryptionModel($this->englishAlphabet);
    $this->caesarView = new \encrypt\view\CaesarView($this->englishAlphabet);
    $this->layoutView = new \encrypt\view\LayoutView($this->caesarView);
    $this->mainController = new \encrypt\controller\MainController($this->layoutView, $this->caesarView, $this->englishAlphabet, $this->encryptionModel);
    $this->mainController->handleRequest();
}
  
  public function render() {
    return $this->layoutView->render();
  }
}
