<?php
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use app\modules\infoblocks\models\InfoBlockCard;
?>

<?php $form = ActiveForm::begin(['action' => ['card-update', 'id' => $model->id], 'options' => ['enctype'=>'multipart/form-data']]) ?>
    <?= Html::activeHiddenInput($model, 'block_id', ['value' => $model->block_id]) ?>
    <?= $form->field($model, 'type_id')->inline()->radioList([
        InfoBlockCard::TYPE_CARD => 'Услуга', InfoBlockCard::TYPE_CONTACT => 'Контакт'
    ])->label(false) ?>
    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'link')->hint('Для блока типа «Услуга»') ?>
    <?= $form->field($model, 'phone')->hint('Для блока типа «Контакт»') ?>
    <?= $form->field($model, 'email')->hint('Для блока типа «Контакт»') ?>

    <?php if($model->image) {
        echo Html::img($model->getPhoto('thumb'));
    } ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    <button type="submit" class="btn btn-primary">Сохранить</button>
<?php ActiveForm::end() ?>