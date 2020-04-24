<?php require_once 'public/header.php' ?>
<h1>Cross Validation</h1>
<h4>Utiliza la tabla de 200 registros y comparo las columnas ['EC', 'OR', 'CA', 'EA'] </h4>
<h4>Resultado por iteracion: </h4>
<div class="container">
    <?php foreach ($vars['iteraciones'] as $item) { ?>
        <p><?php echo $item; ?></p>
    <?php } ?>
</div>
<br>
<h4>Resultado total: <?php echo $vars['total'] ?> %</h4>
<?php require_once 'public/footer.php' ?>