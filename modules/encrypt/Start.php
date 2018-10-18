<?php
namespace encrypt;

require_once('modules/encrypt/view/LayoutView.php');
require_once('modules/encrypt/view/CaesarView.php');
// require_once('modules/encrypt/model/SwedishAlphabet.php');
require_once('modules/encrypt/controller/MainController.php');

class Start {

  private $layoutView;
  private $mainController;
  private $caesarView;



  public function __construct () {
    $this->caesarView = new \encrypt\view\CaesarView();
    $this->layoutView = new \encrypt\view\LayoutView($this->caesarView);
    $this->mainController = new \encrypt\controller\MainController($this->layoutView, $this->caesarView);
    $this->mainController->run();
}
  
  public function render() {
    return $this->layoutView->render();
  }
}
