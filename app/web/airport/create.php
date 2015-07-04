<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Airports */

$this->title = 'Create Airports';
$this->params['breadcrumbs'][] = ['label' => 'Airports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airports-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
