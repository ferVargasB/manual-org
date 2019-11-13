$(document).ready(function () {
    $('.sidebar-menu').tree();
    get_actores();

    //Eventos para agregar y remover actores
    $("#guardar-registro").on("submit", function (e) {
        e.preventDefault();
        var datos = new FormData(document.getElementById("guardar-registro"));
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
                    $("#guardar-registro")[0].reset();
                    set_data_proceso(resultado);
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

    $(".borrar_registro").on("click", function (e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        Swal.fire({
            title: '¿Estás Seguro de eliminar este proceso?',
            text: "Los actores involucrados en el proceso van a removerse",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: "post",
                    data: { id_proceso: id },
                    url: "servicios/ws_eliminar_proceso_actores_procesos.php?no_service=1",
                    success: function (data) {
                        borrar_proceso(id);
                    }
                });
            }
        })
    });
});

var lista_actores;

//Funcion para obtener todas las areas
function get_actores() {
    $.ajax({
        url: "servicios/ws_obtener_actores.php?numero_servicio=1",
        type: "POST",
        dataType: "JSON",
        success: function (data) {
            lista_actores = data;
        }
    });
}

function set_data_proceso(data) {
    $("#seccion_actores").removeClass("hidden");
    $("#nombre_proceso").val(data.nombre);
    $("#id_proceso").val(data.id_proceso);
    $("#nombre_area").val(data.area);
    $("#link_diagrama").attr("href", "admin_area/" + data.ruta_diagrama);
    $("#link_ficha").attr("href", "admin_area/" + data.ruta_ficha);
    $("#numero_actores_lectura").val(data.numero_actores);
    crear_listado_actores(data.numero_actores);
}

function crear_listado_actores(no_actores) {
    var div_actores = document.getElementById("div_actores");
    for (var indice = 0; indice < no_actores; indice++) {
        var row_actor = get_row_actor();
        var select_item = create_select_element(indice)
        var col_addActor = get_col_add_actor(indice);
        //var col_rmActor = get_col_remove_actor(indice);
        row_actor.appendChild(select_item);
        row_actor.appendChild(col_addActor);
        //row_actor.appendChild(col_rmActor);
        div_actores.appendChild(row_actor);
    }
}

function get_row_actor() {
    var row = document.createElement("div");
    row.setAttribute("class", "row");

    return row;
}

function get_col_add_actor(indice) {
    var btn_add_actor = document.createElement("input");
    btn_add_actor.setAttribute("type", "button");
    btn_add_actor.setAttribute("class", "btn btn-info addActor");
    btn_add_actor.setAttribute("value", "Añadir Actor");
    btn_add_actor.setAttribute("no-actor", indice);
    btn_add_actor.addEventListener("click", add_actor);

    var col = document.createElement("div");
    col.setAttribute("class", "col-md-4");
    col.append(btn_add_actor);
    return col;
}

function create_select_element(indice) {
    var col = document.createElement("div");
    col.setAttribute("class", "col-md-8");
    var select_element = document.createElement("select");
    select_element.setAttribute("class", "form-control");
    select_element.setAttribute("id", "actor" + indice);
    select_element.setAttribute("name", "actor" + indice);

    for (var indice = 0; indice < lista_actores.length; indice++) {
        var option_element = document.createElement("option");
        option_element.value = lista_actores[indice].id_actor;
        option_element.text = lista_actores[indice].nombre;
        select_element.append(option_element);
    }
    col.append(select_element);
    return col;
}

function add_actor() {
    if (this.hasAttribute("borrar")) {
        borrar_actor(this);
    } else {
        var current_actor = $("#actor" + this.getAttribute("no-actor"));
        var current_button = this;

        $.ajax({
            url: "servicios/ws_agregar_actores_procesos_dependencias.php?no_service=2",
            type: "POST",
            data: { id_proceso: $("#id_proceso").val(), id_actor: $(current_actor).val() },
            dataType: "JSON",
            success: function (data) {
                if (data.respuesta == "exito") {
                    Swal.fire(
                        'Correcto',
                        'El actor se ha agregado al proceso',
                        'success'
                    )
                    current_button.removeAttribute("class", "btn-info");
                    current_button.setAttribute("class", "btn btn-warning");
                    current_button.setAttribute("borrar", true);
                    current_button.value = "Remover Actor";
                    $(current_actor).prop("disabled", true);
                }
                else {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'No se ha podido agregar el actor al proceso'
                    })
                }
            }
        });
    }
}

function borrar_actor(boton) {
    var current_actor = $("#actor" + boton.getAttribute("no-actor"));
    var current_button = boton;

    $.ajax({
        url: "servicios/ws_eliminar_actores_procesos_dependencias.php?no_service=2",
        type: "POST",
        data: { id_proceso: $("#id_proceso").val(), id_actor: $(current_actor).val() },
        dataType: "JSON",
        success: function (data) {
            if (data.respuesta == "exito") {
                Swal.fire(
                    'Correcto',
                    'El actor quitado del proceso',
                    'success'
                )
                current_button.removeAttribute("class", "btn-warning");
                current_button.removeAttribute("borrar");
                current_button.setAttribute("class", "btn btn-info");
                current_button.value = "Añadir Actor";
                $(current_actor).prop("disabled", false);
            }
            else {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: 'No se ha podido agregar el actor al proceso'
                })
            }
        }
    });
}


function borrar_proceso(id_proceso) {
    $.ajax({
        url: "servicios/ws_eliminar_proceso.php?no_service=1",
        type: "POST",
        data: { id_proceso: id_proceso },
        success: function (data) {
            //var data = JSON.parse(data);
            //var data = jQuery.parseJSON(JSON.stringify(data));
            if (data.respuesta == "exito") {
                jQuery('[data-id="' + id_proceso + '"]').parents("tr").remove();
                Swal.fire(
                    'Eliminado!',
                    'EL registro se ha eliminado de foma correcta.',
                    'success'
                );
                //location.reload();
            } else {
                Swal.fire(
                    'Error',
                    'El registro no se ha podido eliminar.',
                    'error'
                )
            };
        }
    });
}
