<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'baseUrl' => '',
//            'suffix' => '.html',
    'rules' => [
        // admin
        'admin/<_c:(default|structure|redirects|counters|file-manager|slider)>' => 'admin/<_c>/index',
        'admin/<_c:(default|structure|redirects|counters|file-manager|slider)>/<_a:[\w\-]+>/<id:\d+>' => 'admin/<_c>/<_a>',
        'admin/<_c:(default|structure|redirects|counters|file-manager|slider)>/<_a:[\w\-]+>' => 'admin/<_c>/<_a>',
        // backend shop module
        'admin/<_m:(shop)>/<_c:(category|type|fabric|serie|product|order)>/<_a:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/<_a>',
        'admin/<_m:(shop)>/<_c:(category|type|fabric|serie|product|order)>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
        'admin/<_m:(shop)>/<_c:(category|type|fabric|serie|product|order)>' => '<_m>/<_c>/index',

        'admin/<_m:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_m>/backend/<_a>',
        'admin/<_m:[\w\-]+>/<_a:[\w\-]+>' => '<_m>/backend/<_a>',
        'admin/<_m:[\w\-]+>' => '<_m>/backend/index',

        // frontend
        'shop/<_a:(add-to-cart|cart-remove|cart-update)/<id:\d+>' => 'shop/frontend/<_a>',
        '<_a:(cart-order)>' => 'shop/frontend/<_a>',
        '<_a:(category)>/<id:\d+>' => 'shop/frontend/<_a>',

        [
            'class' => 'app\components\SlugUrlRule',
        ],
        
        '<_m:(shop)>/<_a:[\w\-]+>' => '<_m>/frontend/<_a>',

        '<_a:(quick-order)>/<id:\d+>' => 'shop/frontend/<_a>',
        'md/<_a:(search)>' => 'contact/modal/<_a>',
        '<_a:(callback)>' => 'main/contact/<_a>',
        '<_a:(search)>' => 'main/default/<_a>',
        '<_a:error>' => 'main/default/<_a>',
        '<_a:(login|logout)>' => 'user/default/<_a>',
    ]
];