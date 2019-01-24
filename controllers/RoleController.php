<?php
namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use app\models\Role;

class RoleController extends ActiveController
{
    public $modelClass = 'app\models\Role';

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
        return Role::find()->all();
    }

    public function actionView($id)
    {
        $modelRole = Role::find()->where(['ID' => $id])->one();
        
        if(empty($modelRole))
        {
            return ['status' => 0, 'message' => 'Rol no registrado', 'object' => '404 Not found'];
        }
        return $modelRole;
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

    public function actionUpdate($id)
    {
        $modelRole = Role::find()->where(['ID' => $id])->one();
        
        if(empty(($modelRole)))
        {
            return ['status' => 0, 'message' => 'No existe el usuario', 'object' => 'No se enconró el usuario, debe registrar primero. Estado: 200'];
        }
        else 
        {   
            $modelRole->attributes = \yii::$app->request->post();
            if($modelRole->update())
            {
                return ['status' => 1, 'message' => 'Actualización exitosa', 'object' => 'Estado: 200, éxito.'];
            }
            else
            {
                return ['status' => 0, 'message' => 'Ups.. Pasó algo inesperado.', 'object' => 'Error desconocido'];
            }
        } 
    }
    
    public function actionDelete($id)
    {
        $modelRole = Role::find()->where(['ID' => $id])->one();
        
        if(empty(($modelRole)))
        {
            return ['status' => 0, 'message' => 'No existe el rol', 'object' => 'No se enconró el usuario, debe registrar primero. Estado: 200'];
        }
        else if($modelRole->delete()) 
        {   
            return ['status' => 1, 'message' => 'Borrado exitoso', 'object' => 'Estado: 200, éxito.'];
        } 
        else {
            return ['status' => 0, 'message' => 'Ups.. Pasó algo inesperado.', 'object' => 'Error desconocido'];       
        } 
    }
}