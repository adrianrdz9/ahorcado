<?php
    if(empty($_FILES))
        header("Location: ./");

    $dir = "./imagenes/";
    $fileRoute = $dir . $_COOKIE["usuario_nomusuario"] . "."  . pathinfo(basename($_FILES["avatar"]["name"]), PATHINFO_EXTENSION);
    $type = strtolower(pathinfo($fileRoute, PATHINFO_EXTENSION));

    if(pathinfo(basename($_FILES["avatar"]["name"]), PATHINFO_EXTENSION) == "png"){
        if(getimagesize($_FILES["avatar"]["tmp_name"])){
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $fileRoute);


            echo "Imagen de perfil actualizada.";

            echo "<script>setTimeout(()=>window.location.replace('./'), 3000)</script>";
        }
    }else{
        echo "Error, tipo de archivo no permitido. <br> Solo archivos .png";

        echo "<script>setTimeout(()=>window.location.replace('./'), 3000)</script>";
    }

    


?>