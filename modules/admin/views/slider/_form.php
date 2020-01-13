<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if($model->category == 'fabric') : ?>
        <?= $this->render('@app/modules/admin/views/common/image-upload-field', [
            'form' => $form,
            'model' => $model,
            'attribute' => 'image_logo',
        ]) ?>

        <?= $form->field($model, 'descr')->textInput(['maxlength' => true]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $this->render('@app/modules/admin/views/common/image-upload-field', [
        'form' => $form,
        'model' => $model,
        'attribute' => 'image',
    ]) ?>

    <?= $form->field($model, 'is_publish')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
