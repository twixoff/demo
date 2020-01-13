<?php

use app\modules\admin\models\Structure;

$part = Structure::findOne($model->structure_id);

$this->params['breadcrumbs'][] = ['label' => $part->name, 'url' => ['index', 'id' => $part->id]];
$this->params['breadcrumbs'][] = ['label' => 'Редактирование: ' . $model->title];
$this->title = $part->name . ' - Редактирование';
?>
<div class="info-blocks-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataProviderCards' => $dataProviderCards
    ]) ?>
    
    <?php if($model->type == 'gallery') {
        echo $this->render('types/_gallery_form', ['parentModel' => $model]);
    } ?>

</div>