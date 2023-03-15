<?php foreach ($indicadores as $indicador) : ?>
    <li class="nav-item">

        <span data-feather="file"></span>
        <a class="lote_id" onclick="viewGrafica(<?php echo $indicador['lote']; ?>)"><?php echo $indicador['fecha']; ?></a>
    </li>
<?php endforeach; ?>