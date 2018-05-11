<?php
    session_start();
    unset($_SESSION["datos"]);
    $_SESSION["status"] = "jugando";
    header("Location: ./");

?>