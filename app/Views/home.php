<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <h4>Datos Indicadores</h4>
            <div class="d-grid gap-2">
              <button id="btn_update" type="button" class="btn btn-outline-success">Actualizar</button>
            </div>
          </li>
          <hr>
          <div id="lotes"></div>
        </ul>
      </div>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <h1 class="mt-5">Indicadores</h1>
      <div id="indicadores">
        <h4>Selecciona un indicador</h4>
      </div>
    </main>
  </div>
</div>
<script>
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
    });
  }

  //Aptualiza los datos desde la api
  $(document).ready(function() {
    $("#btn_update").click(function() {
      $.post('<?php echo base_url('Home/btnUpdate'); ?>', function(data) {
        console.log(data);
        refrecarLotes();
        //$('#indicadores').html(data);

      });
    });
  });
</script>