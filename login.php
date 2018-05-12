<?php
    if(!empty($_COOKIE["usuario_nombre"]))
    header("Location: ./");

    if(!empty($_POST["usuario"]) && !empty($_POST["password"])){
        $usuario = hash("sha256", $_POST["usuario"]);
        $pw = hash("sha256", $_POST["password"]);

        if(file_exists("./usuarios/".$usuario)){
            $file = fopen("./usuarios/".$usuario, "r");
            $pwc = fgets($file, 65);
            fgets($file);

            if($pw == $pwc){
                setcookie("usuario.nombre", base64_decode(fgets($file)), 0, "/");
                setcookie("usuario.nomusuario", $usuario, 0, "/");
                echo "<script>setTimeout(()=>window.location.replace('./'), 50)</script>";

            }else{
                echo "Usuario o contraseña incorrectos";
            }
        }else{
            echo "Usuario o contraseña incorrectos";
        }
    }



?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesion</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:200,400" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="card">
            <h1>Iniciar sesion</h1>
            <form method="POST">
                <input type="text" name="usuario" placeholder="Nombre de usuario">
                <input type="password" name="password" placeholder="Contraseña">
                <input type="submit" value="Iniciar sesion"> 
            </form>
            <span>¿Aun no te has registrado?</span>
            <a href="./signup.php">Registrarse</a>
        </div>
    </div>
</body>
</html>