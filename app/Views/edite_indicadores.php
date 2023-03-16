<?php
//var_dump($dataI);
?>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<div class="container">
    <h2>Modo edicion</h2>
    <div class="mb-3"></div>
    <table id="myTable" class="display" style="width:100%">
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
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        let table = new DataTable('#myTable', {
            responsive: true
        });

        function editeIndicadorById(id) {
            alert("Vas a editar: " + id);
        }

        function eliminarIndicadorById(id) {
            alert("Vas a eliminar: " + id);
        }
    </script>
</div>