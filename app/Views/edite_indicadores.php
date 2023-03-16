<?php
//var_dump($dataI);
?>
<div class="container">
    <h2>Modo edicion</h2>
    <div class="mb-3"></div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Unidad de medida</th>
                <th>Fecha</th>
                <th>Valor</th>
                <th>Accion</th>
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
                    <td>
                        <button type="button" onclick="editeIndicadorById(<?php echo $indicador['id']; ?>)" class="btn btn-primary btn-sm">Editar</button>
                        <button type="button" onclick="eliminarIndicadorById(<?php echo $indicador['id']; ?>)" class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    </main>
    <script>
        function editeIndicadorById(id){
            alert("Vas a editar: "+id);
        }

        function eliminarIndicadorById(id){
            alert("Vas a eliminar: "+id);
        }
    </script>
</div>