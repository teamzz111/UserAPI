<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $tipo_doc
 * @property string $nro_doc
 * @property string $email
 * @property string $telefono
 * @property string $direccion
 * @property string $usuario
 * @property string $clave
 * @property string $estado
 * @property int $rol_id
 *
 * @property Rol $rol
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'tipo_doc', 'nro_doc', 'email', 'telefono', 'direccion', 'usuario', 'clave', 'estado', 'rol_id'], 'required',  "message" => "Campo {attribute} no puede estar vacío."],
            [['rol_id'], 'integer'],
            [['nombres', 'apellidos', 'tipo_doc', 'nro_doc', 'email', 'telefono', 'direccion', 'usuario', 'clave', 'estado'], 'string', 'max' => 45,  "message" => "Campo {attribute} sobrepasó el límite esperado"],
            [['email'], 'unique'],
            [['nro_doc'], 'unique'],
            [['usuario'], 'unique'],
            [['rol_id'], 'exist', 'message' => 'No existe el rol', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['rol_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'tipo_doc' => 'Tipo Doc',
            'nro_doc' => 'Nro Doc',
            'email' => 'Email',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'usuario' => 'Usuario',
            'clave' => 'Clave',
            'estado' => 'Estado',
            'rol_id' => 'Rol ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Role::className(), ['id' => 'rol_id']);
    }
}
