<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\shop\models\Orders;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>
<style>.form-group {
    margin-bottom: 10px;
}
.help-block {
    margin-top: 0;
    margin-bottom: 0;    
}</style>
<div class="orders-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal'
    ]); ?>

        <?= $form->field($model, 'dCreate')->textInput(['disabled' => true]) ?>

        <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'delivery')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
    
        <div style="width: 100%; height: 1px; margin-bottom: 15px; border-bottom: 1px solid #afafaf; background: #cecece;"></div>
    
        <?= $form->field($model, 'product_id')->hiddenInput()->label(false) ?>
        <div class="form-group">
            <label class="control-label col-sm-3"><?= $model->getAttributeLabel('product_id') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="<?= $model->typeTitle ?>" disabled="">
            </div>
        </div>        

        <?= $form->field($model, 'license')->textInput(['maxlength' => true]) ?>

        <div style="width: 100%; height: 1px; margin-bottom: 15px; border-bottom: 1px solid #afafaf; background: #cecece;"></div>

        <?= $form->field($model, 'payment_type')->hiddenInput()->label(false) ?>
        <div class="form-group">
            <label class="control-label col-sm-3"><?= $model->getAttributeLabel('payment_type') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="<?= $model->paymentTitle?>" disabled="">
            </div>
        </div>

        <?= $model->payment_type == Orders::$PAYMENT_PAYPAL ? $form->field($model, 'paypal_email')->textInput(['disabled' => 'disable']) : '' ?>

        <?= $form->field($model, 'product_price')->textInput() ?>

        <?= $form->field($model, 'delivery_price')->textInput() ?>

        <?= $form->field($model, 'total_sum')->textInput() ?>

        <?php if($model->payment_type == Orders::$PAYMENT_ROBOKASSA || $model->payment_type == Orders::$PAYMENT_YANDEXKASSA) : ?>
            <?= $form->field($model, 'payment_sum')->textInput() ?>

            <?= $form->field($model, 'payment_date')->textInput() ?>

            <?= $form->field($model, 'payment_gate')->textInput(['maxlength' => true]) ?>
        <?php endif; ?>
        
        <?= $form->field($model, 'isPaid')->checkbox() ?>

        <div style="width: 100%; height: 1px; margin-bottom: 15px; border-bottom: 1px solid #afafaf; background: #cecece;"></div>

        <?= $form->field($model, 'status')->dropDownList(Orders::getStatusList())
                ->hint('При смене статуса, пользователю отправляется информационное сообщение.') ?>

        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
