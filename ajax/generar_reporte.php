<?php
// llamar al archivo conexion
include '../config/conexion.php';
include '../funciones.php';   //Archivo de funciones PHP

function sumar($hora1, $hora2)
{
    list($h2, $m2, $s2) = explode(':', $hora2);

    $total2 = (($s2 / 60) / 60) + (($m2) / 60) + $h2;

    $total_general = $hora1 + $total2;

    return $total_general;
}
if (isset($_POST['fechaini'])) {
    $fechaini = $_POST['fechaini'];
}
if (isset($_POST['fechafin'])) {
    $fechafin = $_POST['fechafin'];
}
if (isset($_POST['id_funcionario']) and ($_POST['id_funcionario'] != '')) {
    $id_user = $_POST['id_funcionario'];
    $where = 'AND id_user= '.$id_user;
    $name_user = get_row('users', 'name', 'id', $id_user);
} else {
    $where = 'AND 1+1';
}

    $consulta = "SELECT in_work, id_user, date_work, exit_work, start_break, end_break, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, in_work, exit_work)) Entrada_Salida, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, start_break, end_break)) break_in_out  FROM horarios WHERE date_work >= '$fechaini' AND date_work <= '$fechafin' $where order by date_work DESC";
    $result = mysqli_query($con, $consulta) or die(mysqli_error($con));
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        echo 'No se encontraron registros  ';
    } ?>
<div class="panel panel-warning">
    <div class="panel-heading">
        <h5><i class='fa fa-list'></i> Listado de Horas Registradas <?php echo  $name_user ? 'de '.$name_user : ' de todos'; ?> </h5>
    </div>
    <div class="panel-body">
        <div class="table table-responsive">
            <table id="tbl_reporte" class="table-condensed table-striped table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Horas Trabajadas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
    $total = 0;
    $interval = '';
    $horas_totales = 0;
    while ($row = mysqli_fetch_array($result)) {
        $date_work = $row['date_work'];
        $date_work = date('d/m/Y', strtotime($row['date_work']));

        $in_work = $row['in_work'];
        $id_usuario = $row['id_user'];
        $name_user = get_row('users', 'name', 'id', $id_usuario);

        $start_break = $row['start_break'];
        $end_break = $row['end_break'];
        $exit_work = $row['exit_work'];
        $Entrada_Salida = $row['Entrada_Salida'];
        $break_in_out = $row['break_in_out'];
        if (!$Entrada_Salida or !$break_in_out) {
            echo 'error en entrada y salida del dia '.$date_work;
        } else {
            $fechaUno = new DateTime($Entrada_Salida);
            $fechaDos = new DateTime($break_in_out);

            $dateInterval = $fechaUno->diff($fechaDos);

            $tiempo1 = date('H:i:s', strtotime($Entrada_Salida));
            $tiempo2 = date('H:i:s', strtotime($break_in_out));

            $datatime1 = new DateTime($tiempo1);
            $datetime2 = new DateTime($tiempo2);
            $interval = $datatime1->diff($datetime2);
            $intervalos = $interval->format('%H'.':'.'%i'.':'.'%s');
            $horas_totales = sumar($horas_totales, $intervalos); ?>

                    <tr>
                        <td><?php echo $name_user; ?></td>
                        <td><?php echo $date_work; ?></td>
                        <td><?php echo  $dateInterval->format('%h horas %i minutos %s segundos').PHP_EOL; ?></td>
                    </tr>

                    <?php
        }
    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><b>Total : <?php  echo round($horas_totales).' horas'; ?></b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!--container-->
    </div>