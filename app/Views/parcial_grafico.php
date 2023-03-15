<?php
//var_dump($dataI);
$miArrayJSON = json_encode($dataI);
echo "<script>var data = JSON.parse('$miArrayJSON');</script>";
?>
<div class="row">
    <div class="col-md-4 ms-auto">
        
        <div class="input-group">
            <a href="edite/<?php echo $dataI[0]['lote']; ?>"><button id="btn_update" type="button" class="btn btn-outline-success">editar</button></a>
            <span class="input-group-text">Filtro</span>
            <input type="date" aria-label="inicio" class="form-control">
            <input type="date" aria-label="fin" class="form-control">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Filtrar</button>
        </div>
    </div>

</div>
<div class="mb-3"></div>
<h1>Aqui va la grafica: <?php echo $dataI[0]['lote']; ?></h1>
<canvas id="myChart"></canvas>

</main>
</div>
</div>



</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Obtener los datos del API
        console.log(data);
         // Obtener los valores de cada moneda
        // Extracción de valores
        const valores = data.map(d => parseFloat(d.valor));
        const nombres = data.map(d => d.nombre);

        // Creación de la gráfica
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: nombres,
                datasets: [{
                    label: 'Valores',
                    data: valores,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
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
    }
</script>