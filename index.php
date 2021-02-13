<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include './head.php'; ?>

<body>
    <div class="container">
        <br>
        <div class="col-md-12">
            <div class="panel panel-success hidden-print">

                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <a id="btn_registrarse" data-toggle="modal" data-target="#modal_registro"
                            class="btn btn-primary"><span class="fa fa-user"></span> Registrarse
                        </a>
                    </div>

                    <div class="btn-group pull-right">
                        <a href="./cpanel.php" id="btn_cpanel" style="visibility: hidden" class="btn btn-primary"><span
                                class="fa fa-cog"></span>
                            Control Panel</a>
                    </div>

                    <div class="btn-group pull-right">
                        <a id="btn_marcaciones" style="visibility: hidden" class="btn btn-success"><span
                                class="fa fa-check"></span> Marcaciones
                        </a>
                    </div>

                    <h4><i class='fa fa-eye'></i> Control de Horario </h4>
                </div>

                <div class="panel-body">
                    <div id="respuesta"></div>
                    <form class="form-horizontal" role="form" id="frm_horario" autocomplete="off">
                        <div class="form-group row">
                            <label for="clave" class="col-md-2 control-label">Clave de Empleado: </label>
                            <div class="col-md-3">
                                <input autofocus autocomplete="new-password" type="password" class="form-control"
                                    id="clave" name='clave' placeholder="Ingrese su codig0 y presione enter">
                                <span id="loader"></span>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <div class='col-xs-12' id='resultado_botones'>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div id='table'></div>
        </div>
    </div>
</body>
<!-- Modal -->
<div class="modal" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="frm_registro" name="frm_registro" autocomplete="off">

                    <div id="loader1"></div>
                    <div id="resultados_ajax_registro"></div>
                    <!--aQUI SE CARGA DESDE -->

                    <div class="form-group">
                        <label for="Nombre" class="col-sm-3 control-label">Nombre y Apellido </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Nombre Completo" required value="">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="Username" class="col-sm-3 control-label">Usuario</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" autocorrect="off" autocapitalize="off"
                                autocomplete="ÑÖcompletes" id="username" name="username" placeholder="Usuario" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="clave" class="col-sm-3 control-label">Clave</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Ingrese Clave" autocomplete="new-password" required>
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="clave" class="col-sm-3 control-label">Repite Clave</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="Repita Clave" required value="">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php include './footer.php'; ?>

<script src="./script.js"></script>

</html>