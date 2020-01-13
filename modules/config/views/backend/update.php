<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Config */

$this->title = 'Обновление переменной: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="config-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
