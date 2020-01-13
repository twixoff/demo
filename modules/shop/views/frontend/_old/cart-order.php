<?php
use yii\bootstrap\ActiveForm;
use app\modules\admin\models\Structure;

$this->title = 'Оформление заказа';
$cart = Structure::find()->where(['type_id' => 62])->one();
$cartUrl = $cart ? $cart->getUrl() : null;
?>

<div class="header-wrap">
    <div class="container d-flex justify-content-between">
        <h1 class="page-header"><?= $this->title ?></h1>
        <ul class="cart-steps pt-2">
            <li class="btn-skew"></li>
            <?php if(Yii::$app->session->getFlash('success') !== true) : ?>
                <li class="active btn-skew"></li>
                <li class="btn-skew"></li>
            <?php else : ?>
                <li class="btn-skew"></li>
                <li class="active btn-skew"></li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<div class="container">
    <?php if(Yii::$app->session->getFlash('success') !== true) : ?>
        <?php if(! Yii::$app->cart->getPositions()) : ?>
            <div class="alert alert-warning text-center">
                <b>Ваша корзина пуста.</b>
            </div>
        <?php else : ?>
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'form-order', 'enctype'=>'multipart/form-data']
            ]); ?>

                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <?php $fieldTitle = $model->getAttributeLabel('company') . ($model->isAttributeRequired('company') ? '*' : '')?>
                        <?= $form->field($model, 'company')->textInput(['placeholder' => $fieldTitle])->label(false) ?>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <?php $fieldTitle = $model->getAttributeLabel('name') . ($model->isAttributeRequired('name') ? '*' : '')?>
                        <?= $form->field($model, 'name')->textInput(['placeholder' => $fieldTitle])->label(false) ?>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <?php $fieldTitle = $model->getAttributeLabel('phone') . ($model->isAttributeRequired('phone') ? '*' : '')?>
                        <?= $form->field($model, 'phone')->textInput(['placeholder' => $fieldTitle])->label(false) ?>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <?php $fieldTitle = $model->getAttributeLabel('phone_local') . ($model->isAttributeRequired('phone_local') ? '*' : '')?>
                        <?= $form->field($model, 'phone_local')->textInput(['placeholder' => $fieldTitle])->label(false) ?>

                        <?php $fieldTitle = $model->getAttributeLabel('email') . ($model->isAttributeRequired('email') ? '*' : '')?>
                        <?= $form->field($model, 'email')->textInput(['placeholder' => $fieldTitle])->label(false) ?>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <?php $fieldTitle = $model->getAttributeLabel('comment') . ($model->isAttributeRequired('comment') ? '*' : '')?>
                        <?= $form->field($model, 'comment')->textarea(['placeholder' => $fieldTitle])->label(false) ?>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group order-application">
                            <img src="/static/i/file-text.png" class="float-left" />
                            <div class="input-wrap float-left">
                                <?= \yii\helpers\Html::activeFileInput($model, 'file') ?>
                                <div class="file-name">Файл не выбран</div>
                                <div class="file-link">Прикрепить файл</div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $privacyFile = Yii::$app->params['privacy_file']; ?>
                <?= $form->field($model, 'agree')->checkbox()->label("Отправляя данную форму, я соглашаюсь на <a href='$privacyFile' target='_blank'>обработку персональных данных</a>.") ?>

                <div class="text-right">
                    <div class="read-next-link d-inline mr-4">
                        <a href="<?= $cartUrl ?>" class="btn btn-link"><i class="fas fa-chevron-left"></i> Назад</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-skew"><span>Отправить</span></button>
                </div>
            <?php ActiveForm::end() ?>
        <?php endif; ?>
    <?php else : ?>
        <div class="text-center">
            <img src="/static/i/order-success.png" class="img-fluid mb-sm-5" />

            <p class="mb-5">
                Ваш заказ <span style="color: var(--link-color)">№<?= Yii::$app->session->getFlash('order') ?></span> принят в работу!<br>
                Cчет отправлен на e-mail, наш менеджер скоро свяжется с Вами.</p>

            <a href="/" class="btn btn-primary btn-lg btn-skew mr-5"><span>На главную</span></a>
            <a href="#" class="btn btn-success btn-lg btn-skew" data-modal-url="/write-us"><span>Написать нам</span></a>
        </div>
    <?php endif; ?>
</div>