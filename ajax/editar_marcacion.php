<?php

// llamar al archivo conexion
include '../config/conexion.php';
include '../funciones.php';   //Archivo de funciones PHP
$params = $_POST['id_marcacion'];
if ($params) {
    // marcar entrada insert
    $consulta = "SELECT * FROM horarios WHERE id = '$params'";
    $sql = mysqli_query($con, $consulta);
    if ($sql) {
        while ($row = mysqli_fetch_array($sql)) {
            $data = [
            'in_work' => $row['in_work'],
            'start_break' => $row['start_break'],
            'end_break' => $row['end_break'],
            'exit_work' => $row['exit_work'],
        ];
        }
        echo json_encode($data);
    } else {
        $errors[] = 'Error desconocido.'.mysqli_error($con);
    }
} else {
    $id = $_POST['id'];
    $entrada = $_POST['entrada'];
    $inicio = $_POST['inicio'];
    $fin = $_POST['fin'];
    $salida = $_POST['salida'];

    $consulta = "UPDATE horarios SET
in_work = '$entrada',
start_break = '$inicio',
end_break = '$fin',
exit_work = '$salida'
WHERE id = '$id'";
    $sql = mysqli_query($con, $consulta);
    if ($sql) {
        $messages[] = 'Marcacion Actualizada Exitosamente.';
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
