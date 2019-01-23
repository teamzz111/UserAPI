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
class Module extends \yii\db\ActiveRecord
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
            [['nombre', 'icono', 'opciones', 'estado'], 'required'],
            [['nombre', 'icono', 'opciones', 'estado'], 'string', 'max' => 45],
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
        return $this->hasMany(Permission::className(), ['modulo_id' => 'id']);
    }
}
