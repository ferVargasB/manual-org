$(document).ready(function(){
    //Funciones varias*/

    //Guardar un registro
    $("#guardar-registro").on("submit", function(e){
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
            success: function(data)
            {
                console.log(data);
                var resultado = data;
                if (resultado.respuesta == "exito")
                {
                    Swal.fire(
                        'Correcto',
                        'El registro se guardó correctamente',
                        'success'
                      )
                      $("#guardar-registro")[0].reset();
                }
                else
                {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'No se ha podido guardar el registro, pruebe otro nombre'
                      })
                }
            }
        });
    });


    //Eliminar un registro
    $(".borrar_registro").on("click", function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        console.log(id);
        Swal.fire({
            title: '¿Estás Seguro?',
            text: "El registro no se podrá recuperar",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.value) {
              
              $.ajax({
                    type:"post",
                    data:{id:id,registro:"eliminar"},
                    url:"modelos/modelo-actor.php",
                    success:function(data)
                    {
                        var data = JSON.parse(data);
                        if (data.respuesta == "exito")
                        {
                            jQuery('[data-id="'+data.id_eliminado+'"]').parents("tr").remove();
                            Swal.fire(
                                'Eliminado!',
                                'EL registro se ha eliminado de foma correcta.',
                                'success'
                            )
                        }
                        else
                        {
                            Swal.fire(
                                'Error',
                                'EL registro no se ha podido eliminar.',
                                'error'
                            )
                        }
                    }
                });
            }
        })
    });
});

function mostrar_atribucion(e)
{
    if ($(e).val() == "0")
    {
        $(e).val(1);
        $("#div_atribucion").removeClass("hidden");
    } else
    {
        $("#atribucion").attr("required");
        $(e).val(0);
        $("#div_atribucion").addClass("hidden");
    }
    console.log($(e).val());
}
    