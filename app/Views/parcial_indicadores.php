<?php $contador = 1; ?>
<?php foreach ($indicadores as $indicador) : ?>
    <li class="nav-item">
        <span data-feather="file"><?php echo $contador; ?> indicador:</span>
        <a href="#<?php echo $indicador['lote']; ?>"><?php echo $indicador['lote']; ?></a>
    </li>
    <?php $contador++; ?>
<?php endforeach; ?>