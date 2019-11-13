$(document).ready(function () {
    $('.sidebar-menu').tree();
    main();

    $("#actualizar-registro").on("submit", function (e) {
        e.preventDefault();
        var datos = new FormData(document.getElementById("actualizar-registro"));
        datos.append("id_proceso", $("#id_proceso").val());
        datos.append("no_actores_actual", $("#no_actores_actual").val());
        $.ajax({
            type: $(this).attr("method"),
            data: datos,
            url: $(this).attr("action"),
            dataType: "json",
            processData: false,
            contentType: false,
            async: false,
            cache: false,
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.respuesta == "exito") {
                    Swal.fire(
                        'Correcto',
                        'El registro se guardó correctamente',
                        'success'
                    )
                    $("#actualizar-registro")[0].reset();
                    setTimeout(() => {location.reload()},2000);
                }
                else {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'No se ha podido guardar el registro, pruebe otro nombre'
                    })
                }
            }
        });
    });
});

async function main() {
    try {
        const response_actors = await fetch("servicios/ws_obtener_actores.php?numero_servicio=1", {
            method: "GET"
        });
        const all_actors = await response_actors.json();
        const form = new FormData(document.getElementById("actualizar-registro"));
        const res_actor_process = await fetch("servicios/ws_obtener_actores_procesos.php?numero_servicio=1", {
            method: "POST",
            body: form
        });
        const actors_per_process = await res_actor_process.json();
        set_actors(actors_per_process, all_actors);
    } catch (error) {
        alert(error);
    }
}

function set_actors(actors_per_process, all_actors) {
    //Este for renderiza los actores que estan en un proceso
    if (actors_per_process.length === 0) {

        const no_actores_proceso = parseInt(document.getElementById("numero_actores").value);
        for (let index = 0; index < no_actores_proceso; index++) {

            let row = document.createElement("div");
            row.setAttribute("class", "row");
            row.style.marginBottom = "10px";

            let divSelect = document.createElement("div");
            divSelect.setAttribute("class", "col-md-8");

            //Div para el boton actor
            let divButton = document.createElement("div");
            divButton.setAttribute("class", "col-md-4");

            let selectElement = document.createElement("select");
            selectElement.setAttribute("class", "form-control");
            selectElement.setAttribute("id", "actor" + index);
            //selectElement.setAttribute("disabled", "");

            //Botón actor
            let buttonActor = document.createElement("input");
            buttonActor.setAttribute("type", "button");
            buttonActor.setAttribute("id", index);
            buttonActor.setAttribute("borrar", "false");
            buttonActor.value = "Añadir Actor";
            buttonActor.style.width = "100%";
            buttonActor.setAttribute("class", "btn btn-actor btn-primary");

            all_actors.forEach((actor_s) => {
                let optionElement = document.createElement("option");
                optionElement.value = actor_s.id_actor;
                optionElement.text = actor_s.nombre;
                selectElement.append(optionElement);
            });

            divButton.append(buttonActor);
            divSelect.append(selectElement);

            row.append(divSelect);
            row.append(divButton);

            document.getElementById("div_actores").append(row);
        }

    } else {
        let actor_number = 0;
        actors_per_process.forEach(function (actor) {
            let row = document.createElement("div");
            row.setAttribute("class", "row");
            row.style.marginBottom = "10px";

            let divSelect = document.createElement("div");
            divSelect.setAttribute("class", "col-md-8");

            //Div para el boton actor
            let divButton = document.createElement("div");
            divButton.setAttribute("class", "col-md-4");

            let selectElement = document.createElement("select");
            selectElement.setAttribute("class", "form-control");
            selectElement.setAttribute("id", "actor" + actor_number);
            selectElement.setAttribute("disabled", "");

            //Botón actor
            let buttonActor = document.createElement("input");
            buttonActor.setAttribute("type", "button");
            buttonActor.setAttribute("id", actor_number);
            buttonActor.setAttribute("borrar", "true");
            buttonActor.value = "Remover Actor";
            buttonActor.style.width = "100%";
            buttonActor.setAttribute("class", "btn btn-actor btn-warning");

            all_actors.forEach((actor_s) => {
                let optionElement = document.createElement("option");
                if (actor_s.id_actor === actor.id_actor) {
                    optionElement.setAttribute("selected", "");
                }
                optionElement.value = actor_s.id_actor;
                optionElement.text = actor_s.nombre;
                selectElement.append(optionElement);
            });

            divButton.append(buttonActor);
            divSelect.append(selectElement);

            row.append(divSelect);
            row.append(divButton);

            document.getElementById("div_actores").append(row);
            actor_number++;
        });

        total_actors = parseInt(document.getElementById("numero_actores").value) - actors_per_process.length;
        for (let index = 0; index < total_actors; index++) {
            let row = document.createElement("div");
            row.setAttribute("class", "row");
            row.style.marginBottom = "10px";

            //Div para el boton actor
            let divButton = document.createElement("div");
            divButton.setAttribute("class", "col-md-4");

            let divSelect = document.createElement("div");
            divSelect.setAttribute("class", "col-md-8");

            let selectElement = document.createElement("select");
            selectElement.setAttribute("class", "form-control");
            selectElement.setAttribute("id", "actor" + actor_number);

            //Botón actor
            let buttonActor = document.createElement("input");
            buttonActor.setAttribute("type", "button");
            buttonActor.setAttribute("id", actor_number);
            buttonActor.setAttribute("borrar", "false");
            buttonActor.value = "Añadir Actor";
            buttonActor.setAttribute("class", "btn btn-actor btn-primary");
            buttonActor.style.width = "100%";

            all_actors.forEach((actor_s) => {
                let optionElement = document.createElement("option");
                optionElement.value = actor_s.id_actor;
                optionElement.text = actor_s.nombre;
                selectElement.append(optionElement);
            });

            divButton.append(buttonActor);
            divSelect.append(selectElement);

            row.append(divSelect);
            row.append(divButton);

            document.getElementById("div_actores").append(row);
            actor_number++;
        }
    }

    let btnElements = document.getElementsByClassName("btn-actor");
    for (const item of btnElements) {
        item.addEventListener("click", (e) => {
            const actor = document.getElementById("actor" + e.target.id);
            if (e.target.getAttribute("borrar") == "true") {
                borrarActor(actor, document.getElementById("id_proceso"), e.target);
            } else {
                addActor(actor, document.getElementById("id_proceso"), e.target);
            }
        });
    }
}

