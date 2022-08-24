<?php

use app\models\Leads;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Leads */

$this->title = $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Leads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="leads-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Convert', ['convert-to-customer', 'id' => $model->id], ['class' => 'btn btn-primary float-right']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'second_name',
            'phone',
            'address',
            'email:email',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function (Leads $model) {
                    return $model->status == 0 ? 'inactive' : 'active';
                }
            ],
            'description',
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm (P)'],
            ],
            [
                'attribute' => 'modified_at',
                'format' =>  ['date', 'Y-MM-dd HH:mm (P)'],
            ],
        ],
    ]) ?>

</div>
