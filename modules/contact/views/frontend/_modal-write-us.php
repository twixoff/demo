<?php
use yii\bootstrap\Html;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
?>

<?php if(\Yii::$app->session->getFlash('success')) : ?>
    <div class="modal-header">
        <h5 class="modal-title">Письмо отправлено</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg width="17px" height="16px">
                <use xlink:href="#close-svg"></use>
            </svg>
        </button>
    </div>
    <div class="modal-body text-center">
        <img src="/static/i/letter-sended.png" class="img-fluid mb-5" />
        <p class="mb-5">
            Заявка отправлена.<br>
            Менеджер нашей компании свяжется с Вами.
        </p>
        <a href="/" class="btn btn-primary btn-lg btn-skew mb-5"><span>На главную</span></a>
    </div>
<?php else : ?>
    <?php Pjax::begin([
        'id' => 'dynamic-modal-form',
        'enablePushState' => false,
        'options' => ['class' => 'pjax-container']
    ]) ?>
        <div class="modal-header">
            <h5 class="modal-title">Обратная связь</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg width="17px" height="16px">
                    <use xlink:href="#close-svg"></use>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <?php $form = ActiveForm::begin([
                'options' => ['data-pjax' => '1']
            ]) ?>
                <div class="container-fluid">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Как вас зовут?'])->label(false)?>

                            <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Контактный телефон*'])->label(false) ?>

                            <?= $form->field($model, 'email')->textInput(['placeholder' => 'E-mail*'])->label(false) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'message')->textarea(['placeholder' => 'Ваш комментарий'])->label(false) ?>

                            <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::class)->label(false) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <?php $privacyFile = Yii::$app->params['privacy_file']; ?>
                            <?= $form->field($model, 'agree')->checkbox()->label(false)
                                ->label("Отправляя данную форму, я соглашаюсь на <a href='$privacyFile' target='_blank'>обработку персональных данных</a>.") ?>
                        </div>
                        <div class="col-sm-7 text-sm-right">
                            <?= Html::submitButton('<span>Отправить</span>', ['class' => 'btn btn-primary btn-lg btn-skew'])?>
                        </div>
                    </div>
                </div>
            <?php ActiveForm::end() ?>
        </div>
    <?php Pjax::end() ?>
<?php endif; ?>
