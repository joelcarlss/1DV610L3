<?php
namespace encrypt\view;

class LayoutView {

  private $title = 'Encryption';
  
  public function __construct (CaesarView $cv) {
    $this->caesarView = $cv;
}
  
  public function render() : string {
    return '
          <h3> ' . $this->title .' </h3>
            <div>
            ' . $this->getPageToRender() . '
            </div>
    ';
  }

  private function getPageToRender() : string {
    return $this->caesarView->render();
  }
}
