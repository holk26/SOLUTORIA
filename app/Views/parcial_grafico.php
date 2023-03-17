<?php
//var_dump($dataI);
//$miArrayJSON = json_encode($dataI);
//echo "<script>var dataGrafico = JSON.parse('$miArrayJSON');</script>";
?>
<div class="row">
    <div class="col-md-4 ms-auto">

        <div class="input-group">
            <a href="edite/<?php echo $dataI[0]['lote']; ?>"><button id="btn_update" type="button" class="btn btn-outline-success">Editar</button></a>
            <a href="edite/<?php echo $dataI[0]['lote']; ?>"><button id="btn_update" type="button" class="btn btn-outline-danger">Eliminar</button></a>
            <span class="input-group-text">Filtro</span>
            <input id="fromDate" type="date" aria-label="inicio" class="form-control">
            <input id="toDate" type="date" aria-label="fin" class="form-control">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Filtrar</button>
        </div>
    </div>

</div>
<div class="mb-3"></div>
<h1>Gráficos  <?php echo $dataI[0]['lote']; ?></h1>
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



</script>


<script>
    /*
    // Obtener los datos del API
    console.log(dataGrafico);
    console.log("hola");
    console.log(dataGrafico.map(row => row.codigo));
    // Obtener los valores de cada moneda
    // Extracción de valores
    //const valores = dataGrafico.map(d => parseFloat(d.valor));
    //const nombres = dataGrafico.map(d => d.nombre);

    dataX = [{
            codigo: 'LIBRA_COBRE',
            nombre: 'LIBRA DE COBRE',
            unidad_medida: 'Dólar',
            fecha: '2021-01-04',
            valor: 3.56
        },
        {
            codigo: 'EURO',
            nombre: 'EURO',
            unidad_medida: 'Pesos',
            fecha: '2021-01-04',
            valor: 873.30
        },
        {
            codigo: 'DOLAR',
            nombre: 'DÓLAR OBSERVADO',
            unidad_medida: 'Pesos',
            fecha: '2021-01-04',
            valor: 710.95
        }
    ];

    dates = dataX.map(d => d.fecha);
    values = dataX.map(d => d.valor);

    ctx = document.getElementById('myChart').getContext('2d');
    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Valor',
                data: values,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgb(255, 99, 132, 0.5)'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });





    function guardarDatos() {
        $.ajax({
            url: "guardar_datos.php",
            type: "POST",
            data: {},
            success: function(response) {
                alert("Los datos se han guardado correctamente en la base de datos.");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }*/
</script>