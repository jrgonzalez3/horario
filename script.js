var table;
$(document).ready(function () {
  $("#btn_cpanel").css('visibility', 'hidden');//ocultamos el modal 
})

//controla botones
$("#frm_horario").submit(function (event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "./ajax/control_botones.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html('<img src="./assets/img/ajax-loader.gif"> Cargando...');
  },
    success: function (data) {
    //  console.log(data)
     $("#btn_registrarse").css('visibility', 'hidden');//ocultamos el modal 
      $("#table").html("");
      $("#loader").html("");
      $("#resultado_botones").html(data);
    }
  });
  event.preventDefault();
});



//controla botones
$("#frm_reporte").submit(function (event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "./ajax/generar_reporte.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#respuesta").html('<img src="./assets/img/ajax-loader.gif"> Cargando...');
  },
    success: function (data) {
      $("#respuesta").html(data);
    }
  });
  event.preventDefault();
});

//se registra
$("#frm_registro").submit(function (event) {
  var parametros = $(this).serialize();
  //    console.log(parametros);

  var password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");

  function validatePassword() {
    if (password.value != confirm_password.value) {
      confirm_password.setCustomValidity("No coinciden las Claves");
    } else {
      confirm_password.setCustomValidity('');
    }
  }

  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;

  $.ajax({
    type: "POST",
    url: "./ajax/guardar_registro.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader1").html('<img src="./assets/img/ajax-loader.gif"> Cargando...');
    },
    success: function (data) {
      $("#loader1").html("");
      $("#resultados_ajax_registro").html(data);
      setTimeout(function () {
        limpiar_form();
      }, 3000); //delayTime should be written in milliseconds e.g. 1000 which equals 1 second
    }
  });
  event.preventDefault();
});

function limpiar_form() {
  $("#frm_registro")[0].reset();
  $("#frm_horario")[0].reset();
  $("#resultados_ajax_registro").html('');
  $("#modal_registro").modal('hide');//ocultamos el modal 
  $("#respuesta").html('');
  $("#table").html("");
  ocultar_botones()
}

function ocultar_botones(params) {
 // $("#btn_marcaciones").css('visibility', 'hidden');//ocultamos el modal 
  $("#btn_cpanel").css('visibility', 'hidden');//ocultamos el modal 
  $("#marcar_entrada").css('visibility', 'hidden');//ocultamos el modal 
  $("#inicio_break").css('visibility', 'hidden');//ocultamos el modal 
  $("#fin_break").css('visibility', 'hidden');//ocultamos el modal 
  $("#marcar_salida").css('visibility', 'hidden');//ocultamos el modal 
  $("#btn_registrarse").css('visibility', 'visible');//ocultamos el modal 
    
  
}

//marcado
function marcar(params, id_user) {
  let data = "option=" + params + "&id_user=" + id_user;
  $.ajax({
    type: "POST",
    url: "./ajax/marcar.php",
    data: data,
    beforeSend: function (objeto) {
      $("#loader").html('<img src="./assets/img/ajax-loader.gif"> Cargando...');
    },
    success: function (data) {
      $("#loader").html("");
      $("#respuesta").html(data);
    }

  });
  setTimeout(function () {
     window.location.reload(); // you can pass true to reload function to ignore the client cache and reload from the server
    limpiar_form();
  }, 1500); //delayTime should be written in milliseconds e.g. 1000 which equals 1 second
}

$("#btn_marcaciones").click(function (event) {
  let clave = $("#clave").val();
  $.ajax({
    type: "POST",
    url: "./ajax/marcaciones.php",
    data: "clave=" + clave,
    beforeSend: function (objeto) {
      $("#loader").html('<img src="./assets/img/ajax-loader.gif"> Cargando...');
    },
    success: function (data) {
      $("#loader").html("");
      $("#table").html(data);
    }
  });
  event.preventDefault();
});

  
//$("#tsbl_marcaciones").dataTable().fnDestroy();
$('#tbl_marcaciones').DataTable({
    dom: 'Bfrtip',
    bProcessing: true,
    order: [0, 'desc'],
    dom: 'Bfrtip',
    buttons: [{
        extend: 'pdf',
        extend: 'excel',
        pageOrientation: 'landscape',
        pageSize: 'LEGAL',
    }]
});
$('#tbl_reporte').DataTable({
  dom: 'Bfrtip',
  bProcessing: true,
  order: [0, 'desc'],
  dom: 'Bfrtip',
  buttons: [{
      extend: 'pdf',
      extend: 'excel',
      pageOrientation: 'landscape',
      pageSize: 'LEGAL',
  }]
});


function editar_marcacion(id) {
  $.ajax({
    type: "POST",
    url: "./ajax/editar_marcacion.php",
    data: "id_marcacion=" + id,
    dataType: "JSON",
    beforeSend: function (objeto) {
      $("#notification").html('<img src="./assets/img/ajax-loader.gif"> Cargando...');
    },
    success: function (data) {
      $('.modal-title').text('MODIFICAR MARCACION #' + id); // Set title to Bootstrap modal title
     $('[name="id"]').val(id);
     $('[name="entrada"]').val(data.in_work);
     $('[name="inicio"]').val(data.start_break);
     $('[name="fin"]').val(data.end_break);
     $('[name="salida"]').val(data.exit_work);
     $("#notification").html("");
    }
  });

};


$('#frm_editar_marcacion').on('submit', function(e){
  e.preventDefault();
   $.ajax({
    type: "POST",
    data: $('#frm_editar_marcacion').serialize(),
      url: "./ajax/editar_marcacion.php",
      beforeSend: function (objeto) {
        $("#loader1").html('<img src="./assets/img/ajax-loader.gif"> Cargando...');
      },
      success: function (data) {
         $("#loader1").html(data);
         setTimeout(function () {
          window.location.reload(); // you can pass true to reload function to ignore the client cache and reload from the server
        }, 1500);
      }
    });

});

function borrar_marcacion(id) {
  if (confirm("¿Realmente deseas eliminar el item "+id + "?")) {
  $.ajax({
    type: "POST",
    url: "./ajax/borrar_marcacion.php",
    data: "id_borrar=" + id,
    beforeSend: function (objeto) {
      $("#notification").html('<img src="./assets/img/ajax-loader.gif"> Cargando...');
    },
    success: function (data) {
      // $("#notification").html("");
      $("#notification").html(data);
      setTimeout(function () {
        window.location.reload(); // you can pass true to reload function to ignore the client cache and reload from the server
      }, 1500); //delayTime should be written in milliseconds e.g. 1000 which equals 1 second
    }
  });
}
};
