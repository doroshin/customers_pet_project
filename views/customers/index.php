<?php

use app\models\Customers;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Customers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $ranges = [
        Yii::t('app', "Today") => ["moment().startOf('day')", "moment().startOf('day').add({days:1})"],
        Yii::t('app', "Yesterday") => ["moment().startOf('day').subtract(1,'days')", "moment().startOf('day')"],
        Yii::t('app', "Last {n} Days", ['n' => 7]) => ["moment().startOf('day').subtract(6, 'days')", "moment().startOf('day').add({days:1})"],
        Yii::t('app', "Last {n} Days", ['n' => 14]) => ["moment().startOf('day').subtract(13, 'days')", "moment().startOf('day').add({days:1})"],
        Yii::t('app', "This Month") => ["moment().startOf('month')", "moment().startOf('month').add({month:1})"],
        Yii::t('app', "Last Month") => ["moment().subtract({month:1}).startOf('day')", "moment().startOf('day').add({days:1})"],
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'second_name',
            'phone',
            'address',
            'email:email',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filterInputOptions' => [
                    'placeholder' => 'Search for...',
                    'class' => 'form-control'
                ],
                'value' => function (Customers $model) {
                    return $model->status == 0 ? 'inactive' : 'active';
                }
            ],
            'parent_id',
            'description',
            [
                'attribute' => 'created',
                'format' =>  ['date', 'Y-MM-dd HH:mm (P)'],
                'headerOptions' => ['style' => 'width:150px'],
                'filter'=>DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created',
                    'convertFormat' => true,
                    'options' => [
                        'placeholder' => 'Click to search...',
                        'class' => 'form-control'
                    ],
                    'pluginOptions' => [
                        'ranges' => $ranges,
                        'opens' => 'left',
                        'locale' => [
                            'format' => 'Y-m-d',
                        ]
                    ]
                ])
            ],
            [
                'attribute' => 'modified',
                'format' =>  ['date', 'Y-MM-dd HH:mm (P)'],
                'headerOptions' => ['style' => 'width:150px'],
                'filter'=>DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'modified',
                    'convertFormat' => true,
                    'options' => [
                        'placeholder' => 'Click to search...',
                        'class' => 'form-control'
                    ],
                    'pluginOptions' => [
                        'ranges' => $ranges,
                        'opens' => 'left',
                        'locale' => [
                            'format' => 'Y-m-d',
                        ]
                    ]
                ])
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Customers $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
