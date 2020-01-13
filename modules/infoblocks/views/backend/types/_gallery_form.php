<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use app\modules\infoblocks\models\InfoBlockGallery;
use yii\jui\JuiAsset;

JuiAsset::register($this);

$model = new InfoBlockGallery();
$model->block_id = $parentModel->id;
$model->is_publish = 1;

?>

<?php Pjax::begin(['enablePushState' => false, 'clientOptions' => ['type' => 'post'],
    'options' => [
        'class' => 'gallery-widget',
        'data-action' => Url::to(['gallery-sort'])
    ]
]) ?>
    <?php if($parentModel->gallery) : ?>
    <?php // TODO:: may be Grid ? ?>
        <div class="row">
        <?php foreach($parentModel->gallery as $photo) : ?>
            <div class="col-md-2 col-sm-3 col-xs-4" data-key="<?= $photo->id ?>">
                <div class="thumbnail text-right">
                    <div class="photo-cover" style="background-image: url('<?= $photo->getPhoto('thumb') ?>')"></div>
                    <div class="btn-group btn-group-xs">
                        <a href="" class="btn btn-warning btn-move"><i class="fa fa-arrows"></i></a>
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

<?php $form = ActiveForm::begin([
        'action' => ['photo-upload'],
//        'action' => Url::to(['to']),
    'options' => [
        'enctype'=>'multipart/form-data',
    ]
]); ?>

    <?php echo $form->errorSummary($model) ?>

    <?= $form->field($model, 'block_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'image[]')->fileInput(['multiple' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>