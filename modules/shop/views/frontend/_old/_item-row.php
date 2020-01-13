<tr id="p<?= $item->id ?>" class="d-sm-none">
    <td colspan="6"><?= $item->title ?></td>
</tr>
<tr id="p<?= $item->id ?>" data-id="<?= $item->id ?>">
    <td class="d-none d-sm-table-cell"><?= $item->title ?></td>
    <td class="dimension d-none d-sm-table-cell text-center"><?= $item->dimension ?></td>
    <td class="quantity text-center">
        <button class="button-minus">
            <i class="fas fa-chevron-left"></i>
        </button>
        <input name="quantity" type="text" value="1" autocomplete="off">
        <button href="#" class="button-plus">
            <i class="fas fa-chevron-right"></i>
        </button>
    </td>
    <td class="d-sm-none"><?= $item->dimension ?></td>
    <td class="price text-center"><span><?= number_format($item->getPrice(), 0, '', ' ') ?></span> руб.</td>
    <td>
        <a href="/shop/add-to-cart?id=<?= $item->id ?>" class="add-to-cart btn-skew" data-quantity="1">
            <svg width="19px" height="19px" viewBox="0 0 58 55">
                <use xlink:href="#cart-svg"></use>
            </svg>
        </a>
    </td>
</tr>