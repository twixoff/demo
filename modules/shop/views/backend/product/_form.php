<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $this->render('@app/modules/admin/views/common/image-upload-field', [
                'form' => $form,
                'model' => $model,
                'attribute' => 'image',
                'width' => 330,
                'height' => 0,
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'content')->textarea(['rows' => 5]) ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'price') ?>
        </div>
    </div>

    <?= $form->field($model, 'is_publish')->checkbox() ?>

    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>