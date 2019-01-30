<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "prioridad".
 *
 * @property int $id
 * @property string $prioridad
 *
 * @property Tarea[] $tareas
 */
class Prioridad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prioridad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prioridad'], 'required'],
            [['prioridad'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prioridad' => 'Prioridad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareas()
    {
        return $this->hasMany(Tarea::className(), ['idprioridad' => 'id']);
    }
}
