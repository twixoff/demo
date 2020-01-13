<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Redirects */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Таблица редиректов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redirects-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
