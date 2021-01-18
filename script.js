$(document).ready(function () {
  $("#btn_marcaciones").css('visibility', 'hidden');//ocultamos el modal 

});

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
      $("#table").html("");
      $("#loader").html("");
      $("#resultado_botones").html(data);
      $("#btn_marcaciones").css('visibility', 'visible');//ocultamos el modal 
      $("#btn_registrarse").css('visibility', 'hidden');//ocultamos el modal 
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
  $("#resultados_ajax_registro").html('');
  $("#modal_registro").modal('hide');//ocultamos el modal 

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

