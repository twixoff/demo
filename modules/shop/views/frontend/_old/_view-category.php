<div class="col-6 col-sm-4 col-lg-3">
    <?php if($item->type_id == 2) : ?>
        <a href="<?= $item->getUrl() ?>" class="catalog-category-card special">
            <?php if ($item->image_block) : ?>
                <img src="<?= $item->getPhoto('big', 'image_block') ?>" class="img-fluid">
            <?php endif; ?>
            <div class="title"><?= $item->title ?></div>
        </a>
    <?php else : ?>
        <div class="catalog-category-card">
            <?php if ($item->image_block) : ?>
                <img src="<?= $item->getPhoto('big', 'image_block') ?>" class="img-fluid">
            <?php endif; ?>
            <div class="overlay">
                <div class="title">
                    <a href="/<?= $item->slug ?>"><?= $item->name ?></a>
                </div>
                <?php if($item->hasChildren()) : ?>
                    <ul>
                        <?php foreach($item->children as $subpart) : ?>
                            <li><a href="<?= $subpart->getUrl() ?>"><?= $subpart->name ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>