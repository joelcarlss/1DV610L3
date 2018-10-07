<?php

namespace view;

class LayoutView {

  private $isLoggedIn;
  private $isRegistering;
  private $v;
  private $dtv;
  private $lv;
  private $d;
  private $rv;

  public function __construct (bool $isLoggedIn, bool $isRegistering, \view\LoginView $v, \view\DateTimeView $dtv, \view\DashBoard $d, \view\RegisterView $rv) {
    $this->isLoggedIn = $isLoggedIn;
    $this->isRegistering = $isRegistering;
    $this->v = $v;
    $this->dtv = $dtv;
    $this->d = $d;
    $this->rv = $rv;
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
          ' . $this->renderRegisterLink() . '
          ' . $this->renderIsLoggedIn() . '
          
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
    } else if ($this->isRegistering) {
      $render = $this->rv->response();
    } else {
      $render = $this->v->response();
    }
    return $render;
  }
  private function renderRegisterLink() {
     if (!$this->isLoggedIn) {
      if ($this->isRegistering) {
        return '<a href="?">Back to login</a>';
      } else {
        return '<a href="?register">Register a new user</a>';
      }
     }
  }
}
