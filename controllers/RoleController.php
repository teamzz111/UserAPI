<?php
namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use app\models\Role;

class RoleController extends ActiveController
{
    public $modelClass = 'app\models\Role';
}