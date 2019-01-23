<?php
namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use app\models\Permission;

class PermissionController extends ActiveController
{
    public $modelClass = 'app\models\Permission';
}