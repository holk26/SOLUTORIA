<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar overflow-auto">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <h4>Datos Indicadores</h4>
            <div class="d-grid gap-2">
              <button id="btn_update" type="button" class="btn btn-outline-success">Actualizar</button>
            </div>
          </li>
          <hr>
          <div id="spinner" class="justify-content-center">
            <div class="spinner-border" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>
          <div id="lotes"></div>
        </ul>
      </div>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <h1 class="mt-5">Indicadores</h1>
      <div id="indicadores">
        <p>Selecciona un indicador de la columna izquierda para visualizar la grafica y demas opciones</p>
        <p>
          <button class="btn btn-outline-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Instrucciones
          </button>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <h5>Modo de uso:</h5>
            <ul class="list-group">
              <li class="list-group-item">En el botón <button type="button" class="btn btn-outline-success btn-sm">Actualizar</button> genera un token y descarga los indicadores y los guarda en la base de datos MySQL. 
              y los lista en la columna izquierda</li>
              <li class="list-group-item">En el botón <button type="button" class="btn btn-outline-success btn-sm">Editar</button>  se pueden borrar y modificar los registros por id.</li>
              <li class="list-group-item">En el botón <button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>  eliminarás por completo el lote en el que estés con todos sus registros.</li>
              <li class="list-group-item">
                  En la vista de la grafica tenemos varias opciones filtrar por fechas deseleccionar indicadores para analizar de forma independiente, hacer zoom, descargar csv, png, svg
              </li>
            </ul>

          </div>
        </div>
      </div>
    </main>
  </div>
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img src="..." class="rounded me-2" alt="...">
        <strong class="me-auto">SOLUTORIA</strong>
        <small id="timeApi">11 mins ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        OK
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  window.addEventListener('hashchange', function() {
    const hash = window.location.hash;
    const numero = hash.substring(1);
    console.log('El hash ha cambiado. El nuevo número es: ' + numero);
    viewGrafica(numero);
  });

  document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash) {
      const hash = window.location.hash;
      const numero = hash.substring(1);
      console.log('Hay un hash en la URL. El número es: ' + numero);
      viewGrafica(numero);
      // Ejecutar función de validación
    }
  });
  refrecarLotes();

  function refrecarLotes() {
    $.ajax({
      url: '/Home/viewLotes/',
      method: 'POST',
      success: function(response) {
        $('#lotes').html(response);
        // Actualizar la página o eliminar el elemento de la lista
      }
    });
    $("#spinner").hide();
    $("#btn_update").attr('disabled', false);
  }


  function viewGrafica(lote) {
    // Ejecutar petición AJAX para eliminar indicador con el ID proporcionado
    // Por ejemplo:
    $.ajax({
      url: '/Home/view/' + lote,
      method: 'GET',
      success: function(response) {
        $('#indicadores').html(response);
        // Actualizar la página o eliminar el elemento de la lista
      }
    }).fail(function(jqXHR, textStatus, errorThrown) {
      $('#indicadores').html("<h4>Indicador no encontrado</h4>");
      console.log('Error en la petición AJAX:');
      console.log('jqXHR:', jqXHR);
      console.log('textStatus:', textStatus);
      console.log('errorThrown:', errorThrown);
      // Mostrar un mensaje de error al usuario o realizar otra acción apropiada
    });
  }


  //Actualiza los datos desde la api
  $(document).ready(function() {
    $("#btn_update").click(function() {
      $("#spinner").show();
      $("#btn_update").attr('disabled', true);
      const start = performance.now(); // tiempo actual antes de enviar la solicitud
      $.post('<?php echo base_url('Home/btnUpdate'); ?>', function(data) {
          const duration = performance.now() - start / 1000; // calcular el tiempo de solicitud
          console.log(data);
          mostrarMensaje("Actualización completa", duration.toFixed(2));
          refrecarLotes();
        })
        .fail(function(xhr, status, error) {
          mostrarMensaje(status);
          console.log("Error al enviar la solicitud: " + status);
          $("#btn_update").attr('disabled', false);
          $("#spinner").hide();
        });

    });
  });

  function mostrarMensaje(mensaje, timeA = 5) {
    // Obtener el elemento con la clase "toast-body"
    const toastBody = $('.toast-body');
    const time = $('#timeApi');

    // Actualizar el contenido del elemento con el mensaje recibido como argumento
    toastBody.text(mensaje);
    time.text("Tardo " + timeA + " segundos");

    // Mostrar el elemento toast
    $('#liveToast').toast('show');
  }
</script>