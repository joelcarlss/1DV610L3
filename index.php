<?php

//THE FILES NEEDED
// VIEW
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/DashBoard.php');
// MODEL
require_once('model/ServerTime.php');
require_once('model/LoginServer.php');
// CONTROLLER
require_once('controller/Controller.php');
require_once('controller/LoginController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$v = new \view\LoginView();
$dtv = new \view\DateTimeView();
$d = new \view\DashBoard();

$st = new \model\ServerTime();
$ls = new \model\LoginServer();
$ss = new \model\SessionServer();

$lc = new \controller\LoginController($v, $d, $ls, $ss);
$c = new \controller\Controller($v, $dtv, $d, $st, $ls, $lc);

$lv = new \view\LayoutView(false, $v, $dtv, $d);

$lv->render();

