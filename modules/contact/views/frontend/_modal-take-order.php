<?php
use yii\bootstrap\Html;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
?>

<?php if(\Yii::$app->session->getFlash('success')) : ?>
    <div class="modal-header">
        <h5 class="modal-title">Заявка принята!</h5>
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
        <?php $this->registerJs("window.location.hash = 'sended-Ok';") ?>
    </div>
<?php else : ?>
    <?php Pjax::begin([
        'id' => 'dynamic-modal-form',
        'enablePushState' => false,
        'options' => ['class' => 'pjax-container']
    ]) ?>
        <div class="modal-header">
            <h5 class="modal-title">Заявка на заказ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg width="17px" height="16px">
                    <use xlink:href="#close-svg"></use>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'form-order', 'enctype'=>'multipart/form-data', 'data-pjax' => '1']
            ]) ?>
                <div class="container-fluid">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <?php $fieldTitle = $model->getAttributeLabel('company') . ($model->isAttributeRequired('company') ? '*' : '')?>
                            <?= $form->field($model, 'company')->textInput(['placeholder' => $fieldTitle])->label(false) ?>

                            <?php $fieldTitle = $model->getAttributeLabel('phone') . ($model->isAttributeRequired('phone') ? '*' : '')?>
                            <?= $form->field($model, 'phone')->textInput(['placeholder' => $fieldTitle])->label(false) ?>

                            <?php $fieldTitle = $model->getAttributeLabel('email') . ($model->isAttributeRequired('email') ? '*' : '')?>
                            <?= $form->field($model, 'email')->textInput(['placeholder' => $fieldTitle])->label(false) ?>

                            <?php $fieldTitle = $model->getAttributeLabel('comment') . ($model->isAttributeRequired('comment') ? '*' : '')?>
                            <?= $form->field($model, 'comment')->textarea(['placeholder' => $fieldTitle])->label(false) ?>

                            <?php #$fieldTitle = $model->getAttributeLabel('name') . ($model->isAttributeRequired('name') ? '*' : '')?>
                            <?php #= $form->field($model, 'name')->textInput(['placeholder' => $fieldTitle])->label(false) ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="order-application form-group">
                                <img src="/static/i/file-text.png" class="float-left" />
                                <div class="input-wrap float-left">
                                    <?= \yii\helpers\Html::activeFileInput($model, 'file') ?>
                                    <div class="file-name">Файл не выбран</div>
                                    <div class="file-link">Прикрепить файл</div>
                                </div>
                            </div>

                            <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::class)->label(false) ?>

                            <?php $privacyFile = Yii::$app->params['privacy_file']; ?>
                            <?= $form->field($model, 'agree')->checkbox()->label("Отправляя данную форму, я соглашаюсь на <a href='$privacyFile' target='_blank'>обработку персональных данных</a>.") ?>

                            <?= Html::submitButton('<span>Отправить</span>', ['class' => 'btn btn-primary btn-lg btn-skew float-sm-right'])?>
                        </div>
                    </div>
                </div>
            <?php ActiveForm::end() ?>
        </div>
    <?php Pjax::end() ?>
<?php endif; ?>
