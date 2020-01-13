<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

<div id="map" style="width: 100%; height: 400px;" data-coord="[<?= $model->map ? $model->map : '59.939095,30.315868' ?>]"></div>
<?= $form->field($model, 'map')->hiddenInput()->label(false) ?>

<?php $this->registerJs("initMap();", yii\web\View::POS_END); ?>