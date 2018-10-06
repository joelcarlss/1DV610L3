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
require_once('model/SessionServer.php');
require_once('model/RegisterServer.php');
require_once('model/DatabaseConnection.php');
// CONTROLLER
require_once('controller/Controller.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');

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
// $dc = new \model\DatabaseConnection();
// $rs = new \model\RegisterServer($dc);

$lc = new \controller\LoginController($v, $d, $ls, $ss);
// $rc = new \controller\RegisterController($rs);
$c = new \controller\Controller($v, $dtv, $d, $st, $ls, $lc);

// $rc->registerNewUser();
$lv = new \view\LayoutView(false, $v, $dtv, $d);

$lv->render();

