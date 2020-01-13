<?php
use app\modules\shop\models\Serie;
$query = Serie::find()->where(['structure_id' => $category_id, 'type_id' => $model->id, 'is_publish' => 1]);
if(isset($fabric_id)) {
    $query->andWhere(['fabric_id' => $fabric_id]);
}
$series = $query->orderBy(['sort' => SORT_ASC])->all();
?>

<?php if($series) : ?>
    <div class="row mb-5">
        <div class="col-sm-4 col-md-3 pr-sm-0">
            <div class="portfolio-category-title"><?= $model->title ?></div>
        </div>
        <div class="col-sm-8 col-md-9">
            <div class="row">
                <?php if($series !== null) foreach($series as $serie) : ?>
                    <div class="col-6 col-md-4">
                        <div class="serie-item position-relative">
                            <img src="<?= $serie->getPhoto('big') ?>" class="img-fluid">
                            <a href="<?= $serie->getUrl() ?>" class="stretched-link"><?= $serie->title ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>