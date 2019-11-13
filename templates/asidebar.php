<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION["usuario"]; ?></p>
            </div>
        </div>
        <!-- search form -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menú de <?php echo $_SESSION['rol']; ?></li>
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                </ul>
            </li> -->
            <!-- INTRODUCCION -->
            <li>
                <a href="presentacion.php">
                    <i class="far fa-address-card"></i>
                    <span>Presentación</span>
                </a>
            </li>
            <!-- FIN INTRODUCCION -->
            <!-- INTRODUCCION -->
            <li>
                <a href="introduccion2.php">
                    <i class="fas fa-home"></i>
                    <span>Introducción</span>
                </a>
            </li>
            <!-- FIN INTRODUCCION -->
            <!-- MARCO JURIDICO -->
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-anchor"></i>
                    <span>Marco Jurídico</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="aspecto_legal_leyes.php"><i class="fa fa-circle-o"></i> Reglamento Orgánico</a></li>
                    <li><a href="<?php echo 'assets/LEYES_Y_REGLAMENTOS_APLICABLES.pdf';?>" target="_blank"><i class="fa fa-circle-o"></i> Ver Leyes y Reglamentos</a></li>
                </ul>
            </li>
            <!-- FIN DE MARCO JURIDICO -->
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-chart-line"></i>
                    <span>Marco Estratégico</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="mision.php"><i class="fa fa-circle-o"></i> Misión</a></li>
                    <li><a href="vision.php"><i class="fa fa-circle-o"></i> Visión</a></li>
                    <li><a href="ejes.php"><i class="fa fa-circle-o"></i> Valores</a></li>
                    <li><a href="valores.php"><i class="fa fa-circle-o"></i> Ejes Estratégicos</a></li>
                </ul>
            </li>
            <!-- MISIÓN -->
            <!-- <li>
                <a href="marco-estrategico.php">
                    <i class="fa fa-id-card"></i> 
                    <span>Marco Estrategico</span>
                </a>
            </li> -->
            <!-- FIN DE MISIÓN -->
            <!-- ESTRUCTURA ORGANICA -->
            <li>
                <a href="estructura-organica.php">
                    <i class="fas fa-sort-alpha-down"></i>
                    <span>Estructura Organica</span>
                </a>
            </li>
            <!-- FIN DE ESTRUCTURA -->
            <!-- ORGANIFRAMA GENERAL -->
            <li>
                <a href="organigrama.php">
                    <i class="fas fa-sitemap"></i>
                    <span>Organigrama General</span>
                </a>
            </li>
            <!-- FIN DE ORGANIGRAMA -->
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-sticky-note"></i>
                    <span>Dependencia</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="lista-dependencia.php"><i class="fa fa-list-ul"></i> Ver Todos</a></li>
                    <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                        <li><a href="crear-dependencia.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
                    <?php endif; ?>
                </ul>
            </li> -->
            <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-users-cog"></i>
                        <span>Administradores</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="lista-admin.php"><i class="fa fa-circle-o"></i> Ver Todos</a></li>
                        <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                            <li><a href="crear-admin.php"><i class="fa fa-circle-o"></i> Agregar</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-landmark"></i>
                        <span>Dependencias</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="lista-dependencias.php"><i class="fa fa-circle-o"></i> Ver Todos</a></li>
                        <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                            <li><a href="crear-dependencia.php"><i class="fa fa-circle-o"></i> Agregar</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-university"></i>
                        <span>Áreas</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="lista-areas.php"><i class="fa fa-circle-o"></i> Ver Todos</a></li>
                        <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                            <li><a href="crear-area.php"><i class="fa fa-circle-o"></i> Agregar</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-university"></i>
                        <span>Sub Áreas</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="lista-sub-areas.php"><i class="fa fa-circle-o"></i> Ver Todos</a></li>
                        <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                            <li><a href="crear-sub-area.php"><i class="fa fa-circle-o"></i> Agregar</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-user-friends"></i>
                        <span>Actores</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="lista-actores.php"><i class="fa fa-circle-o"></i> Ver Todos</a></li>
                        <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                            <li><a href="crear-actor.php"><i class="fa fa-circle-o"></i> Agregar</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-code"></i>
                        <span>Crear Organigramas</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="lista-areas.php"><i class="fa fa-circle-o"></i> Ver Todos</a></li>
                        <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                            <li><a href="crear-organigramas.php"><i class="fa fa-circle-o"></i> Agregar</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-tasks"></i>
                        <span>Procesos</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="lista-procesos.php"><i class="fa fa-circle-o"></i>Ver Todos</a></li>
                        <?php if ($_SESSION['rol'] == 'webmaster') : ?>
                            <li><a href="crear-proceso.php"><i class="fa fa-circle-o"></i> Agregar a una área</a></li>
                            <li><a href="crear-proceso-dependencia.php"><i class="fa fa-circle-o"></i> Agregar a una dependencia</a></li>
                            <li><a href="crear-proceso-subarea.php"><i class="fa fa-circle-o"></i> Agregar a una sub área</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <!-- <li><a href=""><i class="fa fa-book"></i> <span>Documentation</span></a></li> -->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->