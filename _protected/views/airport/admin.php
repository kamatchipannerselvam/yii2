<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Airports');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-admin">

    <h1>

    <?= Html::encode($this->title) ?>

    <span class="pull-right">
        <?= Html::a(Yii::t('app', 'Create Airport'), ['create'], ['class' => 'btn btn-success']) ?>
    </span>  

    </h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'airport_code',
                'value' => function ($data) {
                    return $data->airport_code;
                },
            ],
            [
                'attribute'=>'airport_name',
                'value' => function ($data) {
                    return $data->airport_name;
                },
            ],
            [
                'attribute'=>'country',
                'value' => function ($data) {
                    return $data->country;
                },
            ],
            [
                'attribute'=>'city',
                'value' => function ($data) {
                    return $data->city;
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('app', 'Menu')],
        ],
    ]); ?>

</div>
