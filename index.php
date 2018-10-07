<?php

//THE FILES NEEDED
// VIEW
require_once('view/RegisterView.php');
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/DashBoard.php');
// MODEL
require_once('model/ServerTime.php');
require_once('model/LoginServer.php');
require_once('model/SessionServer.php');
require_once('model/RegisterServer.php');
require_once('model/DatabaseConnection.php');
// CONTROLLER
require_once('controller/Controller.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');

// OPTIONS FOR SHOWING ERRORS
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// STARTING SESSION
session_start();

//INSTANCES
$v = new \view\LoginView();
$rv = new \view\RegisterView();
$dtv = new \view\DateTimeView();
$d = new \view\DashBoard();

$st = new \model\ServerTime();
$ss = new \model\SessionServer();
$dc = new \model\DatabaseConnection();
$ls = new \model\LoginServer($dc);
$rs = new \model\RegisterServer($dc);

$lc = new \controller\LoginController($v, $d, $ls, $ss);
$rc = new \controller\RegisterController($rv, $rs);
$c = new \controller\Controller($v, $dtv, $d, $st, $ls, $ss, $lc, $rc);

$isRegistering = $rv->isRegistering();
$isLoggedin = $ss->isLoggedIn();

$lv = new \view\LayoutView($isLoggedin, $isRegistering, $v, $dtv, $d, $rv);

$lv->render();

