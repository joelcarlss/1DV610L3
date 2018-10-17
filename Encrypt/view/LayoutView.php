<?php
namespace encrypt\view;

class LayoutView {

  private $title = 'Encryption';
  
  public function __construct () {
}
  
  public function render() {
    return '
          <h2> ' . $this->title .' </h2>
            <div>
              ' . $this->getPageToRender() . ' 
            </div>
    ';
  }

  private function getPageToRender() {
    
  }
}
