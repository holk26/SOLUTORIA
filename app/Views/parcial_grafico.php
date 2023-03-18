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

  // Crea una función para filtrar los datos de la gráfica
  function filtrarDatos() {
    // Obtén las fechas desde y hasta del filtro
    var fechaDesde = document.getElementById("fechaDesde").value;
    var fechaHasta = document.getElementById("fechaHasta").value;

    // Filtra los datos según las fechas seleccionadas
    var datosFiltrados = datos_grafica.filter(function(dato) {
      return dato.fecha >= fechaDesde && dato.fecha <= fechaHasta;
    });

    console.log(datosFiltrados);
    // Actualiza los datos de la gráfica con los datos filtrados
    actualizarGrafica(datosFiltrados);
  }

  // Crea una función para actualizar la gráfica con los datos filtrados
  function actualizarGrafica(datosFiltrados) {
    // Crea un arreglo vacío para las categorías de la gráfica
    var categorias = [];

    // Crea un objeto para almacenar los valores de cada serie
    var valores = {};

    // Recorre los datos filtrados y agrega las categorías y valores correspondientes
    datosFiltrados.forEach(function(dato) {
      categorias.push(dato.fecha);

      if (!valores[dato.nombre]) {
        valores[dato.nombre] = [];
      }
      valores[dato.nombre].push(dato.valor);
    });

    // Convierte el objeto de valores en un arreglo de series
    var series = [];
    for (var nombre in valores) {
      if (valores.hasOwnProperty(nombre)) {
        series.push({
          name: nombre,
          data: valores[nombre]
        });
      }
    }

    // Configura las opciones de la gráfica
    var options = {
      series: series,
      chart: {
        type: 'line',
        height: 350
      },
      xaxis: {
        categories: categorias,
      },
      yaxis: {
        title: {
          text: 'Valor'
        }
      },
      stroke: {
        curve: 'smooth'
      }
    };

    // Crea la instancia de la gráfica con los datos filtrados y las nuevas opciones
    var chart = new ApexCharts(document.querySelector("#miGrafica"), options);

    // Renderiza la gráfica
    chart.render();
  }

  // Carga la gráfica con todos los datos al cargar la página
  actualizarGrafica(datos_grafica);


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