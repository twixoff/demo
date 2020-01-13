<?php

use app\components\Page;
use yii\bootstrap\ActiveForm;
use app\modules\config\models\Config;

$this->title = Page::getTitle();
$phone = Config::get('site.phone');
$igLink = Config::get('social.ig');
$fbLink = Config::get('social.fb');

?>

<div class="page-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-5 bg-gray pt-5 pb-5">
                <div class="d-flex align-items-center contact-field">
                    <div class="icon"><img src="/static/i/ico-marker.svg"></div>
                    <p>Республика Казахстан, г. Алматы<br> мкр. Самал-1, 4, уг. ул. Жолдасбекова</p>
                </div>
                <div class="d-flex align-items-start contact-field">
                    <div class="icon"><img src="/static/i/ico-mobile.svg"></div>
                    <p><a href="tel:<?= str_replace(['+',' ','(',')','-'], '', $phone) ?>"><?= $phone ?></a></p>
                </div>
                <div class="d-flex align-items-center contact-field">
                    <div class="icon"><img src="/static/i/ico-email.svg"></div>
                    <p><a href="mailto:info@unionlight.kz">info@unionlight.kz</a></p>
                </div>
                <div class="d-flex align-items-center contact-field mb-5">
                    <div class="icon"><img src="/static/i/ico-clock.svg"></div>
                    <p>Понедельник - Пятница<br> с 09:00 до 18:00</p>
                </div>
                <div>
                    <?php if($igLink) : ?>
                        <a href="<?= $igLink ?>" class="d-inline-block mr-4" target="_blank"><?= @file_get_contents('./static/i/ico-ig.svg') ?></a>
                    <?php endif; ?>
                    <?php if($fbLink) : ?>
                        <a href="<?= $fbLink ?>" class="inline-block" target="_blank"><?= @file_get_contents('./static/i/ico-fb.svg') ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="offset-md-1 col-md-6 pt-5 pb-4 pb-sm-5">
                <h3>Если у вас есть вопросы</h3>
                <?php if(Yii::$app->session->hasFlash('contactFormSubmitted')) : ?>
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <strong>Ваше сообщение успешно отправлено!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php $form = ActiveForm::begin([
                    'fieldConfig' => [
                        'errorOptions' => ['class' => 'form-text invalid-feedback'],
                        'enableLabel' => false,
                    ],
                ]) ?>
                <?= $form->field($model, 'name')->textInput(['placeholder' => $model->getAttributeLabel('name')]) ?>

                <?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

                <?= $form->field($model, 'body')->textarea(['placeholder' => $model->getAttributeLabel('body'), 'rows' => 8])?>
                <div class="d-flex align-items-end flex-wrap">
                    <button type="submit" class="btn btn-outline-primary text-uppercase mr-auto mb-2 mb-lg-0">Отправить</button>
                    <div class="form-text">*Все поля обязательны для заполнения</div>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
<div id="contact-map" class="contact-map"></div>

<?php $this->registerJsFile('//maps.googleapis.com/maps/api/js?callback=initMap', [
    'depends' => 'app\assets\AppAsset'
]) ?>
