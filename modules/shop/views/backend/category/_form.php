<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;

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
                'width' => 770,
                'height' => 410,
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'intro')->widget(CKEditor::class,[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
            'toolbar' => [
                ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'],
                ['NumberedList', 'BulletedList'],
                ['Link', 'Unlink', 'Anchor'],
                ['Source', 'Maximize'], ['About'],
            ],
            'height' => 200,
            'inline' => false, //по умолчанию false
        ])
    ]); ?>

    <?= $form->field($model, 'text')->widget(CKEditor::class,[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
            'toolbar' => [
                ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'],
                ['NumberedList', 'BulletedList'],
                ['Link', 'Unlink', 'Anchor'],
                ['Source', 'Maximize'], ['About'],
            ],
            'height' => 200,
            'inline' => false, //по умолчанию false
        ])
    ]); ?>

    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>