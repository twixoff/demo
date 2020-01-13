<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

?>

<div class="info-blocks-form">

    <?php $form = ActiveForm::begin(); ?>

        <?php if($model->type == 'cards') : ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'content')->widget(CKEditor::className(),[
                'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                    'toolbar' => [
                        ['Source'],
                        ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'],
                        ['PasteText', 'PasteFromWord', '-', 'Link', 'Unlink', 'Anchor'],
                        ['Maximize', 'ShowBlocks'],
                        ['About'],
                        '/',
                        '/',
                        ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'],
                        ['Format', 'Font', 'FontSize'],
                        ['TextColor', 'BGColor'],
                        ['Image', 'Table', 'HorizontalRule',  'Iframe']
                    ],
                    'height' => 200,
                    'extraAllowedContent' => 'a[data-modal-url]',
                    'inline' => false, //по умолчанию false
                ]),
            ]) ?>
        <?php else : ?>
            <?= $this->render('types/_' . Yii::$app->getRequest()->get('type', $model->type), [
                'form' => $form,
                'model'=> $model
            ]) ?>
        <?php endif; ?>

        <?= $form->field($model, 'is_publish')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    <?php if($model->type == 'cards') : ?>
        <?= $this->render('types/_' . Yii::$app->getRequest()->get('type', $model->type), [
            'form' => $form,
            'model'=> $model,
            'dataProviderCards' => isset($dataProviderCards) ? $dataProviderCards : null
        ]) ?>
    <?php endif; ?>
</div>