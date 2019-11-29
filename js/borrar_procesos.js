$(document).ready(function () {
    $(".borrar_registro").on("click", function (e) {
        e.preventDefault();
        borrar_proceso(e);
    });

    async function borrar_proceso(elementClicked) {
        try {
            const id_proceso = elementClicked.target.dataset.id;
            var url = "";
            const tipoProceso = elementClicked.target.attributes.tipo.value;

            if (tipoProceso == "dependencia") {
                url = "modelos/modelo-proceso-dependencia.php";
            } else if (tipoProceso == "area") {
                url = "modelos/modelo-proceso.php";
            } else {
                url = "modelos/modelo-proceso-subarea.php";
            }
            
            var data = new FormData();
            data.append("id_proceso",id_proceso);
            data.append("registro","eliminar");

            const response = await fetch(url, {
                method: "POST",
                body: data
            });

            const responseProceded = await response.json();
            mostrarRespuesta(responseProceded);
        } catch (error) {
            alert(error);
        }
    }

    function mostrarRespuesta(resultado){
        if ( resultado.estado != "ok" ){
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'No se ha podido guardar el registro, vuelva a intentarlo'
            })
        } else {
            Swal.fire({
                type: 'success',
                title: 'éxito',
                text: 'Se he eliminado el proceso'
            });
            setTimeout(() => {location.reload()},2000);
        }
    }
});


