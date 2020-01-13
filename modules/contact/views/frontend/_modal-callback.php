<?php
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
?>

<?php Pjax::begin([
    'id' => 'dynamic-modal-form',
    'enablePushState' => false,
    'options' => ['class' => 'pjax-container']
]) ?>
    <?php if(\Yii::$app->session->getFlash('success')) : ?>
        <div class="alert alert-success">Ваше сообщение успешно отправлено!</div>
    <?php else : ?>
        <?php $form = ActiveForm::begin([
            'options' => ['data-pjax' => '1']
        ]) ?>
            <div class="form-group clearfix">
                <div class="col-sm-10 col-sm-offset-1">
                    <p class="modal-title">Заказать звонок</p>
                    <?= $form->field($model, 'name')->textInput(['placeholder' => 'Имя'])->label(false)?>
                    <?= $form->field($model, 'phone')->textInput(['placeholder' => '* Телефон'])->label(false) ?>
                </div>
                <div class="col-sm-5 col-sm-offset-1">
                    <?= yii\bootstrap\Html::submitButton('Заказать звонок', ['class' => 'btn btn-primary btn-block'])?>
                </div>
            </div>
        <?php ActiveForm::end() ?>
    <?php endif; ?>
<?php Pjax::end() ?>