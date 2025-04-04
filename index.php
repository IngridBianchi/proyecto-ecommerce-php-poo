<?php
session_start();
ob_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php'; 

function show_error(){
	$error = new errorController();
	$error->index();
}
// Determinar el controlador y la acción
if(isset($_GET['controller'])){
	$nombre_controlador = $_GET['controller'].'Controller';

}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
	$nombre_controlador = controller_default;
	
}else{
	show_error();
	exit();
}

if(class_exists($nombre_controlador)){	
	$controlador = new $nombre_controlador();
	
	if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
		$action = $_GET['action'];
		if ($action != 'save' && $action != 'login' && $action != 'logout') {
			require_once 'views/layout/header.php';
			require_once 'views/layout/sidebar.php';
	}
		$controlador->$action();
	}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
		$action_default = action_default;
		$controlador->$action_default();
	}else{
		show_error();
	}
}else{
	show_error();
}

if (!isset($_GET['action']) || ($_GET['action'] != 'save' && $_GET['action'] != 'login' && $_GET['action'] != 'logout')) {
	require_once 'views/layout/footer.php';
}

ob_end_flush();


