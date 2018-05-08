<?php
    session_start();
    $datos = [];
    if($_SESSION == null){
        $_SESSION["datos"] = ["usadas"=>["correctas"=>[], "incorrectas"=>[]]];
        $archivo = fopen("./diccionario.txt", "r");
        $palabras = [];
        for($i = 0; $i < 50; $i++)
            array_push($palabras, fgets($archivo));
        $pal = $palabras[array_rand($palabras)];
        $_SESSION["datos"]["palabra"] = ["letra"=>[], "encontrada"=>[]];
        foreach (str_split($pal) as $key => $value) {
            array_push($_SESSION["datos"]["palabra"]["letra"], $value);
            array_push($_SESSION["datos"]["palabra"]["encontrada"], 0);
        }
        array_pop($_SESSION["datos"]["palabra"]["letra"]);
        array_pop($_SESSION["datos"]["palabra"]["encontrada"]);
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
</head>
<body>
    <div class="letras">
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

    <form action="./validar.php" method="POST" id="letraForm">
            <input type="hidden" name="letra">
    </form>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/main.js"></script>
</body>
</html>