<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use app\modules\shop\models\Type;
use app\modules\shop\models\Fabric;
use app\modules\shop\models\Category;
?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype'=>'multipart/form-data']
]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-sm-6">
            <?php $fabrics = ArrayHelper::map(Fabric::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title'); ?>
            <?= $form->field($model, 'fabric_id')->dropDownList($fabrics, ['prompt' => 'Укажите фабрику...']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?php $categories = ArrayHelper::map(Category::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title'); ?>
            <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Укажите категорию...']) ?>
        </div>
        <div class="col-sm-6">
            <?php $types = ArrayHelper::map(Type::find()->orderBy(['sort' => SORT_ASC])->all(), 'id', 'title'); ?>
            <?= $form->field($model, 'type_id')->dropDownList($types, ['prompt' => 'Укажите тип...']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $this->render('@app/modules/admin/views/common/image-upload-field', [
                'form' => $form,
                'model' => $model,
                'attribute' => 'image',
                'width' => 270,
                'height' => 270,
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'file')->widget(InputFile::class, [
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

    <?= $form->field($model, 'description')->widget(CKEditor::class,[
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

    <?= $form->field($model, 'info')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'is_publish')->checkbox() ?>

    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>