async function addActor(actor, proceso, botonAdd) {
    try {
        let data = new FormData();
        data.append("id_proceso", proceso.value);
        data.append("id_actor", actor.value)
        const response = await fetch("servicios/ws_agregar_actores_procesos.php?no_service=1", {
            method: "POST",
            body: data
        });
        const resultado = await response.json();
        if (resultado.respuesta == "exito") {
            Swal.fire(
                'éxito',
                'Se añadió el actor al proceso.',
                'success'
            )
            botonAdd.setAttribute("borrar", "true");
            botonAdd.setAttribute("class", "btn btn-actor btn-warning");
            actor.disabled = true;;
            botonAdd.value = "Remover Actor";

        } else {
            throw "No se pudo agregar";
        }
    } catch (error) {
        alert(error);
    }
}

async function borrarActor(actor, proceso, botonBorrar) {
    try {
        let data = new FormData();
        data.append("id_proceso", proceso.value);
        data.append("id_actor", actor.value)
        const response = await fetch("servicios/ws_eliminar_actores_procesos.php?no_service=1", {
            method: "POST",
            body: data
        });
        const resultado = await response.json();
        if (resultado.respuesta == "exito") {
            Swal.fire(
                'éxito',
                'Se removió el actor del proceso.',
                'success'
            )
            actor.disabled = false;
            botonBorrar.setAttribute("borrar", "false");
            botonBorrar.setAttribute("class", "btn btn-actor btn-primary");
            botonBorrar.value = "Añadir Actor";
        } else {
            throw "No se pudo agregar";
        }
    } catch (error) {
        alert(error);
    }
}

