<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Airports */

$this->title = Yii::t('app', 'Create Airports');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Airports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-lg-8 well bs-component">

        <?= $this->render('_form', ['model' => $model]) ?>

    </div>

