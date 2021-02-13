<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include './head.php';
include './config/conexion.php';

include './funciones.php';   //Archivo de funciones PHP
$user = $_SESSION['usuario_sesion'];
$username = get_row('users', 'username', 'id', $user);

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
  
        <br>
        <div class="col-md-12">
            <div class="panel panel-success hidden-print">
                <div class="panel-heading">
                    <h4><i class='fa fa-eye'></i> Reporte - Control de Horario </h4>
                </div>

                <div class="panel-body">
                   
                    <form class="form-horizontal" role="form" id="frm_reporte" autocomplete="off">

                        <div class="col-md-3">
                            <label for="">Fecha Inicio</label>
                            <div class="input-group date" id="">
                                <input type="date" autocomplete="off" id="fechaini" autocomplete="off"
                                    class="form-control datepicker" required name="fechaini">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="">Fecha Fin</label>
                            <div class="input-group date" id="">
                                <input type="date" autocomplete="off" id="fechafin" autocomplete="off"
                                    class="form-control datepicker" required name="fechafin">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="">Funcionario</label>
                            <select id="projectinput5" name="id_funcionario" class="form-control" required="">
                                <option value="" selected="" disabled="">Seleccione</option>
                                <option value=""><b>"TODOS"</b></option>
                                <?php
                                $consulta1 = 'SELECT * from users';
                                $result1 = mysqli_query($con, $consulta1) or die(mysqli_error($con));
                                while ($row = mysqli_fetch_array($result1)) {
                                    ?>
                                <option value="<?php echo $row['id']; ?>">
                                    <?php echo $row['name']; ?></option>
                                <?php
                                }
                                 ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for=""></label>
                            <button type="submit" id="btn_add_products" class="btn btn-block btn-lg btn-success">
                                <span class="fa fa-cog"></span> GENERAR REPORTE
                            </button>
                        </div>
                </div>
                </form>
    </div>
   
                <div id="respuesta"></div>
</body>
<?php include './footer.php'; ?>

<script src="./script.js"></script>

</html>