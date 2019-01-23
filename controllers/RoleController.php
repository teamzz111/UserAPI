<?php
namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use app\models\Role;

class RoleController extends ActiveController
{
    public $modelClass = 'app\models\Role';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['delete']);
        unset($actions['update']);
        return $actions;
    }

    public function actionCreate()
    {
        $modelRole = new Role();

        $modelRole->load(Yii::$app->request->post(), '');
        
        $errors = '';
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        if(!$modelRole->validate())
        {
            return ['status' => 0, 'message' => $modelRole->errors, 'object' => 'Estado: 200, proceso de verificación de datos fallido.'];
        }
        if($modelRole->save())
        {
            return ['status' => 1, 'message' => 'Registro exitoso ¡enhorabuena!', 'object' => 'Estado: 200, éxito.'];
        }
        else
        {
            return ['status' => 0, 'message' => 'Ups.. Pasó algo inesperado.', 'object' => 'Error desconocido'];
        }
    }
}