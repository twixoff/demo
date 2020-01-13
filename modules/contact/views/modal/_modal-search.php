<div class="modal-header">
    <h5 class="modal-title">Поиск</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <svg width="17px" height="16px">
            <use xlink:href="#close-svg"></use>
        </svg>
    </button>
</div>
<div class="modal-body">
    <form class="modal-form-search text-center" action="/search">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        <input class="form-control mb-5" type="search" name="q" required placeholder="Поиск" aria-label="Поиск" autocomplete="off">
        <button type="submit" class="btn btn-lg btn-primary btn-skew mb-4"><span>Найти</span></button>
    </form>
</div>
