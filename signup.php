<?php
    if(!empty($_COOKIE["usuario_nombre"]))
    header("Location: ./");

    if(!empty($_POST["nombre"]) && !empty($_POST["usuario"]) && !empty($_POST["password"])){
        $usuario = hash("sha256", $_POST["usuario"]);
        $pw = hash("sha256", $_POST["password"]);

        if(file_exists("./usuarios/".$usuario)){
            echo "Nombre de usuario ocupado.";
        }else{
            $file = fopen("./usuarios/".$usuario, "w");
            fprintf($file, "%s\n", $pw);
            fprintf($file, "%s", base64_encode($_POST["nombre"]));
            fclose($file);
        }
    }



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrarse</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:200,400" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="card">
            <h1>Registrarse</h1>
            <form method="POST">
                <input type="text" name="nombre" placeholder="Nombre">
                <input type="text" name="usuario" placeholder="Nombre de usuario">
                <input type="password" name="password" placeholder="Contraseña">
                <input type="submit" value="Iniciar sesion"> 
            </form>
            <span>¿Ya te registraste?</span>
            <a href="./login.php">Iniciar sesion</a>
        </div>
    </div>
</body>
</html>