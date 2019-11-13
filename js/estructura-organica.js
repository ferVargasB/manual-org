$(document).ready(function(){
    $('.sidebar-menu').tree();
    //Crear las dependencias
    get_data();
});

function get_data()
{
    $.ajax({
        url:"servicios/ws_obtener_dependencias_areas_subareas.php?numero_servicio=1",
        type:"GET",
        dataType:"JSON",
        success: function(respuesta)
        {
            set_data(respuesta);
        }
    });
}

function set_data(data)
{
    var id_dependencia_actual;
    for (var indice = 0; indice < data.length; indice++)
    {
        if (data[indice].id_dependencia == id_dependencia_actual) {
            var li_area_element = document.createElement("li");
            var div_area_element = document.createElement("div");

            var href_area_element = document.createElement("a");
            href_area_element.innerText = data[indice].area_nombre;
            href_area_element.setAttribute("href","organigrama-area.php?ida="+data[indice].id_area+"&idp="+data[indice].dependencia_perteneciente);

            div_area_element.append(href_area_element);
            li_area_element.append(div_area_element);
            var li_dependencia_element = document.getElementById("areas_dependencia"+data[indice].id_dependencia);
            li_dependencia_element.append(li_area_element);
        } else {
            var li_element = document.createElement("li");
            li_element.id = "dependencia"+data[indice].id_dependencia;

            var div_element = document.createElement("div");
            var href_element = document.createElement("a");
            href_element.innerText = data[indice].nombre;
            href_element.setAttribute("href","organigrama-dependencia.php?id="+data[indice].id_dependencia);

            var ui_area_element = document.createElement("ul");
            ui_area_element.id = "areas_dependencia"+data[indice].id_dependencia;
            var li_area_element = document.createElement("li");
            var div_area_element = document.createElement("div");

            var href_area_element = document.createElement("a");
            href_area_element.innerText = data[indice].area_nombre;
            href_area_element.setAttribute("href","organigrama-area.php?ida="+data[indice].id_area+"&idp="+data[indice].dependencia_perteneciente);

            div_area_element.append(href_area_element);
            li_area_element.append(div_area_element);
            ui_area_element.append(li_area_element);

            div_element.append(href_element);
            li_element.append(div_element);
            li_element.append(ui_area_element);

            var nodo_padre = document.getElementById("ul_padre");
            nodo_padre.append(li_element);
            id_dependencia_actual = data[indice].id_dependencia;
        }
    }

    $( function() {
        $( "#menu" ).menu({
          select: function(event, ui) {
                    //var item = $('#menu').find(":selected");
                    //var div_presidente = $(ui.item).find("#1").id;
                }
        });
    });
}