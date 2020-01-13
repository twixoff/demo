<?php if($model->gallery) : ?>
    <div class="container">
        <?php if($model->title) : ?>
            <div class="box-heading">
                <h3><?= $model->title ?></h3>
            </div>
        <?php endif; ?>
            
        <div class="info-block-gallery">
            <?php foreach($model->gallery as $photo) : ?>
            <div class="cover">
                <a href="<?= $photo->getPhoto('big') ?>" class="gallery-item" rel="gallery-<?= $model->id ?>" style="background-image: url('<?= $photo->getPhoto('thumb') ?>');" title="<?= $photo->title ?>">
                    <?php /* <img src="//<?= $photo->getPhoto('thumb') ?>" alt="<?= $photo->title ?>"> */ ?>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>