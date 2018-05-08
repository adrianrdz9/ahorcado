(function(){
document.querySelectorAll(".letra:not(.correcta):not(.incorrecta)")
    .forEach(function(el){
        el.addEventListener("click", function(ev){
            let form = document.querySelector("#letraForm");
            form.firstElementChild.value = ev.target.innerHTML;
            form.submit();
        })
})

})();