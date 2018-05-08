<?php
    session_start();

    $letra = $_POST["letra"];
    foreach ($_SESSION["datos"]["palabra"]["letra"] as $key => $value) {
        if(strtoupper($value) == $letra){
            $_SESSION["datos"]["palabra"]["encontrada"][$key] = 1;
            array_push($_SESSION["datos"]["usadas"]["correctas"], $_POST["letra"] );
        }else{
            array_push($_SESSION["datos"]["usadas"]["incorrectas"], $_POST["letra"] );
        }
    }
    header("Location: ./");


?>
