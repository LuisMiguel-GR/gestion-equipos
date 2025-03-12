document.addEventListener("DOMContentLoaded", function () {

    let formJugador = document.getElementById("formJugador");

    if (formJugador) {
        formJugador.addEventListener("submit", function (event) {

            let nombre = document.getElementById("nombre").value.trim();
            let numero = document.getElementById("numero").value.trim();
            let mensaje = "";

            if (nombre === "") {
                mensaje += "El nombre es obligatorio\n";
            }
            if (numero === ""){ 
                mensaje += "El numero es obligatorio\n";
            }

            if (mensaje !== "") {
                event.preventDefault();
                alert(mensaje);
            }
        });
    }

    setTimeout(function() {
        let mensajes = document.getElementsByClassName("mensajes");
        for (let i = 0; i < mensajes.length; i++) {
            mensajes[i].style.display = "none";
        }
    }, 5000);

    let botonesBorrar = document.getElementsByClassName("botonBorrarJugador");

    for (let i = 0; i < botonesBorrar.length; i++) {
        botonesBorrar[i].addEventListener("click", function (event) {
            event.preventDefault();

            let confirmacion = confirm("estas seguro?");
            if (confirmacion) {
                window.location.href = this.href;
            }
        });
    }
    
});
