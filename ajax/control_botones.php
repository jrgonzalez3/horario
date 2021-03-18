<?php

session_start();
// llamar al archivo conexion
include '../config/conexion.php';
include '../funciones.php';   //Archivo de funciones PHP

// buscar si existe el user con la clave proporcionada
if (isset($_POST['clave'])) {
    $clave = sha1($_POST['clave']);
}
$is_user = get_row('users', 'id', 'password', $clave);
$name_user = get_row('users', 'name', 'id', $is_user);

if (!$is_user) {
    echo '<script>
    alert("Usuario Inexistente");
    limpiar_form();
    </script>';
} else {
    if ($is_user == 23) {
        $_SESSION['usuario_sesion'] = $is_user;
        echo '<script>
        $("#btn_cpanel").css("visibility", "visible");
        </script>';
    } else {
        echo '<script>
        $("#btn_cpanel").css("visibility", "hidden"); 
        </script>';
    }

    $boton_start = '<button id="marcar_entrada" type="button" onclick="marcar(1,'.$is_user.')" class="btn btn-success">
<span class="fa fa-pencil"></span> Marcar Entrada </button>
';
    $boton_start_break = '<button type="button" id="inicio_break" onclick="marcar(2,'.$is_user.')" class="btn btn-primary">
<span class="fa fa-pencil"></span> Inicio Break </button>
';
    $boton_end_break = '<button type="button" id="fin_break" onclick="marcar(3,'.$is_user.')" class="btn btn-warning">
<span class="fa fa-pencil"></span> Fin Break </button>
';
    $boton_end = '<button type="button" id="marcar_salida" onclick="marcar(4,'.$is_user.')" class="btn btn-danger">
<span class="fa fa-pencil"></span> Marcar Salida </button>
';
    $date = date('Y-m-d');
    $consulta = "SELECT in_work, date_work, start_break, end_break, exit_work FROM horarios h  JOIN users u ON h.id_user=u.id WHERE u.password ='$clave' AND date_work ='$date'  ORDER BY h.id ";
    $result = mysqli_query($con, $consulta) or die(mysqli_error($con));
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        echo $boton_start;
    }
    while ($row = mysqli_fetch_array($result)) {
        //  var_dump($row);
        echo '<script>
        $("#btn_marcaciones").css("visibility", "visible"); 
        </script>';
        $now = date('Y-m-d');
        $date_work = $row['date_work'];
        if ($now == $date_work) {
            $start = $row['in_work'];
            $start_break = $row['start_break'];
            $end_break = $row['end_break'];
            $end = $row['exit_work'];
            if ($start == '') {
                // mostrar boton Marcar Entrada
                echo $boton_start;
            } elseif ($start_break == '') {
                echo $boton_start_break;
            // mostrar todos los otros botones excepto start
            } elseif ($end_break == '') {
                echo $boton_end_break;
            } elseif ($end == '') {
                echo $boton_end;
            } else {
                echo ' <label class="text-danger text-right form-text text-muted ">Hoy ya no hay nada que marcar! </label>';
            }
        } else {
            echo $boton_start;
        }
        echo ' <label class="text-warning text-right form-text text-muted ">  '.$name_user.'  </label>';
    }
}
