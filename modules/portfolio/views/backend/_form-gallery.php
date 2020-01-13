<?php
use yii\widgets\Pjax;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\JuiAsset;

JuiAsset::register($this);
?>

<?php Pjax::begin(['enablePushState' => false, 'clientOptions' => ['type' => 'post'],
    'options' => [
        'class' => 'gallery-widget',
        'data-action' => Url::to(['gallery-sort'])
    ]
]) ?>
    <?php if($model->images) : ?>
        <div class="row">
        <?php foreach($model->images as $photo) : ?>
            <div class="col-md-2 col-sm-3 col-xs-4" data-key="<?= $photo->id ?>">
                <div class="thumbnail text-right">
                    <div class="photo-cover" style="background-image: url('<?= $photo->getPhoto('thumb') ?>')"></div>
                    <div class="btn-group btn-group-xs">
                        <a href="" class="btn btn-warning btn-move"><i class="fas fa-arrows-alt"></i></a>
                        <!--<a href="" class="btn btn-warning"><i class="fa fa-pencil"></i></a>-->
                        <?= Html::a('<i class="fa fa-trash"></i>', ['photo-delete', 'id' => $photo->id], [
                            'class' => 'btn btn-danger',
                            'date-method' => 'post',
                            'data-pjax' => 1
                        ])?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php Pjax::end(); ?>

<?php if($model->isNewRecord) : ?>
    <div class="alert alert-info"><i class="fa fa-info"></i> Сохраните запись, чтобы иметь возможность добавлять фото к отзыву.</div>
<?php else : ?>
    <?php $formImages = ActiveForm::begin([
            'action' => ['photo-upload'],
            'options' => [
                'enctype'=>'multipart/form-data'
            ]
    ]); ?>

        <?php $modelImage = new app\modules\portfolio\models\PortfolioImages(); ?>
        <?php $modelImage->portfolio_id = $model->id; ?>

        <?php echo $formImages->errorSummary($modelImage) ?>

        <?= $formImages->field($modelImage, 'portfolio_id')->hiddenInput()->label(false) ?>
        <?= $formImages->field($modelImage, 'image[]')->fileInput(['multiple' => true]) ?>

        <?= Html::submitButton('Добавить фото', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>
<?php endif; ?>