<?php

// llamar al archivo conexion
include '../config/conexion.php';
include '../funciones.php';   //Archivo de funciones PHP

//recibir parametros
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
}
if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['password'])) {
    $password = sha1($_POST['password']);
}
$hoy = date('Y-m-d H:i:s');
$clave = get_row('users', 'password', 'password', $password);
$username_bd = get_row('users', 'username', 'password', $password);

if ($clave == $password && $username == $username_bd) {
    $errors[] = 'Ya existe usuario con esos parametros.';
} else {
    $consulta = "INSERT INTO users(name, username, password, active, date_add) 
    VALUES (UPPER('$nombre'),LOWER('$username'), '$password', 1, '$hoy')";
    $sql = mysqli_query($con, $consulta);
    if ($sql) {
        $messages[] = 'Usuario Creado Exitosamente.';
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
