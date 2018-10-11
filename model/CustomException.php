<?php

namespace model;

class CustomException extends Exception {
  public function errorMessage() {
    //error message
    $errorMsg = 'Wrong username';
    return $errorMsg;
  }
}