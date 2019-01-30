<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tarea */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tarea-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idusuario')->hiddenInput()->label(false) ?>

    
    <?= $form->field($model, 'idprioridad')->dropDownList($model->listaPrioridad,['prompt'=>'Seleccione una prioridad'])->label('Prioridad') ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    
    <?= $form->field($model, 'fecha')->widget(DatePicker::classname(), [
     'language' => 'es',
     
    'options' => ['placeholder' => 'Fecha Vencimiento ...', ],
    'pluginOptions' => [
        'todayHighlight' => true,
         'minDate'=> 0,
        'autoclose'=>true
    ]
]);
?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

