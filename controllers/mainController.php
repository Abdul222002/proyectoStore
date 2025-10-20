<?php

//cargar modelo
require_once('models/User.php');
require_once('models/Comment.php');
require_once('models/Theme.php');
require_once('models/LoginRepository.php');
require_once('models/ThemeRepository.php');
require_once('models/CommentRepository.php');
require_once('helpers/FileHelper.php');


//Inciamos la session y la conexion con la base de datos
session_start();
$db = Connection::connect();

//Cargar controlador
if(isset($_GET['url'])){
    // Aquí puedes manejar diferentes rutas basadas en el valor de $_GET['url']
    // Por ejemplo:
    // if($_GET['url'] == 'someRoute'){
    //     // Cargar un controlador o vista específica
    // }
    require_once('controllers/' . $_GET['url'] . 'Controller.php');
}else{
if(isset($_SESSION['user']) && $_SESSION['user']){
    require_once('controllers/themeController.php');
}else{
    require_once('controllers/loginController.php');
}
}
?>