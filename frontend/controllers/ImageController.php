<?php
namespace frontend\controllers;

use common\models\Image;
use common\models\User;
use frontend\models\ImageAngle;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\UploadImage;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\helpers\Url;

class ImageController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
    //default page
    public function actionIndex()
    {
        $model = new UploadImage();
        if ($model->load(Yii::$app->request->post())) {
            $model->filepath = UploadedFile::getInstance($model, 'filepath');
            if ($user = $model->upload()) {

            }
        }

        $query = Image::find()->where(['user_id' => Yii::$app->user->identity->getId()]);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                ]
            ],
        ]);

        $image = $provider->getModels();
        return $this->render('image', [
            'model' => $model,
            'image' => $image,
        ]);
    }
    //change image angle
    public function actionAngle()
    {
        $model = new UploadImage();
        if (Yii::$app->request->isPost) {
            $param = Yii::$app->request->post();
            if ($image = $model->changeAngle($param)) {
                return Yii::$app->response->redirect(Url::to(['/image', ]));
            }
        } else {
            return Yii::$app->response->redirect(Url::to(['/image', ]));
        }

    }
    //delete image
    public function actionDelete()
    {
        $model = new UploadImage();
        if (Yii::$app->request->isPost) {
            $param = Yii::$app->request->post();
            if ($image = $model->changeAngle($param)) {
                return Yii::$app->response->redirect(Url::to(['/image', ]));
            }
        } else {
            return Yii::$app->response->redirect(Url::to(['/image', ]));
        }
    }
}