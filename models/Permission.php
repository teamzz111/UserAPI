<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permiso".
 *
 * @property int $id
 * @property string $fecha
 * @property string $leer
 * @property string $escribir
 * @property string $eliminar
 * @property int $modulo_id
 * @property int $rol_id
 *
 * @property Modulo $modulo
 * @property Rol $rol
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permiso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fecha', 'leer', 'escribir', 'eliminar', 'modulo_id', 'rol_id'], 'required'],
            [['id', 'modulo_id', 'rol_id'], 'integer'],
            [['fecha', 'leer', 'escribir', 'eliminar'], 'string', 'max' => 45],
            [['id'], 'unique'],
            [['modulo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modulo::className(), 'targetAttribute' => ['modulo_id' => 'id']],
            [['rol_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'Fecha',
            'leer' => 'Leer',
            'escribir' => 'Escribir',
            'eliminar' => 'Eliminar',
            'modulo_id' => 'Modulo ID',
            'rol_id' => 'Rol ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModulo()
    {
        return $this->hasOne(Module::className(), ['id' => 'modulo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Role::className(), ['id' => 'rol_id']);
    }
}
