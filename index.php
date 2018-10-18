<?php

//THE FILES NEEDED
// VIEW
require_once('app/view/RegisterView.php');
require_once('app/view/LoginView.php');
require_once('app/view/DateTimeView.php');
require_once('app/view/LayoutView.php');
require_once('app/view/DashBoard.php');
// MODEL
require_once('app/model/ServerTime.php');
require_once('app/model/LoginServer.php');
require_once('app/model/SessionServer.php');
require_once('app/model/RegisterServer.php');
require_once('app/model/DatabaseConnection.php');
// CONTROLLER
require_once('app/controller/MainController.php');
require_once('app/controller/CookieController.php');
require_once('app/controller/LoginController.php');
require_once('app/controller/LogOutController.php');
require_once('app/controller/RegisterController.php');

require_once('module/encrypt/Start.php');

// OPTIONS FOR SHOWING ERRORS
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// STARTING SESSION
session_start();

//INSTANCES
$enc = new \encrypt\Start();

$v = new \view\LoginView();
$rv = new \view\RegisterView();
$dtv = new \view\DateTimeView();
$d = new \view\DashBoard($enc);

$st = new \model\ServerTime();
$ss = new \model\SessionServer();
$dc = new \model\DatabaseConnection();
$ls = new \model\LoginServer($dc);
$rs = new \model\RegisterServer($dc);

$cc = new \controller\CookieController($v, $d, $ls, $ss);
$lc = new \controller\LoginController($v, $d, $ls, $ss, $cc);
$loc = new \controller\LogOutController($v, $d, $ss);
$rc = new \controller\RegisterController($rv, $rs);
$mc = new \controller\MainController($v, $dtv, $st, $lc, $loc, $cc, $rc);

$mc->start();
$isRegistering = $rv->isRegistering();
$isLoggedin = $ss->isLoggedIn();

$lv = new \view\LayoutView($isLoggedin, $isRegistering, $v, $dtv, $d, $rv);

$lv->render();

