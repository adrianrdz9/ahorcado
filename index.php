<?php
    session_start();
    $datos = [];
    if(!isset($_COOKIE["usuario_nombre"]))
       header("Location: ./login.php");


    if(empty($_COOKIE["pistas"]))
        setcookie("pistas", 0, 0, "/");
    if(empty($_COOKIE["ganadas"]))
        setcookie("ganadas", 0, 0, "/");
    if(empty($_COOKIE["perdidas"]))
        setcookie("perdidas", 0, 0, "/");
    

    if(empty($_SESSION["datos"])){
        
        $_SESSION["datos"] = ["usadas"=>["correctas"=>[], "incorrectas"=>[], "todas"=>[]  ]];
        $_SESSION["status"] = "jugando";
        $archivo = fopen("./diccionario.txt", "r");
        $palabras = [];
        for($i = 0; $i < 50; $i++)
            array_push($palabras, fgets($archivo));
        $pal = $palabras[array_rand($palabras)];
        $_SESSION["datos"]["palabra"] = ["letra"=>[], "encontrada"=>[]];
        foreach (str_split($pal) as $key => $value) {
            if(ctype_alpha($value)){
                array_push($_SESSION["datos"]["palabra"]["letra"], $value);
                array_push($_SESSION["datos"]["palabra"]["encontrada"], 0);
            }
        }
    }
    $ahorcado = count($_SESSION["datos"]["usadas"]["incorrectas"]);

    if($ahorcado >= 9 && $_SESSION["status"] == "jugando"){
        $_SESSION["datos"]["palabra"]["encontrada"] = array_map(function(){return 1;}, $_SESSION["datos"]["palabra"]["encontrada"]); 
        setcookie("perdidas", $_COOKIE["perdidas"]+1);
        $_SESSION["status"] = "perdido";
    }



    foreach ($_SESSION["datos"] as $key => $value) {
        $datos[$key] = $value;
    }

    
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ahorcado</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:200,400" rel="stylesheet">

</head>
<body>
    <h1>Ahorcado - destinos turisticos en México</h1>
    <div id="canvasContainer">
        <canvas width="500" height="300" onload="alert();" id="canvas"></canvas>
    </div>
    
    <div class="letras top-space">
        <?php
            for ($i=65; $i <= 90; $i++) { 
                $c = chr($i);
                if(in_array($c, $datos["usadas"]["correctas"])){
                    echo "<div class='letra correcta'>$c</div>";
                }else if(in_array($c, $datos["usadas"]["incorrectas"])){
                    echo "<div class='letra incorrecta'>$c</div>";
                }else{
                    echo "<div class='letra'>$c</div>";
                }
            }
        ?>
    </div>


    <?php
        if(!in_array("0", $_SESSION["datos"]["palabra"]["encontrada"])){
            echo "<button id='restart'>Volver a jugar</button>";
            if($_SESSION["status"]=="jugando"){
                $_SESSION["status"] = "ganado";
                setcookie("ganadas", $_COOKIE["ganadas"]+1);
            }
        }
    ?>

    <div id="huecos">
        <?php
            foreach ($datos["palabra"]["letra"] as $key => $value) {
                if($datos["palabra"]["encontrada"][$key] == 0)
                    echo "<input disabled value=''>";
                else
                    echo "<input disabled value='$value'>";
            }
        
        ?>
    </div>
    <div class="container">
        <div class="card top-space user">
            <div id="datosJugador">
                <figure>
                    <?php
                        if(file_exists("./imagenes/".$_COOKIE["usuario_nomusuario"] . ".png")){
                            echo "<img src='./imagenes/".$_COOKIE["usuario_nomusuario"].".png'  alt=''>";
                        }else{
                            echo "<img src='./imagenes/default.png'>";
                        }
                    ?>
                    <button id="Cambiar foto"  onclick="avatar.click();">
                        <i class="material-icons">
                            camera_alt
                        </i>
                    </button>
                </figure> 
                <h2>
                    <?php echo $_COOKIE["usuario_nombre"] ?>
                </h2>
            </div>    
            <div>
                <div>
                    <h2>
                        Estadisticas
                    </h2>
                    <p>
                        <strong>Partidas ganadas: </strong>
                        <span>
                            <?php 
                                if(empty($_COOKIE["ganadas"]))
                                    echo "0";
                                else
                                    echo $_COOKIE["ganadas"] 
                            ?>
                        </span>
                    </p>
                    <p>
                        <strong>Partidas perdidas: </strong>
                        <span>
                            <?php 
                                if(empty($_COOKIE["perdidas"]))
                                    echo "0";
                                else
                                    echo $_COOKIE["perdidas"] 
                            ?>
                        </span>
                    </p>
                    <p>
                        <strong>Pistas usadas: </strong>
                        <span>
                            <?php 
                                if(empty($_COOKIE["pistas"]))
                                    echo "0";
                                else
                                    echo $_COOKIE["pistas"] 
                            ?>
                        </span>
                    </p>

                </div>
                <span>Pista</span>
                <button id="nuevaPista">
                    <i class="material-icons">
                        vpn_key
                    </i>
                </button>

                <span>Cerrar sesion</span>
                <button id="salir" onclick="window.location.replace('./logout.php')">
                    <i class="material-icons">
                        person
                    </i>
                </button>
            </div> 
        
        </div>
    </div>
    <div class="top-space"></div>
    <form action="./validar.php" method="POST" id="letraForm">
        <input type="hidden" name="letra">
    </form>
    <form action="./actualizarUsuario.php" method="POST" style="display: none;" enctype="multipart/form-data">
        <input type="file" name="avatar" id="avatar" onchange="this.form.submit()">
    </form>
    <script src="js/main.js"></script>
    <?php
        echo "<script>draw('$ahorcado');</script>";
    ?>
</html>