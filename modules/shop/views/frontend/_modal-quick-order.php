<?php
use yii\bootstrap\Html;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
?>

<?php if(\Yii::$app->session->getFlash('success')) : ?>
    <div class="modal-header">
        <h5 class="modal-title">Письмо отправлено</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="/static/i/close.svg">
        </button>
    </div>
    <div class="modal-body text-center">
        <p class="mb-5">
            Заявка отправлена.<br>
            Менеджер нашей компании свяжется с Вами.
        </p>
        <button type="button" class="btn btn-outline-primary text-uppercase" data-dismiss="modal">Закрыть</button>
    </div>
<?php else : ?>
    <?php Pjax::begin([
        'id' => 'dynamic-modal-form',
        'enablePushState' => false,
        'options' => ['class' => 'pjax-container']
    ]) ?>
        <div class="modal-header">
            <h5 class="modal-title">Заполните форму ниже</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="/static/i/close.svg">
            </button>
        </div>
        <div class="modal-body">
            <?php $form = ActiveForm::begin([
                'options' => ['data-pjax' => '1']
            ]) ?>
                <?= $form->field($model, 'name')->textInput(['placeholder' => 'Ваше имя'])->label(false)
                ->error() ?>

                <?= $form->field($model, 'email')->textInput(['placeholder' => 'Ваш e-mail'])->label(false) ?>

                <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Ваш телефон'])->label(false) ?>

                <?= $form->field($model, 'product_id')->hiddenInput()->label(false)->error(false) ?>

                <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">Какое количество вас интересует?</div>
                    <?= $form->field($model, 'count')->label(false)->error(false) ?>
                    <div class="mb-3">шт</div>
                </div>

                <?= $form->field($model, 'message')->textarea([
                    'placeholder' => 'Ваш комментарий...', 'rows' => 5
                ])->label(false) ?>

                <div class="d-flex align-items-center">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-outline-primary text-uppercase mr-3'])?>
                    <div>* Все поля обязательны к заполнению</div>
                </div>
            <?php ActiveForm::end() ?>
        </div>
    <?php Pjax::end() ?>
<?php endif; ?>
