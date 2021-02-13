<?php

// llamar al archivo conexion
include '../config/conexion.php';
include '../funciones.php';   //Archivo de funciones PHP
$params = $_POST['id_borrar'];
$id_a_editar = $_POST['id_editar'];
if ($params) {
    // marcar entrada insert
    $consulta = "DELETE FROM horarios WHERE id = '$params'";
    $sql = mysqli_query($con, $consulta);
    if ($sql) {
        $messages[] = 'Marcacion Eliminada Exitosamente.';
    } else {
        $errors[] = 'Error desconocido.'.mysqli_error($con);
    }
}
if ($id_a_editar) {
    // marcar entrada insert
    $consulta = "UPDATE horarios SET  WHERE id = '$params'";
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
