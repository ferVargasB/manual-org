$(document).ready(function(){
    $('.sidebar-menu').tree();
    //Llamada ajax para obtener los datos de la dependencia
/*     $.ajax({
        url : 'servicios/ws_organigrama-dependencia.php?numero_servicio=2',
        type : 'GET',
        data : {id: $("#id_area").val()},
        dataType:'json',
        success : function(data) {
          var nombre_dependencia = "Organigrama de la "+data[0].mombre_depen;
          $("#nombre_dependencia").text(nombre_dependencia);
          $("#objetivo_general").attr("href",data[0].ruta_objetivo_general);
          $("#perfil_puesto").attr("href",data[0].ruta_perfil_puesto);
          $("#atribuciones").attr("href",data[0].ruta_atribuciones);
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
              var id_area = parseInt($this.attr("id"));
              console.log(id_area);
              window.location.href = "organigrama-area.php?ida="+id_area+"&idp="+$("#id_area").val();
            });
          });
        }, //Fin de la funcion para crear el organigrama
        error : function(request,error)
        {
            alert("Request: "+JSON.stringify(request));
        } //Fin de la funcion en caso de error de la llamada ajax
    }); */ 
    //Fin de la llamada ajax

    //crear los nodos con los id para poder hacerles click
/*     function crear_organigrama(data)
    {
      //Estuctura principal con el nodo raíz
      var datasource = {
        'name': data[0].mombre_depen, 'id': data[0].id_dependencia,'children':nodo
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