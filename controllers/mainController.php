<?php
require_once('models/User.php');
require_once('models/LoginRepository.php');

//Iniciamos la session y la conexion con la base de datos
session_start();
$db = Connection::connect();

if (isset($_GET['c'])) {
    require_once('controllers/' . $_GET['c'] . 'Controller.php');
} else {
    require_once('controllers/shopController.php');
}
?>