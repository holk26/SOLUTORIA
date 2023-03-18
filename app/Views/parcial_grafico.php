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
    </div>
  </div>

</div>
<div class="mb-3"></div>
<h1>Gráficos <?php echo $dataI[0]['lote']; ?></h1>
Desde: <input type="date" id="fechaDesde">
Hasta: <input type="date" id="fechaHasta">
<button class="" onclick="filtrarDatos()">Filtrar</button>
<div id="miGrafica"></div>


</main>
</div>
</div>



</div>


<script>
  var datos_grafica = <?php echo json_encode($dataI); ?>;

  // Obtén la fecha mínima y máxima de los datos
  var fechas = datos_grafica.map(function(dato) {
    return new Date(dato.fecha).getTime();
  });
  var fechaMinima = new Date(Math.min.apply(null, fechas)).toISOString().slice(0, 10);
  var fechaMaxima = new Date(Math.max.apply(null, fechas)).toISOString().slice(0, 10);

  // Completa automáticamente los input de fecha
  document.getElementById("fechaDesde").value = fechaMinima;
  document.getElementById("fechaHasta").value = fechaMaxima;


  // Obtén los valores únicos de las categorías (fechas)
  var categorias = datos_grafica.map(function(dato) {
    return dato.fecha;
  });
  categorias = categorias.filter(function(valor, indice, self) {
    return self.indexOf(valor) === indice;
  });
  categorias.sort(); // Ordena las categorías de forma ascendente

  // Crea un objeto con las series de la gráfica
  var series = {};
  datos_grafica.forEach(function(dato) {
    if (!series[dato.nombre]) {
      series[dato.nombre] = {
        name: dato.nombre,
        data: []
      };
    }
    series[dato.nombre].data.push(parseFloat(dato.valor));
  });

  // Crea la gráfica con ApexCharts
  var options = {
    chart: {
      type: 'line',
      height: 350
    },
    series: Object.values(series),
    xaxis: {
      categories: categorias
    }
  };
  var chart = new ApexCharts(document.querySelector("#miGrafica"), options);
  chart.render();

  // Define la función para filtrar los datos por fecha
  function filtrarDatos() {
    var fechaDesde = document.getElementById("fechaDesde").value;
    var fechaHasta = document.getElementById("fechaHasta").value;
    var datosFiltrados = datos_grafica.filter(function(dato) {
      return dato.fecha >= fechaDesde && dato.fecha <= fechaHasta;
    });
    // Actualiza las categorías y las series con los datos filtrados
    categorias = datosFiltrados.map(function(dato) {
      return dato.fecha;
    });
    categorias = categorias.filter(function(valor, indice, self) {
      return self.indexOf(valor) === indice;
    });
    categorias.sort(); // Ordena las categorías de forma ascendente
    series = {};
    datosFiltrados.forEach(function(dato) {
      if (!series[dato.nombre]) {
        series[dato.nombre] = {
          name: dato.nombre,
          data: []
        };
      }
      series[dato.nombre].data.push(parseFloat(dato.valor));
    });
    // Actualiza la gráfica con los datos filtrados
    chart.updateSeries(Object.values(series));
    chart.updateOptions({
      xaxis: {
        categories: categorias
      }
    });
  }



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