<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use app\components\grid\ExtraGridView;
use app\modules\infoblocks\models\InfoBlockCard;
?>

<?php if($model->isNewRecord) : ?>
    <div class="alert alert-info">Для добавления карточек необходимо сохранить новый блок.</div>
<?php else : ?>
    <div class="text-right">
        <button type="button" class="btn btn-xs btn-info add-card-item" data-toggle="modal" data-target="#modal-create-card"><i class="fa fa-plus"></i> Добавить блок</button>
    </div>
    <?= ExtraGridView::widget([
        'dataProvider' => $dataProviderCards,
        'enableSort' => true,
        'sortableColumn' => true,
        'sortableAction' => ['card-sort'],
        'columns' => [
            [
                'attribute' => 'image',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 100px;'],
                'value' => function($data) {
                    return $data->image ? Html::img($data->getPhoto('thumb'), ['class' => 'img-responsive']) : null;
                }
            ],
            'title',
//            'link',
            [
                'class' => 'app\components\grid\GroupActionColumn',
                'urlCreator' => function($action, $model, $key, $index) {
                    $params = is_array($key) ? $key : ['id' => (string) $key];
                    $params[0] = 'backend/card-' . $action;

                    return Url::toRoute($params);
                },
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $options = [
                            'class' => 'btn btn-xs btn-default',
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-update-card',
                            'title' => 'Редактировать',
                            'aria-label' => 'Редактировать',
                            'data-pjax' => 0
                        ];

                        return Html::a('<span class="fas fa-pen"></span>', $url, $options);
                    }
                ]
            ],
        ],
    ]); ?>

    <?php $cardModel = new InfoBlockCard(); ?>
    <?php Modal::begin(['id' => 'modal-create-card', 'header' => '<h4 class="modal-title">Добавление карточки</h4>']) ?>
        <?php $form = ActiveForm::begin(['action' => ['card-create'], 'options' => ['enctype'=>'multipart/form-data']]) ?>
            <?= Html::activeHiddenInput($cardModel, 'block_id', ['value' => $model->id]) ?>
            <?= $form->field($cardModel, 'type_id')->inline()->radioList([
                InfoBlockCard::TYPE_CARD => 'Услуга', InfoBlockCard::TYPE_CONTACT => 'Контакт'
            ])->label(false) ?>
            <?= $form->field($cardModel, 'title') ?>
            <?= $form->field($cardModel, 'link')->hint('Для блока типа «Услуга»') ?>
            <?= $form->field($cardModel, 'phone')->hint('Для блока типа «Контакт»') ?>
            <?= $form->field($cardModel, 'email')->hint('Для блока типа «Контакт»') ?>
            <?= $form->field($cardModel, 'image')->fileInput() ?>
            <button type="submit" class="btn btn-primary">Добавить</button>
        <?php ActiveForm::end() ?>
    <?php Modal::end() ?>

    <?php Modal::begin(['id' => 'modal-update-card', 'header' => '<h4 class="modal-title">Редактирование карточки</h4>']) ?>

    <?php Modal::end() ?>
<?php endif; ?>

<?php
$script = <<< JS
$('#modal-update-card').on('show.bs.modal', function (e) {
  // ajax get form view
  var url = $(e.relatedTarget).attr('href');
  $('#modal-update-card .modal-body').load(url);
});
JS;

$this->registerJs($script) ?>