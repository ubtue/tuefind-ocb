<?php
return [
    'extends' => 'ixtheo2',
    'favicon' => '',
    'js' => [
        'relbib2.js',
    ],
    'helpers' => [
        'factories' => [
            'TueFind\View\Helper\Root\RecordDataFormatter' => 'KeiBi\View\Helper\Root\RecordDataFormatterFactory'
        ],
    ]
];
