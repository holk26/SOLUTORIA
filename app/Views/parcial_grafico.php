<?php
//var_dump($dataI);
//$miArrayJSON = json_encode($dataI);
//echo "<script>var dataGrafico = JSON.parse('$miArrayJSON');</script>";
?>
<div class="row">
  <div class="col-md-4 ms-auto">

    <div class="input-group">
      <a href="edite/<?php echo $dataI[0]['lote']; ?>"><button id="btn_update" type="button" class="btn btn-outline-success">Editar</button></a>
      <button id="btn_delete_lote" type="button" data-lote="<?php echo $dataI[0]['lote']; ?>" class="btn btn-outline-danger">Eliminar</button>
      <span class="input-group-text">Filtro</span>
      <input id="fromDate" type="date" aria-label="inicio" class="form-control">
      <input id="toDate" type="date" aria-label="fin" class="form-control">
      <button class="btn btn-outline-secondary" type="button" id="button-addon2">Filtrar</button>
    </div>
  </div>

</div>
<div class="mb-3"></div>
<h1>Gráficos <?php echo $dataI[0]['lote']; ?></h1>
<div id="miGrafica"></div>

</main>
</div>
</div>



</div>


<script>
  var datos_grafica = <?php echo json_encode($dataI); ?>;
  console.log(datos_grafica);
  //Codigo de la grafica

  // Creamos un objeto para guardar los datos por serie
  var seriesData = {};

  // Iteramos por cada objeto en el arreglo 'datos'
  datos_grafica.forEach(function(dato) {
    // Si la serie no existe, la creamos
    if (!seriesData[dato.nombre]) {
      seriesData[dato.nombre] = {
        name: dato.nombre,
        data: []
      };
    }
    // Agregamos el valor a la serie correspondiente
    seriesData[dato.nombre].data.push(parseFloat(dato.valor));
  });

  // Convertimos el objeto de series a un arreglo
  var series = Object.values(seriesData);

  // Configuramos el gráfico
  var options = {
    chart: {
      type: 'line'
    },
    series: series,
    xaxis: {
      categories: datos_grafica.map(function(dato) {
        return dato.fecha;
      })
    }
  };

  // Creamos el gráfico
  var chart = new ApexCharts(document.querySelector("#miGrafica"), options);

  // Renderizamos el gráfico
  chart.render();

  //Fin codigo de la grafica
  $('#btn_delete_lote').on('click', function() {
    const lote = $(this).data('lote');
    const confirmacion = confirm('¿Seguro que desea eliminar el lote ' + lote + '?');
    if (confirmacion) {
      const url = '<?php echo base_url('Home/deleteBylote'); ?>';
      $.post(url, {
          lote: lote
        }, function(data) {
          refrecarLotes();
          $('#indicadores').html("<h4>Eliminacion completa</h4>");
          mostrarMensaje("Eliminacion completa.");
          // Aquí podrías agregar código para actualizar la tabla o la página después de eliminar el lote
        })
        .fail(function(xhr, status, error) {
          console.log("Error al enviar la solicitud: " + status);
        });
    }
  });
</script>