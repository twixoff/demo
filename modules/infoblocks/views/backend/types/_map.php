<?php
use app\modules\infoblocks\assets\MapAsset;
?>
<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

<div class="field-map-wrap">
    <?php if($model->type == 'map') : ?>
        <?php if($model->content) foreach($model->content as $k=>$map) : ?>
            <div class="map-item-wrap">
                <?= $form->field($model, 'content['.$k.'][coords]')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'content['.$k.'][title]')->textInput()->label('Заголовок карты') ?>
                <div class="form-group">
                    <div id="map-<?= $k ?>" class="map-area" style="width: 100%; height: 400px;" data-field-id="<?= $k ?>" data-coords="[<?= $map['coords'] ? $map['coords'] : '43.244402,76.919544' ?>]"></div>
                </div>
                <a href="#" class="btn btn-info remove-map pull-right" style="position: relative;top: -49px;"><i class="fa fa-minus"></i> Удалить карту</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="form-group">
        <a href="#" class="btn btn-info add-map"><i class="fa fa-plus"></i> Добавить еще карту</a>
    </div>
</div>

<?php MapAsset::register($this); ?>
<?php $this->registerJs('initMap();') ?>