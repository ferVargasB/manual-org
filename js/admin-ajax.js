$(document).ready(function(){
    $("#guardar-registro").on("submit", function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr("method"),
            data: datos,
            url: $(this).attr("action"),
            dataType: "json",
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
            text: "Debes verificar que todos los datos sean correctos",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, aceptar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.value) {
              
              $.ajax({
                    type:"post",
                    data:{id:id,registro:"eliminar"},
                    url:"modelos/modelo-admin.php",
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

    $("#login-admin").on("submit", function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr("method"),
            data: datos,
            url: $(this).attr("action"),
            dataType: "json",
            success: function(data)
            {
                var resultado = data;
                if (resultado.respuesta == "exito")
                {
                    Swal.fire(
                        'Correcto',
                        'Bienvenido(a) '+resultado.usuario+' !! ',
                        'success'
                      )
                    setTimeout(function() {
                        window.location.href = "presentacion.php";
                    },2000);
                }
                else
                {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'Usuario y Passwords incorrectos'
                      })
                }   
            }
        });
    });
});