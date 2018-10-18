<?php
namespace encrypt;

require_once('modules/encrypt/view/LayoutView.php');
// require_once('modules/encrypt/model/SwedishAlphabet.php');
require_once('modules/encrypt/controller/MainController.php');

class Start {

  private $layoutView;
  private $mainController;



  public function __construct () {
    $this->layoutView = new \encrypt\view\LayoutView();
    $this->mainController = new \encrypt\controller\MainController($this->layoutView);
}
  
  public function render() {
    return $this->layoutView->render();
  }
}
