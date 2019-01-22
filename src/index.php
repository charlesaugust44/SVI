<?php
require_once 'Auth.php';
require_once 'CredentialsException.php';
require_once 'View.php';
require_once 'Router.php';
require_once 'Utils.php';
require_once 'IC.php';

IC::setStart();

header('Content-Type: text/html; charset=uft-8');
setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$view = "Web/View/";

$router = new Router($_SERVER['REQUEST_URI']);
$router->call();