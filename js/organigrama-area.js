$(document).ready(function(){
    $('.sidebar-menu').tree();
    //Llamada ajax para obtener los datos de la dependencia
    /*$.ajax({
        url : 'servicios/ws_organigrama-area.php?numero_servicio=2',
        type : 'GET',
        data : {id: $("#id_area").val()},
        dataType:'json',
        success : function(data) {
          var nombre_area = "Organigrama del área "+data[0].nombre_area;
          $("#nombre_area").text(nombre_area);
          $("#perfil_puesto").attr("href","admin_area/"+data[0].perfil_area);
          $("#atribuciones").attr("href","admin_area/"+data[0].atribucion_area);
          //Funcion para crear el organigrama y crearle sus eventos
          $(function() {
            var datasource = crear_organigrama(data);
            var oc = $('#chart-container').orgchart({
              'data' : datasource,
              'nodeId':'id',
              'pan': true,
              'zoom': true
            });
            oc.$chartContainer.on('touchmove', function(event) {
              event.preventDefault();
            });
          });
        }, //Fin de la funcion para crear el organigrama
        error : function(request,error)
        {
            alert("Request: "+JSON.stringify(request));
        } //Fin de la funcion en caso de error de la llamada ajax
    }); 
    //Fin de la llamada ajax

    //crear los nodos con los id para poder hacerles click
    function crear_organigrama(data)
    {
      //Estuctura principal con el nodo raíz
      var datasource = {
        'name': data[0].nombre_area, 'id': data[0].id_dependencia,'children':nodo
      }
      var nodo = [];
      for (let index = 0; index < data.length; index++) 
      {
        const element = data[index];
        var area = {name:element.nombre,id:element.id_area};
        nodo.push(area);

      }
      datasource.children = nodo;
      return datasource;
    } */
}); //Fin de document ready