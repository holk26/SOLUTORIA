<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <h4>Datos Indicadores</h4>
                    </li>
                    <hr>
                    <?php foreach ($indicadores as $indicador): ?>
                    <li class="nav-item">
                    
                        <span data-feather="file"></span>
                            <a onclick="viewIndicador(<?php echo $indicador['id']; ?>)"><?php echo $indicador['fecha']; ?></a>
                            <i class="fas fa-edit ml-2" onclick="editIndicador(<?php echo $indicador['id']; ?>)">edit</i>
                            <i class="fas fa-trash-alt ml-2" onclick="deleteIndicador(<?php echo $indicador['id']; ?>)">delete</i>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <h1 class="mt-5">Indicadores</h1>

            <div class="row">
                <div class="col-md-4 ms-auto">
                    <div class="d-grid gap-2">
                        <button id="btn_update" type="button" class="btn btn-outline-success">Actualizar</button>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Filtro</span>
                        <input type="date" aria-label="inicio" class="form-control">
                        <input type="date" aria-label="fin" class="form-control">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Filtrar</button>
                    </div>
                </div>

            </div>
            <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Unidad de medida</th>
                <th>Fecha</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($indicadores as $indicador): ?>
            <tr>
                <td><?php echo $indicador['codigo']; ?></td>
                <td><?php echo $indicador['nombre']; ?></td>
                <td><?php echo $indicador['unidad_medida']; ?></td>
                <td><?php echo $indicador['fecha']; ?></td>
                <td><?php echo $indicador['valor']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

            <canvas id="myChart"></canvas>
            <p>Este es el contenido principal de la página.</p>

        </main>
    </div>
</div>



</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Obtener los datos del API
fetch("https://mindicador.cl/api")
  .then(response => response.json())
  .then(data => {
    console.log(data);
    // Obtener los valores de cada moneda
    const uf = data.uf.valor;
    const ivp = data.ivp.valor;
    const dolar = data.dolar.valor;
    const dolar_intercambio = data.dolar_intercambio.valor;
    const euro = data.euro.valor;

    // Crear la gráfica de barras
    const ctx = document.getElementById("myChart").getContext("2d");
    const myChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["UF", "IVP", "Dólar", "Dólar acuerdo", "Euro"],
        datasets: [
          {
            label: "Valores",
            data: [uf, ivp, dolar, dolar_intercambio, euro],
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)"
            ],
            borderColor: [
              "rgba(255, 99, 132, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(255, 206, 86, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(153, 102, 255, 1)"
            ],
            borderWidth: 1
          }
        ]
      },
      options: {
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true
              }
            }
          ]
        }
      }
    });
  })
  .catch(error => console.error(error));



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
}

function editIndicador(id) {
    alert("edite"+id);
    // Ejecutar petición AJAX para editar indicador con el ID proporcionado
    // Por ejemplo:
    // $.ajax({
    //     url: '/indicadores/edit/' + id,
    //     method: 'GET',
    //     success: function(response) {
    //         // Actualizar la página o mostrar el formulario de edición
    //     }
    // });
}

function deleteIndicador(id) {
    alert("elimine"+id);
    // Ejecutar petición AJAX para eliminar indicador con el ID proporcionado
    // Por ejemplo:
    // $.ajax({
    //     url: '/indicadores/delete/' + id,
    //     method: 'POST',
    //     success: function(response) {
    //         // Actualizar la página o eliminar el elemento de la lista
    //     }
    // });
}

function viewIndicador(id) {
  alert("view"+id);
}

</script>