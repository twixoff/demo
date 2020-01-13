<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;

?>

<div class="config-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php echo $form->errorSummary($model) ?>

    <?php #= $form->field($model, 'param')->textInput(['maxlength' => 128]) ?>
    
    <?= $form->field($model, 'type')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => 255, 'disabled' => true]) ?>

    <?php switch($model->type)  {
        case 'text':
            echo $form->field($model, 'value')->hint($model->hint);
            break;
        case 'dropdown':
            echo $form->field($model, 'value')->dropDownList( Json::decode($model->default) )->hint($model->hint);
            break;
        case 'code-css':
            echo $form->field($model, 'value')->widget('trntv\aceeditor\AceEditor', [
                'id' => 'valueace',
                'mode'=>'css', // programing language mode. Default "html"
                'theme'=>'chrome' // editor theme. Default "github"
            ])->hint($model->hint);
            $this->registerJs("aceeditor_valueace.getSession().setUseWrapMode(true);");
            break;
        case 'code-js':
            echo $form->field($model, 'value')->widget('trntv\aceeditor\AceEditor', [
                'id' => 'valueace',
                'mode'=>'javascript', // programing language mode. Default "html"
                'theme'=>'chrome' // editor theme. Default "github"
            ])->hint($model->hint);
            $this->registerJs("aceeditor_valueace.getSession().setUseWrapMode(true);");
            break;
        case 'file':
            echo $form->field($model, 'value')->widget(InputFile::class, [
                'language'      => 'ru',
//                'path'          => 'content',
                'controller'    => 'elfinder',
                'filter'        => [],  // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                'buttonName'    => 'Обзор',
                'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                'options'       => ['class' => 'form-control', 'readonly' => true],
                'buttonOptions' => ['class' => 'btn btn-default'],
                'multiple'      => false
            ])->hint($model->hint);
            break;        
        case 'fulltext':
            echo $form->field($model, 'value')->widget(CKEditor::className(),[
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
//                    'preset' => 'basic',
                    'height' => 400,
                    'inline' => false, //по умолчанию false
                ])
            ])->hint($model->hint);
            break;
    }
    ?>

    <?php #= $form->field($model, 'type')->dropDownList([ 'text' => 'Text', 'checkbox' => 'Checkbox', 'dropdown' => 'Dropdown', 'fulltext' => 'Fulltext', ], ['prompt' => '']) ?>

    <?php #= $form->field($model, 'default')->textarea(['rows' => 6]) ?>

    <?php #= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
