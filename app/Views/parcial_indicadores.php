<?php $contador = 1; ?>
<?php foreach ($indicadores as $indicador) : ?>
    <li class="nav-item">
        <span data-feather="file"><?php echo $contador; ?> indicador:</span>
        <a href="#<?php echo date('d/m/Y', ); ?>"><?php echo date('d/m/Y H:i:s', $indicador['lote']); ?></a>
    </li>
    <?php $contador++; ?>
<?php endforeach; ?>