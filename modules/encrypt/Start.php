<?php
namespace encrypt;

require_once('modules/encrypt/view/LayoutView.php');
require_once('modules/encrypt/view/CaesarView.php');
require_once('modules/encrypt/model/EnglishAlphabet.php');
require_once('modules/encrypt/controller/MainController.php');

class Start {

  private $layoutView;
  private $mainController;
  private $caesarView;

  public function __construct () {
    $this->englishAlphabet = new \encrypt\model\EnglishAlphabet();
    $this->caesarView = new \encrypt\view\CaesarView($this->englishAlphabet);
    $this->layoutView = new \encrypt\view\LayoutView($this->caesarView);
    $this->mainController = new \encrypt\controller\MainController($this->layoutView, $this->caesarView, $this->englishAlphabet);
    $this->mainController->handleRequest();
}
  
  public function render() {
    return $this->layoutView->render();
  }
}
