document.addEventListener("DOMContentLoaded", function () {

    let formEquipo = document.getElementById("formEquipo");

    if (formEquipo) {
        formEquipo.addEventListener("submit", function (event) {

            let nombre = document.getElementById("nombre").value.trim();
            let ciudad = document.getElementById("ciudad").value.trim();
            let mensaje = "";

            if (nombre === "") {
                mensaje += "El nombre es obligatorio\n";
            }
            if (ciudad === ""){ 
                mensaje += "La ciudad es obligatoria\n";
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

    let botonesBorrar = document.getElementsByClassName("botonBorrarEquipo");

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
