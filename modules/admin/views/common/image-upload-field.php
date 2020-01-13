<?php use yii\helpers\Html; ?>
<div class="form-group field-<?= Html::getInputId($model, $attribute) ?>">
    <label class="control-label" for="<?= Html::getInputId($model, $attribute) ?>"><?= $model->getAttributeLabel($attribute) ?></label>
    <?php if($model->{$attribute}) : ?>
        <div class="thumbnail thumbnail-sm"><img src="<?= $model->getPhoto('big', $attribute) ?>" class="img-responsive"></div>
        <?= isset($canDelete) && $canDelete ? $form->field($model, 'deletePhoto')->checkbox() : ''; ?>
    <?php endif; ?>
    <?= $form->field($model, $attribute)->fileInput()->label(false) ?>
    <?php if(!empty($width) || !empty($height)) : ?>
        <div class="help-block"><?= 'Рекомендуемый размер '.$width.'х'.$height ?></div>
    <?php endif; ?>
</div>
