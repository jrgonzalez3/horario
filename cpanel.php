<!doctype html>
<html lang="en">
<?php
// llamar al archivo conexion
session_start();
include './head.php';
include './config/conexion.php';
include './funciones.php';   //Archivo de funciones PHP

$user = $_SESSION['usuario_sesion'];
 $username = get_row('users', 'username', 'id', $user);
$mesInicio = date('2000-m-01');
$mesFin = date('Y-m-31');
$consulta = "SELECT * FROM horarios WHERE  date_work >= '$mesInicio' AND date_work <= '$mesFin' order by date_work DESC";
// $consulta = 'SELECT * FROM horarios  order by date_work DESC';
$result = mysqli_query($con, $consulta) or die(mysqli_error($con));

?>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="./index.php"><img src="assets/img/logo2.png" alt="" class="img-responsive logo"></a>
            </div>
            <div class="container-fluid header">
                <div id="navbar-menu">
                <div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png"
                                    class="img-circle" alt="Avatar"> <span><?php echo $username; ?></span> <i
                                    class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        <?php include './sidebar.php'; ?>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="">
                            <!-- RECENT PURCHASES -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Recent Time Stamps - Marcaciones Recientes</h3>
                                </div>
                                <div class="panel-body">
                                    <div id="notification"></div>
                                   <div class="table-responsive">
                                    <table width="100%" class="table table-responsive table-hover table-striped"
                                        id="tbl_marcaciones">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Dia</th>
                                                <th>Entrada</th>
                                                <th>Break</th>
                                                <th>Fin Break</th>
                                                <th>Salida</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                       while ($row = mysqli_fetch_array($result)) {
                           $id_user = $row['id_user'];

                           $name_user = get_row('users', 'name', 'id', $id_user); ?>
                                            <tr>
                                                <!-- <td><a href="#">763648</a></td> -->
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $name_user; ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($row['date_work'])); ?></td>
                                                <td><?php echo $row['in_work']; ?></td>
                                                <td><?php echo $row['start_break']; ?></td>
                                                <td><?php echo $row['end_break']; ?></td>
                                                <td><?php echo $row['exit_work']; ?></td>
                                                <td>
                                                <a onclick="editar_marcacion('<?php echo $row['id']; ?>')" id="btn_editar_marcacion" data-toggle="modal" data-target="#modal_editar_marcacion"
                            class="btn btn-warning"><span class="fa fa-pencil"></span> </a>
                                                <button
                                                        onclick="borrar_marcacion('<?php echo $row['id']; ?>')"
                                                        class="btn btn-danger"><i class="fa fa-close"></i></button></td>
                                            </tr>
                                            <?php
                       } ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                              
                            </div>
                            <!-- END RECENT PURCHASES -->
                        </div>

                    </div>


                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
        <div class="clearfix"></div>
        <!-- FOOTER -->
        <?php include './footer.php'; ?>
        <!-- END FOOTER -->
    </div>
    <!-- END WRAPPER -->






<!-- Modal -->
<div class="modal" id="modal_editar_marcacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal"  id="frm_editar_marcacion" name="frm_editar_marcacion">
                    <div id="loader1"></div>
                    <div id="resultados_ajax_registro"></div>
                    <div class="form-group">
                        <label for="entrada" class="col-sm-3 control-label">Entrada</label>
                        <div class="col-sm-8">
                        <input type="hidden" name="id" >
                            <input type="time" step='1' class="form-control" id="entrada" name="entrada"
                                placeholder="Hora entrada"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inicio" class="col-sm-3 control-label">Inicio Break</label>
                        <div class="col-sm-8">
                            <input type="time" step='1' class="form-control" autocorrect="off" autocapitalize="off"
                                 id="inicio" name="inicio" placeholder="Inicio Break"
                                >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fin" class="col-sm-3 control-label">Fin Break</label>
                        <div class="col-sm-8">
                            <input type="time" step='1' class="form-control" id="fin" name="fin"
                                placeholder="Ingrese fin" >
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="fin" class="col-sm-3 control-label">Salida</label>
                        <div class="col-sm-8">
                            <input type="time" step='1' class="form-control" id="salida" name="salida"
                                placeholder="Salida"  >
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" id='btn_submit_frm_editar' class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
            </form>
    </div>
</div>

<script src="./script.js"></script>
</body>




</html>