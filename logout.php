<?php
    setcookie("usuario.nombre", null, -1, "/");
    setcookie("usuario.nomusuario", null, -1, "/");

    setcookie("ganadas", null, -1);
    setcookie("perdidas", null, -1);
    setcookie("pistas", null, -1);
    session_start();
    unset($_SESSION["datos"]);

    echo "<script>setTimeout(()=>window.location.replace('./'), 200)</script>";
?>