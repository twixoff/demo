<?php

return [
    'breadcrumbs' => [],
    'adminEmail' => 'denis.dever@gmail.com',
    'fromEmail' => ['info@unionlight.kz' => 'Union Light'],
    'cacheTime' => [
        'short' => 60,
        'long' => 3600
    ],
    'multiLang' => false,
    'languages' => [
        'ru-RU' => 'ru',    
        'en-US' => 'en',
    ],
    'structureTypes' => [
        // Типовые страницы
        1 => ['title' => 'Главная',  'route' => '/infoblocks/frontend/index', 'icon' => 'fa-globe', 'hasBackend' => false],
        2 => ['title' => 'Текстовая страница', 'route' => '/infoblocks/frontend/index', 'icon' => 'fa-file-alt'],
//        3 => ['title' => 'Текстовая страница', 'route' => '/pages/frontend/view'],
//        4 => ['title' => 'Новости', 'route' => '/news/frontend/index', 'icon' => 'fa-newspaper'],
//        5 => ['title' => 'Статьи', 'route' => '/news/frontend/index'],
//        6 => ['title' => 'FAQ', 'route' => '/faq/frontend/index', 'icon' => 'fa-comments-o'],
//        7 => ['title' => 'Список объектов', 'route' => '/objects/frontend/index'],  // Список объектов
//        8 => ['title' => 'Отзывы', 'route' => '/reviews/frontend/index', 'icon' => 'fa-comment'],
        9 => ['title' => 'Контакты', 'route' => '/contact/frontend/index', 'icon' => 'fa-tty', 'hasBackend' => false],

        20 => ['title' => 'Портфолио', 'route' => '/portfolio/frontend/index', 'icon' => 'fa-folder'],
//        30 => ['title' => 'Документы', 'route' => '/documents/frontend/index', 'icon' => 'fa-book'],  // Список объектов
//        40 => ['title' => 'Уроки', 'route' => '/lessons/frontend/index', 'icon' => 'fa-film'],  // Список объектов
        
        50 => ['title' => 'Редирект на внутреннюю страницу', 'route' => '/pages/frontend/view', 'icon' => 'fa-share arrow-bottom-rotate', 'hasBackend' => false],

        60 => ['title' => 'Магазин - главная витрина', 'route' => '/shop/frontend/index', 'icon' => 'fa-shopping-bag', 'hasBackend' => false],
        61 => ['title' => 'Магазин - список серий (товаров)', 'route' => '/shop/frontend/serie', 'icon' => 'fa-shopping-bag'],
//        62 => ['title' => 'Магазин - корзина', 'route' => '/shop/frontend/cart', 'icon' => 'fa-shopping-basket', 'hasBackend' => false],
//        62 => ['title' => 'Магазин - оформление заказа', 'route' => '/shop/frontend/order', 'icon' => 'fa-shopping-basket', 'hasBackend' => false],
//        63 => ['title' => 'Магазин - выставление счета / результат оплаты', 'route' => '/shop/frontend/invoice', 'icon' => 'fa-money', 'hasBackend' => false],
//        64 => ['title' => 'Магазин - скачивание обновлений', 'route' => '/shop/frontend/download-update', 'icon' => 'fa-download', 'hasBackend' => false],
        65 => ['title' => 'Магазин - фабрики', 'route' => '/shop/frontend/fabric', 'icon' => 'fa-industry'],

//        100 => ['title' => 'Форма заявки', 'route' => '/main/credit/index', 'icon' => 'fa-pencil-square-o'],
        500 => ['title' => 'Страница «О компании»', 'route' => ['/main/custom/index', ['type' => 'about']], 'icon' => 'fa-star-half-alt', 'hasBackend' => false],
    ],
];
