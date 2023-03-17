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
<canvas id="miGrafica"></canvas>

</main>
</div>
</div>



</div>

<script>
  var datos_grafica = <?php echo json_encode($dataI); ?>;

  console.log(datos_grafica);

  // Suponiendo que tienes el arreglo de objetos en una variable llamada "datos"

  // Crear objeto para almacenar los datos transformados
  var datosTransformados = {
    fechas: [],
    nombres: {}
  };

  // Recorrer el arreglo de objetos y agregar cada valor al objeto transformado
  datos_grafica.forEach(dato => {
    // Agregar fecha al arreglo de fechas si no existe
    if (!datosTransformados.fechas.includes(dato.fecha)) {
      datosTransformados.fechas.push(dato.fecha);
    }

    // Agregar valor al objeto correspondiente al nombre y fecha
    if (!datosTransformados.nombres[dato.nombre]) {
      datosTransformados.nombres[dato.nombre] = {};
    }
    datosTransformados.nombres[dato.nombre][dato.fecha] = dato.valor;
  });

  // Crear arreglo de datasets para Chart.js a partir del objeto transformado
  var datasets = Object.entries(datosTransformados.nombres).map(([nombre, valores]) => {
    return {
      label: nombre,
      data: datosTransformados.fechas.map(fecha => valores[fecha] || null),
      fill: false
    };
  });

  // Crear objeto de configuración de Chart.js
  var config = {
    type: 'line',
    data: {
      labels: datosTransformados.fechas,
      datasets: datasets
    },
    options: {
      scales: {
        xAxes: [{
          type: 'time',
          time: {
            unit: 'day',
            displayFormats: {
              day: 'MMM DD'
            }
          }
        }]
      }
    }
  };

  // Obtener el contexto del canvas donde se mostrará la gráfica
  var ctx2 = document.getElementById('miGrafica').getContext('2d');

  // Crear instancia de Chart.js con la configuración y contexto
  var grafica = new Chart(ctx2, config);


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