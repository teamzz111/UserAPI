<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modulo".
 *
 * @property int $id
 * @property string $nombre
 * @property string $icono
 * @property string $opciones
 * @property string $estado
 *
 * @property Permiso[] $permisos
 */
class Modulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nombre', 'icono', 'opciones', 'estado'], 'required'],
            [['id'], 'integer'],
            [['nombre', 'icono', 'opciones', 'estado'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'icono' => 'Icono',
            'opciones' => 'Opciones',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermisos()
    {
        return $this->hasMany(Permiso::className(), ['modulo_id' => 'id']);
    }
}
