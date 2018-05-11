(function(){
    document.querySelectorAll(".letra:not(.correcta):not(.incorrecta)")
    .forEach(function(el){
        el.addEventListener("click", function(ev){
            let form = $("#letraForm");
            form.firstElementChild.value = ev.target.innerHTML;
            form.submit();
        });
    });

    $("#nuevaPista").addEventListener("click", comodin);

    $("#restart").addEventListener("click", function(){
        window.location.replace("./restart.php");
    })
})();

function $(query){
    let resultados = document.querySelectorAll(query);
    return resultados.length > 1 ? resultados : resultados[0];
}

function comodin(){
    let opts = $(".letra:not(.correcta):not(.incorrecta)");
    if(opts == undefined) return;
    let sel = opts[Math.floor(Math.random()*opts.length )];
    let form = $("#letraForm");
    form.firstElementChild.name = "comodin";
    form.firstElementChild.value = "a"; 
    form.submit();
}

function draw(nivel){
    var ctx = $("#canvas").getContext('2d');
    if(nivel == 0) return;

    //BASE
    ctx.beginPath();
    ctx.arc(200, 300, 25, Math.PI, 0);
    ctx.stroke();

    if(nivel == 1) return;
    //PALO VERTICAL
    ctx.beginPath();
    ctx.moveTo(200, 50);
    ctx.lineTo(200, 275);
    ctx.stroke();

    if(nivel == 2) return;
    //PALO HORIZONTAL
    ctx.beginPath();
    ctx.moveTo(200, 50);
    ctx.lineTo(300, 50);
    ctx.stroke();

    if(nivel == 3) return;
    //CUERDA
    ctx.beginPath();
    ctx.moveTo(300, 50);
    ctx.lineTo(300, 75);
    ctx.stroke();

    if(nivel == 4) return;
    //CABEZA
    ctx.beginPath();
    ctx.arc(300, 95, 20, 0, 2 * Math.PI);
    ctx.stroke();

    if(nivel == 5) return;
    //TORZO
    ctx.beginPath();
    ctx.moveTo(300, 115);
    ctx.lineTo(300, 200);
    ctx.stroke();

    if(nivel == 6) return;
    //PIERNAS
    ctx.beginPath();
    ctx.moveTo(300, 200);
    ctx.lineTo(325, 245);
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(300, 200);
    ctx.lineTo(275, 245);
    ctx.stroke();

    if(nivel == 7) return;
    //BRAZOS
    ctx.beginPath();
    ctx.moveTo(300, 140);
    ctx.lineTo(330, 155);
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(300, 140);
    ctx.lineTo(270, 155);
    ctx.stroke();

    if(nivel == 8) return;
    //OJOS
    ctx.beginPath();
    ctx.moveTo(290, 85);
    ctx.lineTo(297, 92);
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(297, 85);
    ctx.lineTo(290, 92);
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(303, 85);
    ctx.lineTo(310, 92);
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(310, 85);
    ctx.lineTo(303, 92);
    ctx.stroke();
    
}