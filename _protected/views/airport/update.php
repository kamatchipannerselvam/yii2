<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Airports */

$this->title = 'Update Airports: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Airports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="airports-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-lg-8 well bs-component">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>

</div>
