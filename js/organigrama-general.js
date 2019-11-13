$(document).ready(function(){
    $('.sidebar-menu').tree();
    //Llamada ajax para obtener los datos de la dependencia
/*     $.ajax({
        url : 'servicios/ws_obtener_dependencias.php?numero_servicio=1',
        type : 'GET',
        data : {},
        responseTime: 2000,
        dataType:'json',
        success : function(data) {
          console.log(data);
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
            //Evento para capturar el click a los nodos
            oc.$chartContainer.on('click', '.node',function(event) {
              var $this = $(this);
              var id = parseInt($this.attr("id"));
              if (id) {
                window.location.href = "organigrama-dependencia.php?id="+id;
              } else {
                console.log("No tiene id"); 
              }
              
            });
          });
        }, //Fin de la funcion para crear el organigrama
        error : function(request,error)
        {
            alert("Request: "+JSON.stringify(request));
        } //Fin de la funcion en caso de error de la llamada ajax
    });  */
    //Fin de la llamada ajax

    //crear los nodos con los id para poder hacerles click
/*     function crear_organigrama(data)
    {
      //Estuctura principal con el nodo raíz
      var root = {
        'name': 'H. Municipal','children':[]
      };
      var presidenteNodo = [];
      var datasource = {
        'name': 'Presidente Municipal','children':[]
      };
      presidenteNodo.push(datasource);
      var dependencias = [];
      for (let index = 0; index < data.length; index++) 
      {
        var nodo = {
          'name':data[index].nombre, 'id': data[index].id_dependencia
        };
        dependencias.push(nodo);
      }
      datasource.children = dependencias;
      root.children = presidenteNodo;
      return root;
    } */
}); //Fin de document ready