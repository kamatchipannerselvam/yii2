<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Airportdetails */

$this->title = 'Create Airportdetails';
$this->params['breadcrumbs'][] = ['label' => 'Airportdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airportdetails-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
