<?php

namespace view;

class LayoutView {

  private $isLoggedIn;
  private $v;
  private $dtv;
  private $lv;
  private $d;

  public function __construct ($isLoggedIn, \view\LoginView $v, \view\DateTimeView $dtv, \view\DashBoard $d) {
    $this->isLoggedIn = $isLoggedIn;
    $this->v = $v;
    $this->dtv = $dtv;
    $this->d = $d;
}
  
  public function render() {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($this->isLoggedIn) . '
          
          <div class="container">
              ' . $this->getPageToRender() . '
              
              ' . $this->dtv->showTime() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn() {
    if ($this->isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
  private function getPageToRender() {
    $render = '';
    if ($this->isLoggedIn) {
      $render = $this->d->response();
    } else {
      $render = $this->v->response();
    }
    return $render;
  }
}
