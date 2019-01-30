<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tarea */
?>
<div class="tarea-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'UsuarioName',
                'label' => 'Usuario',
                
            ],
            [
                'attribute'=>'PrioridadName',
                'label' => 'Prioridad',
                
                
            ],
            'nombre',
            [
                'attribute'=>'fecha',
                'value' =>$model->fecha=date_format(date_create($model->fecha),'d/m/Y'),
                
            ],
        ],
    ]) ?>

</div>
