<?php $contador = 1; ?>
<?php foreach ($indicadores as $indicador) : ?>
    <a href="#<?php echo $indicador['lote']; ?>">
        <div class="card">
            <div class="card-body">
                <span data-feather="file"><?php echo $contador; ?> indicador:</span>
                <?php echo date('d/m/Y H:i:s', $indicador['lote']); ?>
            </div>
        </div>
    </a>
    <br>
    <?php $contador++; ?>
<?php endforeach; ?>