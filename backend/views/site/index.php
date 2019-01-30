<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
      

        <p class="lead">Bienvenido a la prueba de Walter Jimenez.</p>

        
    </div>

    <div class="body-content" style="text-align: center;">

        <?php
       
            foreach ($model->mostrarVencimientos as $key => $value) {
            echo "La tarea <b>'".$value."'</b> está pronta a vencerse.<br>";
            };
        ?>

    </div>
</div>
