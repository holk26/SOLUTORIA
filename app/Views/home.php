<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <h4>Datos Indicadores</h4>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <span data-feather="file"></span>
                        Archivos
                        <i class="fas fa-edit ml-2">edit</i>
                        <i class="fas fa-trash-alt ml-2">delete</i>
                    </li>
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

            <canvas id="myChart"></canvas>
            <p>Este es el contenido principal de la página.</p>

        </main>
    </div>
</div>



</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>


    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
}


</script>