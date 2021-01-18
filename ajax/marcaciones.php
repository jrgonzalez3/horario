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
if (isset($_POST['clave'])) {
    $clave = sha1($_POST['clave']);
}
 $is_user = get_row('users', 'id', 'password', $clave);
 $name_user = get_row('users', 'name', 'id', $is_user);
if (!$is_user) {
    echo '<script>
    alert ("Este usuario no existe! ");
    limpiar_form();
    </script>';
} else {
    // marcar entrada insert
    $mesInicio = date('Y-m-01');
    $mesFin = date('Y-m-31');

    echo    $consulta = "SELECT in_work, date_work, exit_work, start_break, end_break, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, in_work, exit_work)) Entrada_Salida, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, start_break, end_break)) break_in_out   FROM horarios WHERE id_user= '$is_user' AND date_work >= '$mesInicio' AND date_work <= '$mesFin' order by date_work DESC";

    $result = mysqli_query($con, $consulta) or die(mysqli_error($con));
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        echo 'No se encontraron registros de Este usuario ';
    } ?>
<div class="panel panel-warning">
    <div class="panel-heading">
        <h5><i class='fa fa-list'></i> Listado de Horas Registradas de <?php echo $name_user; ?> </h5>
    </div>
    <div class="panel-body">
        <div class="table table-responsive">
            <table id="tbreporte_cli" class="table-condensed table-striped table-hover" cellspacing="0" width="100%">
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
                        <td><b>Total del Mes: <?php  echo round($horas_totales).' horas'; ?></b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!--container-->
    </div>
    <!--panel warning-->
</div>
<!--panel body-->
</div>
<?php
}
