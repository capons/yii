<?php
namespace frontend\controllers;

use common\models\Image;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


class ImageController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
              //  'only' => ['create', 'update'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }



    public function actionIndex()
    {
        //Yii::$app->user->identity;//
        $user = Yii::$app->user->identity;;
        $ua = new Image();
        $ua->filepath = 'City';
        $user->link('images', $ua);


        /*
         * display
        echo '<pre>';
        $user = User::findOne(1);
        print_r($user->images);
        echo '</pre>';
        */




       // return $this->render('index');
        return 'Hello World';
    }

    public function actionHello()
    {
        return 'Hello World';
    }
}