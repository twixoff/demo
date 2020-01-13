<?php
use app\modules\admin\models\Structure;

$cartPart = Structure::find()->where(['type_id' => 62])->one();
$cartUrl = $cartPart ? $cartPart->getUrl() : null; ?>

<div class="modal" tabindex="-1" role="dialog" id="modal-added-to-cart">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Добавлено</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg width="17px" height="16px">
                        <use xlink:href="#close-svg"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="/static/i/cart-added.png" class="img-fluid mb-5" />
                <p class="mb-4">Товар был успешно добавлен в корзину!<br>
                    Вы можете приступить к оформлению заказ.</p>
                <a href="<?= $cartUrl ?>" class="btn btn-lg btn-primary btn-skew mb-5"><span>Перейти в корзину</span></a>
            </div>
        </div>
    </div>
</div>
