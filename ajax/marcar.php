<?php

// llamar al archivo conexion
include '../config/conexion.php';
include '../funciones.php';   //Archivo de funciones PHP
$params = $_POST['option'];
$id_user = $_POST['id_user'];
$time_now = date('H:i:s');
$date_work = date('Y-m-d');
if ($params == 1) {
    // marcar entrada insert
    $consulta = "INSERT INTO horarios(id_user, in_work, date_work) VALUES ('$id_user','$time_now', '$date_work')";
    $sql = mysqli_query($con, $consulta);
    if ($sql) {
        $messages[] = 'Horario de Entrada marcada Exitosamente a las '.$time_now;
    } else {
        $errors[] = 'Error desconocido.'.mysqli_error($con);
    }
} elseif ($params == 2) {
    // marcar inicio break update
    $update = "UPDATE horarios SET start_break='".$time_now."' WHERE id_user=$id_user and date_work='".$date_work."'";
    $update_query = mysqli_query($con, $update) or die(mysqli_error($con));
    if ($update_query) {
        $messages[] = 'Se Marco inicio Break a las '.$time_now;
    } else {
        $errors[] = 'Error desconocido.'.mysqli_error($con);
    }
} elseif ($params == 3) {
    // marcar fin break update
    $update = "UPDATE horarios SET end_break='".$time_now."' WHERE id_user=$id_user and date_work='".$date_work."'";
    $update_query = mysqli_query($con, $update) or die(mysqli_error($con));
    if ($update_query) {
        $messages[] = 'Se marco Vuelta Break a las '.$time_now;
    } else {
        $errors[] = 'Error desconocido.'.mysqli_error($con);
    }
} else {
    // marcar fin jornada update
    $update = "UPDATE horarios SET exit_work='".$time_now."' WHERE id_user=$id_user and date_work='".$date_work."'";
    $update_query = mysqli_query($con, $update) or die(mysqli_error($con));
    if ($update_query) {
        $messages[] = 'Se marco Fin del Horario Laboral siendo las '.$time_now.', Que Descanses!.';
    } else {
        $errors[] = 'Error desconocido.'.mysqli_error($con);
    }
}

if (isset($errors)) {
    ?>
<div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert">
        &times;
    </button>
    <strong>
        Error!
    </strong>
    <?php
            foreach ($errors as $error) {
                echo $error;
            } ?>
</div>
<?php
}
    if (isset($messages)) {
        ?>
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert">
        &times;
    </button>
    <strong>
        ¡Buen Trabajo!
    </strong>
    <?php
            foreach ($messages as $message) {
                echo $message;
            } ?>
</div>
<?php
    }
