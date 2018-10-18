<?php
namespace encrypt\view;

class CaesarView {

  private $title = 'Encryption';
  private $caesarView;
  
  public function __construct (CaesarView $cv) {
      $this->caesarView = $cv;
}
  
  public function render() {
    return '
            <div>
            
            </div>
    ';
  }
}
