<?php

use app\components\Helper;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'second_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone')
                ->textInput(['maxlength' => true, 'placeholder' => 'e.g. +380991231221, 64211685461'])
                ->hint('You can enter a multiple phone numbers separated by comma and space.') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')
                ->textInput(['maxlength' => true, 'placeholder' => 'e.g. user1@nomail.com, user2@monail.com'])
                ->hint('You can enter a multiple email separated by comma and space.') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->widget(Select2::class, ['data' => Helper::customersStatuses()]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="form-group col-md-12">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
