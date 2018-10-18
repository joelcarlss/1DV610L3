<?php
namespace encrypt\view;

class LayoutView {

  private $title = 'Encryption';
  
  public function __construct () {
}
  
  public function render() {
    return '
          <h3> ' . $this->title .' </h3>
            <div>
            ' . $this->getPageToRender() . '
            </div>
    ';
  }

  private function getPageToRender() {
    return 
  }
}
