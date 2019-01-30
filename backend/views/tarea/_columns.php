<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'attribute'=>'UsuarioName',
        'label' => 'Usuario',
        'contentOptions' =>
        [
            'style' => 'word-wrap: breaj-word; white-space: normal;'
        ],
    ],
    
    [
        'attribute'=>'PrioridadName',
        'label' => 'Prioridad',
        'contentOptions' =>
        [
            'style' => 'word-wrap: breaj-word; white-space: normal;'
        ],
    ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre',
    ],
    [
        'attribute'=>'fecha',
        'value' =>function($model)
        {
            return date_format(date_create($model->fecha),'d/m/Y');
        },
                
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'¿Seguro?',
                          'data-confirm-message'=>'¿Esta seguro de eliminar este elemento?'], 
    ],

];   