<?php
namespace encrypt\controller;

class MainController {

    private $mainController;
    private $caesarView;


    public function __construct (MainController $mc, CaesarView $cv) {
        $this->mainController = $mc;
        $this->caesarView = $cv;
    }
    
    public function run() {
      return 'Hello Wold';
    }
  }