<?php
use app\components\Page;
use yii\widgets\Pjax;
use yii\helpers\Url;
$items = Yii::$app->cart->getPositions();
?>

<div class="header-wrap">
    <div class="container d-flex justify-content-between">
        <h1 class="page-header"><?= Page::getName() ?></h1>
        <ul class="cart-steps pt-2">
            <li class="active btn-skew"></li>
            <li class="btn-skew"></li>
            <li class="btn-skew"></li>
        </ul>
    </div>
</div>

<div class="container">
    <?php if($items) : ?>
        <?php Pjax::begin(['id' => 'cart', 'submitEvent' => false]) ?>
            <?php $productCounts = count($items); ?>
            <table class="table-cart table-product">
                <thead>
                    <tr class="d-none d-sm-table-row">
                        <th>Всего <span><?= $productCounts ?></span> <?= Yii::t('app', '{n, plural, one{товар} few{товара} many{товаров} other{товара}}', ['n' => $productCounts]) ?></th>
                        <th colspan="2" class="text-center">Количество</th>
                        <th class="text-center">Цена</th>
                        <th class="text-center">Стоимость</th>
                        <th></th>
                    </tr>
                </thead>
                <?php foreach($items as $item) : ?>
                    <tr class="d-sm-none">
                        <td colspan="7"><?= $item->title ?></td>
                    </tr>
                    <tr>
                        <td class="d-none d-sm-table-cell"><?= $item->title ?></td>
                        <td width="1%" class="dimension text-right d-none d-sm-table-cell"><?= $item->dimension ?></td>
                        <td class="quantity">
                            <button class="button-minus">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <input name="quantity" type="text" value="<?= $item->getQuantity() ?>" autocomplete="off"
                                   data-href="<?= Url::to(['/shop/frontend/cart-update', 'id' => $item->id]) ?>">
                            <button href="#" class="button-plus">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </td>
                        <td class="d-sm-none"><?= $item->dimension ?></td>
                        <td class="price text-center">
                            <?= number_format($item->getPrice(), 0, '.', ' ') ?> руб.
                        </td>
                        <td class="price-total text-center">
                            <?= number_format($item->getCost(), 0, '.', ' ') ?> руб.
                        </td>
                        <td class="text-center">
                            <a href="<?= Url::to(['/shop/frontend/cart-remove', 'id' => $item->id]) ?>" class="remove-cart">
                                <svg width="17px" height="16px">
                                    <use xlink:href="#close-svg"></use>
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </table>
                <div class="cart-summary text-center text-sm-right">
                    Сумма к оплате: <b><?= number_format(\Yii::$app->cart->getCost(), 0, '.', ' ') ?> руб.</b>
                    <a href="<?= Url::to(['cart-order']) ?>" class="btn btn-primary btn-skew ml-4 mt-4 mt-sm-0"><span>Оформить заказ</span></a>
                </div>
        <?php Pjax::end() ?>
    <?php else : ?>
        <div style="min-height: 20rem;">
            <div class="alert alert-warning text-center">
                <b>Ваша корзина пуста.</b>
            </div>
        </div>
    <?php endif; ?>
</div>
