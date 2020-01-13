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
                'attribute' => 'logo',
                'width' => 370,
                'height' => ''
            ]) ?>

            <?= $this->render('@app/modules/admin/views/common/image-upload-field', [
                'form' => $form,
                'model' => $model,
                'attribute' => 'logo_menu',
                'width' => 210,
                'height' => 50
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $this->render('@app/modules/admin/views/common/image-upload-field', [
                'form' => $form,
                'model' => $model,
                'attribute' => 'cover',
                'width' => 770,
                'height' => 410,
            ]) ?>
        </div>
    </div>

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

    <?= $form->field($model, 'description')->widget(CKEditor::class,[
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

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'catalog')->widget(InputFile::class, [
                'language'      => 'ru',
                'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
                'buttonName'    => 'Обзор',
//                'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                'options'       => ['class' => 'form-control', 'readonly' => true],
                'buttonOptions' => ['class' => 'btn btn-default'],
                'multiple'      => false       // возможность выбора нескольких файлов
            ]); ?>
        </div>
    </div>

    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>