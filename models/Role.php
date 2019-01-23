<?php

namespace app\models;

use Yii;
use yii\rbac\Permission;

/**
 * This is the model class for table "rol".
 *
 * @property int $id
 * @property string $nombre
 * @property string $nivel
 * @property int $estado
 *
 * @property Permiso[] $permisos
 * @property Usuario[] $usuarios
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'nivel', 'estado'], 'required'],
            [['estado'], 'integer'],
            [['nombre', 'nivel'], 'string', 'max' => 45],
            
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
            'nivel' => 'Nivel',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermisos()
    {
        return $this->hasMany(Permission::className(), ['rol_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(User::className(), ['rol_id' => 'id']);
    }
}
