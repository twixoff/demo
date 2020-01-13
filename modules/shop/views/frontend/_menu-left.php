<?php
use app\components\Page;
use app\modules\admin\models\Structure;
$currentPage = Page::getCurrent();
$currentPageTypeId = $currentPage ? $currentPage->type_id : null;

$menuLeft = Structure::find()->where(['type_id' => 60, 'is_publish' => 1])->orderBy(['sort' => SORT_ASC])->all();
?>

<?php if($menuLeft) : ?>
    <div class="navbar-expand-md">
        <div class="navbar-collapse collapse" id="navbar-left">
            <ul class="left-menu">
                <?php foreach($menuLeft as $item) : ?>
                    <li>
                        <?= $item->name ?>
                        <?php if($item->hasChildren()) : ?>
                            <ul>
                                <?php foreach(Structure::find()->where(['parent_id' => $item->id])->all() as $child) : ?>
                                    <li>
                                        <?php if($currentPageTypeId == 60) : ?>
                                            <a href="<?= $child->getUrl() ?>"><?= $child->name ?></a>
                                        <?php else : ?>
                                            <a href="?section_id=<?= $child->id ?>"><?= $child->name ?></a>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>