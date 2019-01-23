<?php
namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use app\models\Module;

class ModuleController extends ActiveController
{
    public $modelClass = 'app\models\Module';
}