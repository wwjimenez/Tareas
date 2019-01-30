<?php

namespace backend\models;

use Yii;
use johnitvn\userplus\base\models\UserAccounts;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tarea".
 *
 * @property int $id
 * @property int $idusuario
 * @property int $idprioridad
 * @property string $nombre
 * @property string $fecha
 *
 * @property Prioridad $prioridad
 * @property UserAccounts $usuario
 */
class Tarea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarea';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idusuario', 'idprioridad', 'nombre', 'fecha'], 'required'],
            [['idusuario', 'idprioridad'], 'integer'],
            [['fecha'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['idprioridad'], 'exist', 'skipOnError' => true, 'targetClass' => Prioridad::className(), 'targetAttribute' => ['idprioridad' => 'id']],
            [['idusuario'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['idusuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idusuario' => 'Idusuario',
            'idprioridad' => 'Idprioridad',
            'nombre' => 'Nombre',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrioridad()
    {
        return $this->hasOne(Prioridad::className(), ['id' => 'idprioridad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'idusuario']);
    }

    /**
    *@return array prioridad
    */
    public static function getListaPrioridad()
    {
        $opciones=Prioridad::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'id', 'prioridad');
    }

    public function beforeSave($insert)
    {
        //cambiamos el formato de las fechas
        $formato='d/m/Y';
        $fecha=date_create_from_format($formato,$this->fecha);
        if($fecha !=false)
        {
            $this->fecha=date_format($fecha,'Y-m-d');
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @return String
    */
    public function getPrioridadName()
    {
        return $this->prioridad->prioridad;
    }

    /**
     * @return String
     */
    public function getUsuarioName()
    {
        return $this->usuario->login;
    }

    /**
     * @return Array
     */
    public function getmostrarVencimientos()
    {
        $resultado=ArrayHelper::map(Tarea::find()->where('DATEDIFF(fecha, now()) < 5')->andWhere(['idusuario' =>Yii::$app->user->id])->all(), 'fecha', 'nombre');
        return $resultado;
    }
}
