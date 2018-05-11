<?php
    session_start();
    if(in_array(0, $_SESSION["datos"]["palabra"]["encontrada"])){
        if(!empty($_POST["comodin"])){
            setcookie("pistas", $_COOKIE["pistas"]+1);
            $pos = array_search(0,  $_SESSION["datos"]["palabra"]["encontrada"]);
            $letra = strtoupper($_SESSION["datos"]["palabra"]["letra"][$pos]);
        }else{
            $letra = $_POST["letra"];
        }
        array_push($_SESSION["datos"]["usadas"]["todas"], $letra);


        if (in_array(strtolower($letra), $_SESSION["datos"]["palabra"]["letra"])) {
            foreach ($_SESSION["datos"]["palabra"]["letra"] as $key => $value) {
                if($value == strtolower($letra)){
                    $_SESSION["datos"]["palabra"]["encontrada"][$key] = 1;       
                    array_push($_SESSION["datos"]["usadas"]["correctas"], $letra );
                }
            }
            
        }else{
            array_push($_SESSION["datos"]["usadas"]["incorrectas"], $letra ); 
        }
    }
    header("Location: ./");

?>
