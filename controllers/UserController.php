<?php

namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use app\models\User;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    // restrict access to
                    'Origin' => ['*'],
                    // Allow only POST and PUT methods
                    'Access-Control-Request-Method' => ['POST', 'PUT'],
                    // Allow only headers 'X-Wsse'
                    'Access-Control-Request-Headers' => ['X-Wsse'],
                    // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                    'Access-Control-Allow-Credentials' => true,
                    // Allow OPTIONS caching
                    'Access-Control-Max-Age' => 3600,
                    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
                ],
    
            ],
        ];
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['delete']);
        unset($actions['update']);
        unset($actions['index']);
        unset($actions['view']);
        return $actions;
    }

    public function actionIndex()
    {        
        return User::find()->all();
    }

    public function actionView($id)
    {
        $modelCliente = User::find()->where(['ID' => $id])->one();
        if(empty($modelCliente))
        {
            return ['status' => 0, 'message' => 'Usuario no registrado', 'object' => '404 Not found'];
        }
        return $modelCliente;
    }


    public function actionCreate()
    {
        $modelUser = new User();

        $modelUser->load(Yii::$app->request->post(), '');
        
        $errors = '';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        
        if(!$modelUser->validate())
        {
            return ['status' => 0, 'message' => $modelUser->errors, 'object' => 'Estado: 200, proceso de verificación de datos fallido.'];
        }
        if($modelUser->save())
        {
            return ['status' => 1, 'message' => 'Registro exitoso ¡enhorabuena!', 'object' => 'Estado: 200, éxito.'];
        }
        else
        {
            return ['status' => 0, 'message' => 'Ups.. Pasó algo inesperado.', 'object' => 'Error desconocido'];
        }
    }

    public function actionUpdate($id)
    {
        $modelUser = User::find()->where(['ID' => $id])->one();
        
        if(empty(($modelUser)))
        {
            return ['status' => 0, 'message' => 'No existe el usuario', 'object' => 'No se enconró el usuario, debe registrar primero. Estado: 200'];
        }
        else 
        {   
            $modelUser->attributes = \yii::$app->request->post();
            if($modelUser->update())
            {
                return ['status' => 1, 'message' => 'Actualización exitosa', 'object' => 'Estado: 200, éxito.'];
            }
            else
            {
                return ['status' => 0, 'message' => 'Ups... No es necesario actualizar este dato', 'object' => $modelUser->errors];
            }
        } 
    }
    
    public function actionDelete($id)
    {
        $modelUser = User::find()->where(['ID' => $id])->one();
        
        if(empty(($modelUser)))
        {
            return ['status' => 0, 'message' => 'No existe el usuario', 'object' => 'No se enconró el usuario, debe registrar primero. Estado: 200'];
        }
        else if($modelUser->delete()) 
        {   
            return ['status' => 1, 'message' => 'Borrado exitoso', 'object' => 'Estado: 200, éxito.'];
        } 
        else {
            return ['status' => 0, 'message' => 'Ups.. Pasó algo inesperado.', 'object' => 'Error desconocido'];       
        } 
    }
    
}