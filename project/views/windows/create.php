<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Window */

$this->title = 'Create Windows';
$this->params['breadcrumbs'][] = ['label' => 'Windows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="windows-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
