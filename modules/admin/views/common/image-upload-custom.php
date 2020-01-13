<?php

use mihaildev\elfinder\InputFile;
use app\components\helpers\SizeHelper;
use yii\helpers\Url;

?>

<div class="form-group">
        <label class="control-label"><?= $label ?></label>
        <?= InputFile::widget([
            'language'   => 'ru',
            'controller' => 'elfinder',
            'path'          => 'content',
            'id'         => $attribute,
            'name'       => $attribute,
            'value'      => '',
            'buttonName'    => 'Обзор',
//            'template'      => ($model->{$attribute} ? '<div class="thumbnail thumbnail-sm"><img src="'.$model->{$attribute}.'" class="img-responsive"></div>' : '')
//                . '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
            'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
            'options'       => ['class' => 'form-control', 'readonly' => true, 'data-width' => $width, 'data-height' => $height],
            'buttonOptions' => ['class' => 'btn btn-default'],
            'multiple'      => false
        ]); ?>
        <div class="hint-block">Рекомендуемый размер изображения <?= $width ?> х <?= $height ?> пк.</div>
</div>

<?php $this->registerJs("$('#".$attribute."').on('change', function() {
    var file = $(this).val();
    if(file.length) {
        var input = $(this);
        input.parent().siblings('.thumbnail').remove();
        input.parent().before('<div class=\"thumbnail thumbnail-sm\"><img src=\"'+file+'\" class=\"img-responsive\"></div>');
        // check size image
        $.ajax({
            url: '".Url::to(['/admin/file-manager/check-size'])."',
            type: 'post',
            data: {'file': file, 'width': input.data('width'), 'height': input.data('height')},
            success: function(data) { if(data.length) { input.parentsUntil('form', '.form-group').find('.hint-block').html(data); } }
        });
    }
});"); ?>