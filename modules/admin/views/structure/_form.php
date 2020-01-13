<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Structure;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php echo $form->errorSummary($model) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?php #= $form->field($model, 'keywords')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'slug', ['template' => "{label}\n
                <div class='input-group'>\n
                    <span class='input-group-addon'>/</span>\n
                    {input}\n
                </div>{hint}{error}"])->textInput(['maxlength' => 255, 'disabled' => $model->id === 1 ? true : false]) ?>


    <?php if ($model->id == 1) : ?>
        <?= $form->field($model, 'parent_id')->dropDownList(['0' => 'Корневой раздел'], ['disabled' => true]) ?>
    <?php else : ?>
        <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Structure::getTreeFloat(null, true, "-"), 'id', 'name'), ['prompt' => '']) ?>
    <?php endif; ?>

    <?= $form->field($model, 'type_id')->dropDownList(Structure::getTypes($model->id == 1 ? [] : [1]), ['prompt' => '', 'disabled' => $model->id == 1 ? true : false]) ?>

    <?= $form->field($model, 'is_publish')->checkbox() ?>

    <?= $form->field($model, 'isLock')->checkbox() ?>

    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>