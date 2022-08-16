<?php

use app\models\Leads;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LeadsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leads-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Lead', ['create'], ['class' => 'btn btn-success']) ?>
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
//            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:60px'],
            ],
            [
                'attribute' => 'first_name',
                'filterInputOptions' => [
                    'placeholder' => 'Search for First Name...',
                    'class' => 'form-control'
                ]
            ],
            [
                'attribute' => 'second_name',
                'filterInputOptions' => [
                    'placeholder' => 'Search for Second Name...',
                    'class' => 'form-control'
                ]
            ],
            [
                'attribute' => 'phone',
                'filterInputOptions' => [
                    'placeholder' => 'Search for Phone...',
                    'class' => 'form-control'
                ]
            ],
            [
                'attribute' => 'address',
                'filterInputOptions' => [
                    'placeholder' => 'Search for Address...',
                    'class' => 'form-control'
                ]
            ],
            [
                'attribute' => 'email',
                'filterInputOptions' => [
                    'placeholder' => 'Search for Email...',
                    'class' => 'form-control'
                ]
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filterInputOptions' => [
                    'placeholder' => 'Search for Status...',
                    'class' => 'form-control'
                ],
                'value' => function (Leads $model) {
                    return $model->status == 0 ? 'inactive' : 'active';
                }
            ],
            [
                'attribute' => 'description',
                'filterInputOptions' => [
                    'placeholder' => 'Search for Description...',
                    'class' => 'form-control'
                ]
            ],
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
                'urlCreator' => function ($action, Leads $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
