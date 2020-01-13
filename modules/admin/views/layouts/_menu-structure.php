<?php
use app\modules\admin\models\Structure;
?>

<ul class="list-group level-1">
    <?php foreach(Structure::getTree() as $t) : ?>
        <li class="list-group-item <?= $t->is_publish ? '' : 'list-hidden'?>">
            <?php if($t->children) : ?>
                <?php $isCollapsed = Yii::$app->session->get('menu-sub-'.$t->id, 0); ?>
                <a class="fas fa-caret-left pull-right <?= $isCollapsed ? 'collapsed' : '' ?>" data-toggle="collapse" href="#menu-sub-<?= $t->id ?>" aria-expanded="<?= $isCollapsed ? 'true' : 'false' ?>" aria-controls="menu-sub-<?= $t->id ?>"></a>
            <?php endif; ?>
            <a href="<?= $t->getAdminUrl() ?>"><?= $t->name ?></a>
        </li>

        <?php if($t->children) : ?>
            <ul class="list-group level-2 <?= $isCollapsed ? 'collapse in' : 'collapse' ?>" id="menu-sub-<?= $t->id ?>">
                <?php foreach($t->children as $ch) : ?>
                    <li class="list-group-item <?= $ch->is_publish ? '' : 'list-hidden'?>">
                        <?php if($ch->children) : ?>
                            <?php $isCollapsed2 = Yii::$app->session->get('menu-sub-'.$ch->id, 0); ?>
                            <a class="fas fa-caret-left pull-right <?= $isCollapsed2 ? 'collapsed' : '' ?>" data-toggle="collapse" href="#menu-sub-<?= $ch->id ?>" aria-expanded="<?= $isCollapsed2 ? 'true' : 'false' ?>" aria-controls="menu-sub-<?= $ch->id ?>"></a>
                        <?php endif; ?>
                        <a href="<?= $ch->getAdminUrl() ?>"><?= $ch->name ?></a>
                    </li>
        
                        <?php if($ch->children) : ?>
                            <ul class="list-group level-3 <?= $isCollapsed2 ? 'collapse in' : 'collapse' ?>" id="menu-sub-<?= $ch->id ?>">
                                <?php foreach($ch->children as $ch2) : ?>
                                    <li class="list-group-item <?= $ch2->is_publish ? '' : 'list-hidden'?>">
                                        <?php if($ch2->children) : ?>
                                            <?php $isCollapsed3 = Yii::$app->session->get('menu-sub-'.$ch2->id, 0); ?>
                                            <a class="fas fa-caret-left pull-right <?= $isCollapsed3 ? 'collapsed' : '' ?>" data-toggle="collapse" href="#menu-sub-<?= $ch2->id ?>" aria-expanded="<?= $isCollapsed3 ? 'true' : 'false' ?>" aria-controls="menu-sub-<?= $ch2->id ?>"></a>
                                        <?php endif; ?>
                                        <a href="<?= $ch2->getAdminUrl() ?>"><?= $ch2->name ?></a>
                                    </li>

                                    <?php if($ch2->children) : ?>
                                        <ul class="list-group level-4 <?= $isCollapsed3 ? 'collapse in' : 'collapse' ?>" id="menu-sub-<?= $ch2->id ?>">
                                            <?php foreach($ch2->children as $ch3) : ?>
                                                <li class="list-group-item <?= $ch3->is_publish ? '' : 'list-hidden'?>">
                                                    <a href="<?= $ch3->getAdminUrl() ?>"><?= $ch3->name ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>

<?php $script = <<< JS
$('.level-2, .level-3, .level-4').on('show.bs.collapse', function (e) {
    var id = $(this).attr('id');
    $.post({
        url: '/admin/default/set-value',
        data: {'id': id, 'value': 1},
        method: 'post'
    });
}).on('hide.bs.collapse', function (e) {
    var id = $(this).attr('id');
    $.post({
        url: '/admin/default/set-value',
        data: {'id': id, 'value': 0},
        method: 'post'
    });
})
JS;
$this->registerJs($script);
?>
