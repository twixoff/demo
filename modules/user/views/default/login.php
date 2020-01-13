<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Вход';
?>

<?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object"><i class="fa fa-user-secret fa-2x"></i></div>
            <h5 class="content-group-lg">Вход в личный кабинет <small>Введите свои данные</small></h5>
        </div>

        <?= $form->field($model, 'username', ['template' => "{label}\n
            <div class='has-feedback has-feedback-left'>\n
                {input}\n
                <div class='form-control-feedback'><i class='fa fa-user'></i></div>\n
            </div>\n
            {hint}\n{error}\n"])->textInput(['placeholder' => $model->getAttributeLabel('username')])->label(false) ?>

        <?= $form->field($model, 'password', ['template' => "{label}\n
            <div class='has-feedback has-feedback-left'>\n
                {input}\n
                <div class='form-control-feedback'><i class='fa fa-lock'></i></div>\n
            </div>\n
            {hint}\n{error}\n"])->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>

        <div class="form-group login-options">
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'styled']) ?>
                </div>
                <div class="col-sm-6 text-right">
                    <?php /* <a href="<?= Url::to(['/#']) ?>">Забыли пароль?</a> */ ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>

        <?php /*
        <div class="content-divider text-muted form-group"><span>Еще нет аккаунта?</span></div>
        <a href="<?= Url::to(['/signup']) ?>" class="btn btn-success btn-block">Регистрация</a>
        */ ?>
    </div>
<?php ActiveForm::end(); ?>