$(document).ready(function(){
    $('.sidebar-menu').tree();
    
    get_proceso();
    
    function get_proceso()
    {
        $.ajax({
            url: "servicios/ws_agregar_actores.php?numero_servicio=1",
            type: "GET",
            data: {id_proceso:$("#id_proceso").val()},
            dataType:"JSON",
            success: function(respuesta)
            {
                get_actores(respuesta);
            }
        });
    }

    function get_actores(data_proceso)
    {
        $.ajax({
            url: "servicios/ws_obtener_actores.php?numero_servicio=1",
            type: "GET",
            data: {},
            dataType:"JSON",
            success: function(respuesta)
            {
                set_actores(data_proceso, respuesta);
            }
        });
    }

    function set_actores(data_proceso, data_actor)
    {
        for(var contador = 0; contador < data_proceso.numero_actores; contador++)
        {
            var form_group = document.createElement("div");
            form_group.setAttribute("class","form-group");

            //Crear el elemento select
            var select_field = document.createElement("select");
            select_field.setAttribute("class","form-control actor-select");

            //Crear el option
            for(var contador_actor = 0; contador_actor < data_actor.length; contador_actor++)
            {
                var option = document.createElement("option");
                option.value = data_actor[contador_actor].id_actor;
                option.text = data_actor[contador_actor].nombre;
                select_field.append(option);
            }
            
            var label = document.createElement("label");
            label.setAttribute("class","form-group");
            label.setAttribute("for",contador);
            label.innerText = "Elegir el actor "+contador;

            form_group.append(label);
            form_group.append(select_field);
            var form = document.getElementById("div_actores");
            form.append(form_group);

        }
    }

}); //FIN DE DOCUMENT READY