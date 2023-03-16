<?php
//var_dump($dataI);
$miArrayJSON = json_encode($dataI);
echo "<script>var dataGrafico = JSON.parse('$miArrayJSON');</script>";
?>
<div class="row">
    <div class="col-md-4 ms-auto">

        <div class="input-group">
            <a href="edite/<?php echo $dataI[0]['lote']; ?>"><button id="btn_update" type="button" class="btn btn-outline-success">Editar</button></a>
            <a href="edite/<?php echo $dataI[0]['lote']; ?>"><button id="btn_update" type="button" class="btn btn-outline-danger">Eliminar</button></a>
            <span class="input-group-text">Filtro</span>
            <input type="date" aria-label="inicio" class="form-control">
            <input type="date" aria-label="fin" class="form-control">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Filtrar</button>
        </div>
    </div>

</div>
<div class="mb-3"></div>
<h1>Aqui va la grafica: <?php echo $dataI[0]['lote']; ?></h1>
<table class="table table-striped table-hover">
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
            <?php foreach ($dataI as $indicador) : ?>
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

</main>
</div>
</div>



</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Obtener los datos del API
    console.log(dataGrafico);
    console.log("hola");
    console.log(dataGrafico.map(row => row.codigo));
    // Obtener los valores de cada moneda
    // Extracción de valores
    //const valores = dataGrafico.map(d => parseFloat(d.valor));
    //const nombres = dataGrafico.map(d => d.nombre);

const data = {
  labels: dataGrafico.map(row => row.codigo),
  datasets: [{
    label: 'My First Dataset',
    data: dataGrafico.map(row => row.valor),
    fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  }]
};

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