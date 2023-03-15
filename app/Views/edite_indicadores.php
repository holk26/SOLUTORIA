<?php
//var_dump($dataI);
?>
<div class="container">
    <h2>Modo edicion</h2>
    <div class="mb-3"></div>
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

    </main>
</div>