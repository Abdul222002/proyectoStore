<?php

//Cargamos el modelo
if (!isset($_SESSION['user']) && isset($_GET['login'] ) && $_GET['login'] == 'true') {
    require_once('views/login.phtml');
    exit();
}

require_once('views/home.phtml');
?>