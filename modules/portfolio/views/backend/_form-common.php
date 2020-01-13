<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii2mod\selectize\Selectize;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use app\modules\shop\models\Serie;
?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype'=>'multipart/form-data']
]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => 255]) ?>

    <?php $series = Serie::find()->orderBy('title')->asArray()->all() ?>
    <?= $form->field($model, 'use_series')->widget(Selectize::class, [
        'pluginOptions' => [
            'persist' => false,
            'valueField' => 'id',
            'labelField' => 'title',
//            'sortField' => 'structure_id',
            'plugins' => ['drag_drop', 'remove_button'],
            'options' => $series
        ]
    ]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $this->render('@app/modules/admin/views/common/image-upload-field', [
                'form' => $form,
                'model' => $model,
                'attribute' => 'image',
                'width' => 945,
                'height' => 525,
            ]) ?>
        </div>
    </div>
    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                'toolbar' => [
                    ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'],
                    ['NumberedList', 'BulletedList'],
                    ['Link', 'Unlink', 'Anchor'],
                    ['Source', 'Maximize'], ['About'],
                ],
                'height' => 400,
                'inline' => false, //по умолчанию false
            ])
    ]); ?>

    <?= $form->field($model, 'is_publish')->checkbox() ?>

    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>