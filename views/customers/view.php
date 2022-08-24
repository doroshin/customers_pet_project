<?php

use app\models\Customers;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customers-view">
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
            'parent_id',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function (Customers $model) {
                    return $model->status == 0 ? 'inactive' : 'active';
                }
            ],
            'description',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'Y-MM-dd HH:mm (P)'],
            ],
            [
                'attribute' => 'modified_at',
                'format' => ['date', 'Y-MM-dd HH:mm (P)'],
            ],
        ],
    ]) ?>

    <?php if ($model->parent_id) { ?>
        <hr/>
        <div class="col-sm-3 mb-3">
            <?= Html::submitButton('See parent data', ['class' => 'btn btn-success', 'id' => 'search_parent_btn']) ?>
        </div>
    <?php } ?>

    <div id='parent_block' class="row"></div>
</div>

<?php
$parent_id = $model->parent_id;
$reveal_js = <<<JS

var parent_id = "$parent_id";

$(document).on('click', '#search_parent_btn', function (e) {
    e.preventDefault();
    
        $.ajax({
        url: '/index.php?r=leads%2Fget-parents-data',
        dataType : 'json',
        type: 'POST',
        data: {id: parent_id},                   
        success: function (data) {
            $('#parent_block').empty();
            var parentTable = '<h5>Lead`s info</h5><table name="oop" class="table table-striped table-bordered">';
            for(var key in data){
                if(key === 'created_at' || key === 'modified_at'){
                    data[key] = new Date(data[key] * 1000).toISOString().slice(0, 10) + ' (timestamp: ' + data[key] + ')';
                } else if(key === 'status'){
                    data[key] = data[key] === '1' ? 'Active' : 'Inactive';
                }
                    parentTable += '<tr><td>' + key + '</td><td>' + data[key] + '</td></tr>';
            }

            $('#parent_block').append(parentTable + '</table>');
        }
    });
});
JS;

$this->registerJs($reveal_js, View::POS_READY);
