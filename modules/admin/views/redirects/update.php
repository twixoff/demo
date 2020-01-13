<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Redirects */

$this->title = 'Обновить редирект: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Таблица редиректов', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование редиректа #' . $model->id;
?>
<div class="redirects-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
