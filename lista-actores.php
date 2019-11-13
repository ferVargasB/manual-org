<!DOCTYPE html>
<html>
	<?php
    include_once 'funciones/sesiones.php';
    include_once 'funciones/funciones.php';
    include_once 'templates/header.php';
    ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php
		include_once 'templates/barra.php';
		include_once 'templates/asidebar.php';
		?>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					Listado de Actores
					<small></small>
				</h1>
				<!-- <h4 class="breadcrumb">Ruta</h4> -->
			</section>
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">Sección para manejar las todos los actores del sistema</h3>
							</div>
							<div class="box-body">
								<div class="table-responsive">
									<table id="registros" class="table table-bordered table-striped">
										<thead>
											<tr>
												<td>Nombre</td>
												<td>¿Es un Director de Área?</td>
												<td>Atribución</td>
												<td>Aciones</td>
											</tr>
										</thead>
										<tbody>
										<!-- Codigo php-->
										<?php
										try {
											$stmt = $objetoPDO->prepare("SELECT id_actor,nombre,es_director,ruta_atribucion FROM actores");
											$stmt->execute();
											$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
											foreach($resultado as $row)
											{ ?>
												<tr>
													<td><?php echo $row["nombre"];?></td>
													<td>
														<?php
															if ($row["es_director"] == 1) {
																echo "Si";
															} else {
																echo "No";
															}
														?>
													</td>
														<?php
															if ($row["es_director"] == 1) { ?>
																<td><a href="<?php echo 'admin_area/'.$row["ruta_atribucion"];?>" target="_blank">Ver Atribución</a></td>
															<?php } else { ?>
																<td>Sin Atribución</td>
															<?php }
														?>
													<td>
														<a href="editar-actor.php?id=<?php echo $row['id_actor']?>" class="badge badge-success">Editar Actor</a>
														<a href="" class="badge badge-success borrar_registro" data-id="<?php echo $row['id_actor']?>">Borrar Actor</a>
													</td>	
												</tr>
											<?php }
										} catch (EXception $e) {
											echo $e->getMessage();
										}
										?>
										<!-- Fin de codigo php-->
										</tbody>
										<tfoot>
													<td>Nombre</td>
													<td>¿Es un Director de Área?</td>
													<td>Atribución</td>
													<td>Acciones</td>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php
		include_once 'templates/footer.php';
		?>
	</div>
	<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="js/jquery.slimscroll.min.js"></script>
<!-- DataTables -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- Script Ajax Propie -->
<script src="js/actor-ajax.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })

</script>
<script>
  $(function () {
    $('#registros').DataTable(
      {
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'language' : {
        paginate : {
          next : 'Siguiente',
          previous : 'Anterior',
          last : 'Ultimo',
          first : 'Primero'
        },
        info : 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
        emptyTable: 'No hay registros',
        infoEmpty: '0 registros',
        search: 'Buscar',
        sInfoFiltered:   '(filtrado de un total de _MAX_ registros)',
        sLengthMenu:     "Mostrar _MENU_ registros"

      }
    })
  })
</script>
</body>
</html>