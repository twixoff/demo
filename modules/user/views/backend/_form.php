<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$isNew = $this->context->action->id == 'create';

?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['disabled' => !$isNew]) ?>
    
    <?= $form->field($model, 'email') ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($isNew ? 'Создать' : 'Сохранить', ['class' => $isNew ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>