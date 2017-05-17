<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;


$this->title = 'Image uploader';
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>






    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Upload panel</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                    <?= $form->field($model, 'filepath')->fileInput()->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Upload', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <?php
        foreach ($image as $model) {
        ?>
        <div style="margin-bottom: 50px;display: table-cell;vertical-align: middle;text-align: center;" class="col-lg-12">
                <div class="col-lg-6">
                    <?php
                    echo Html::img('@web/uploads/'.$model->filepath,['style' => 'height: 400px;width:100%;transform:rotate('.$model->angle.'deg)'])
                    ?>
                </div>
                <div style="height: 400px;display: table;vertical-align: middle;" class="col-lg-3">
                    <?php $angleForm = ActiveForm::begin(['options' => ['style' => 'display: table-cell;vertical-align: middle;'],'action' =>['image/angle'], 'id' => 'rotate', 'method' => 'post']); ?>
                    <?php
                        //if angle == 360 -> reset angle counter
                        if($model->angle == 360 || $model->angle > 360) {
                            $newAngle = 0;
                        } else {
                            $newAngle = $model->angle+20;
                        }
                    ?>
                    <?= $angleForm->field($model, 'id')->hiddenInput(['value'=> $model->id])->label(false); ?>
                    <?= $angleForm->field($model, 'angle')->hiddenInput(['value'=> $newAngle])->label(false); ?>

                    <div class="form-group">
                        <?= Html::submitButton('Rotate', ['class' => 'btn btn-primary  btn-lg', 'name' => 'rotate']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
                <div style="height: 400px;display: table;vertical-align: middle;" class="col-lg-3">
                    <?php $deleteForm = ActiveForm::begin(['options' => ['style' => 'display: table-cell;vertical-align: middle;'],'action' =>['image/delete'], 'id' => 'delete', 'method' => 'post']); ?>
                    <?= $deleteForm->field($model, 'id')->hiddenInput(['value'=> $model->id])->label(false); ?>
                    <div class="form-group">
                        <?= Html::submitButton('Delete', ['class' => 'btn btn-danger  btn-lg', 'name' => 'delete']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
        </div>
            <?php
        }
        ?>
    </div>
</div>