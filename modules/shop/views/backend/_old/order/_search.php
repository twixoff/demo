<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\shop\models\Types;
use yii\helpers\ArrayHelper;

?>

<div class="orders-search" style="margin-bottom: 20px;">

    <?php $form = ActiveForm::begin([
        'action' => ['orders'],
        'method' => 'get',
        'layout' => 'inline'
    ]); ?>

    <?php #= $form->field($model, 'id')->label('Заказ #') ?>

    <?php #= $form->field($model, 'fio') ?>

    <?php #= $form->field($model, 'email') ?>
    
    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Types::find()->all(), 'id', 'title'), ['prompt' => 'Все'])->label('Редакция') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'zip') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'isPaid') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'license') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'delivery') ?>

    <?php // echo $form->field($model, 'delivery_price') ?>

    <?php // echo $form->field($model, 'payment_type') ?>

    <?php // echo $form->field($model, 'product_price') ?>

    <?php // echo $form->field($model, 'total_sum') ?>

    <?php // echo $form->field($model, 'payment_sum') ?>

    <?php // echo $form->field($model, 'payment_date') ?>

    <?php // echo $form->field($model, 'payment_gate') ?>

    <?php // echo $form->field($model, 'dCreate') ?>

    <div class="form-group">
        <?= Html::submitButton('Показать', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
