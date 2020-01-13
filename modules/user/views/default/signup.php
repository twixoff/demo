<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
?>

<?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-success text-success"><i class="fa fa-user"></i></div>
            <h5 class="content-group-lg">Создать аккаунт <small class="display-block">Все поля обязательны для заполнения</small></h5>
        </div>
    
        <?= $form->field($model, 'email', ['template' => "{label}\n
                <div class='has-feedback has-feedback-left'>\n
                    {input}\n
                    <div class='form-control-feedback'><i class='icon-mention text-muted'></i></div>\n
                </div>\n
                {hint}\n{error}\n"])->textInput(['placeholder' => $model->getAttributeLabel('email')])->label(false) ?>
    
        <?= $form->field($model, 'password', ['template' => "{label}\n
                <div class='has-feedback has-feedback-left'>\n
                    {input}\n
                    <div class='form-control-feedback'><i class='icon-user-lock text-muted'></i></div>\n
                </div>\n
                {hint}\n{error}\n"])->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>

        <?= $form->field($model, 'password_repeat', ['template' => "{label}\n
                <div class='has-feedback has-feedback-left'>\n
                    {input}\n
                    <div class='form-control-feedback'><i class='icon-user-lock text-muted'></i></div>\n
                </div>\n
                {hint}\n{error}\n"])->passwordInput(['placeholder' => $model->getAttributeLabel('password_repeat')])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Регистрация <i class="icon-circle-right2 position-right"></i>', ['class' => 'btn bg-blue btn-block', 'name' => 'login-button']) ?>
        </div>

        <div class="content-divider text-muted form-group"><span>Уже зарегистрированы?</span></div>
        <a href="<?= Url::to(['/login']) ?>" class="btn bg-slate btn-block content-group">Войти</a>
        <?php /* <span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span> */ ?>
    </div>
<?php ActiveForm::end(); ?>