<?php
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
?>
<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'content')->widget(CKEditor::className(),[
    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
        'toolbar' => [
            ['Source'],
            ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'],
            ['PasteText', 'PasteFromWord', '-', 'Link', 'Unlink', 'Anchor'],
            ['Maximize', 'ShowBlocks'],
            ['About'],
            '/',
            '/',
            ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'],
            ['Format', 'Font', 'FontSize'],
            ['TextColor', 'BGColor'],
            ['Image', 'Table', 'HorizontalRule',  'Iframe']
        ],
        'height' => 400,
        'extraAllowedContent' => 'a[data-modal-url]',
        'inline' => false, //по умолчанию false
    ]),
])
//    ->label(false)->hint(
//    "1. Для просмотра видео в попап окне добавьте <code class='copy-to-clipboard' data-clipboard-text='class=\"popup-video\"'>class='popup-video'</code> для элемента ссылки<br>" .
//    "2. Для просмотра изображения в попап окне добавьте <code class='copy-to-clipboard' data-clipboard-text='class=\"popup-picture\"'>class='popup-picture'</code> для элемента ссылки"
//); ?>
