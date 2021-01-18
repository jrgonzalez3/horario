<!doctype html>
<html lang="en">
<?php
error_reporting(E_ALL);

    include './head.php';

// llamar al archivo conexion
include './config/conexion.php';
include './funciones.php';   //Archivo de funciones PHP

$mesInicio = date('Y-m-d');
$mesFin = date('Y-m-d');
$consulta = "SELECT * FROM horarios WHERE  date_work >= '$mesInicio' AND date_work <= '$mesFin' order by date_work DESC";
$result = mysqli_query($con, $consulta) or die(mysqli_error($con));

?>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="./index.php"><img src="assets/img/logo-dark.png" alt="" class="img-responsive logo"></a>
            </div>
            <div class="container-fluid header">
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png"
                                    class="img-circle" alt="Avatar"> <span>Samuel</span> <i
                                    class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
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
                        <div class="col-md-12">
                            <!-- RECENT PURCHASES -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Recent Time Stamps - Marcaciones Recientes</h3>
                                </div>
                                <div class="panel-body no-padding">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
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
                                                <td><?php echo $row['in_work']; ?></td>
                                                <td><?php echo $row['start_break']; ?></td>
                                                <td><?php echo $row['end_break']; ?></td>
                                                <td><?php echo $row['exit_work']; ?></td>
                                                <td><button onclick="editar_marcacion('<?php echo $row['id']; ?>')"
                                                        class="btn btn-warning"><i
                                                            class="fa fa-pencil"></i></button><button
                                                        onclick="borrar_marcacion('<?php echo $row['id']; ?>')"
														class="btn btn-danger"><i class="fa fa-close"></i></button></td>
                                            </tr>
                                            <?php
                       } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i>
                                                Last 24 hours</span></div>
                                        <div class="col-md-6 text-right"><a href="#" class="btn btn-primary">View All
                                                Time Stamps</a></div>
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

</body>

</html>