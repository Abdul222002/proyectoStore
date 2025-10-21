<?php

if(isset($_GET['logout']) && $_GET['logout']==1){
    // Cerrar session
    $_SESSION['user']=false;
    $_SESSION['message'] = 'Has cerrado sesión correctamente.';
    $_SESSION['message_type'] = 'success';
    header('Location: index.php');
    exit();

}

if(!isset($_SESSION['user'])){
    $_SESSION['user']=false;
}


// Iniciar session
if(isset($_POST['Login']) && isset($_POST['username']) && isset($_POST['password'])){
    $user= LoginRepository::login($_POST['username'], md5($_POST['password']));
    if($user){
        // Guardar usuario en session
        $_SESSION['user']= $user;
        $_SESSION['message'] = 'Inicio de sesión exitoso.';
        $_SESSION['message_type'] = 'success';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['message'] = 'Usuario o contraseña incorrectos.';
        $_SESSION['message_type'] = 'error';
    }
}

if(!isset($_SESSION['user']) || $_SESSION['user'] === false){
    require_once('views/login.phtml');
}
