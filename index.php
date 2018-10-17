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
require_once('controller/MainController.php');
require_once('controller/CookieController.php');
require_once('controller/LoginController.php');
require_once('controller/LogOutController.php');
require_once('controller/RegisterController.php');

require_once('encrypt/Start.php');

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

