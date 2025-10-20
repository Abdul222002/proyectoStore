<?php

if(isset($_GET['logout']) && $_GET['logout']==1){
    // Cerrar session
    $_SESSION['user']=false;
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
        header('Location: index.php');
    }
}

// Registrar usuario
if(isset($_POST['Registrarse']) 
   && !empty($_POST['newUsername']) 
   && !empty($_POST['newPassword']) 
   && !empty($_POST['confirmPassword']) 
   && !empty($_POST['newEmail'])) {

    // Crear usuario en la base de datos
    $result = LoginRepository::createUser(
        $_POST['newUsername'],
        $_POST['newPassword'],
        $_POST['confirmPassword'],
        $_POST['newEmail']
    );

    // Revisar resultado
    if($result){
        $_SESSION['message'] = 'Usuario registrado exitosamente. Ahora puedes iniciar sesión.';
        $_SESSION['message_type'] = 'success';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['message'] = 'Error al registrar usuario. Verifica que las contraseñas coincidan o que el usuario no exista ya.';
        $_SESSION['message_type'] = 'error';
        require_once('views/register.phtml');
        exit();
    }
}



// Mostramos el formulario de registro cuando en el login se pulsa el boton registrar
if(isset($_POST['Registrar'])){
    require_once('views/register.phtml');
    exit();
}




require_once('views/login.phtml');
