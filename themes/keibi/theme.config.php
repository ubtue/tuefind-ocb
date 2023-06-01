<?php
return [
    'extends' => 'ixtheo2',
    'favicon' => '',
    'js' => [
        'relbib2.js',
    ],
    'helpers' => [
        'factories' => [
            'KeiBi\View\Helper\Root\RecordDataFormatter' => 'KeiBi\View\Helper\Root\RecordDataFormatterFactory',
            'TueFind\View\Helper\Root\RecordDataFormatter' => 'KeiBi\View\Helper\Root\RecordDataFormatterFactory',
            'KeiBi\View\Helper\Root\Record' => 'VuFind\View\Helper\Root\RecordFactory'
        ],
        'aliases' => [
            'record' => 'KeiBi\View\Helper\Root\Record',
            'recordDataFormatter' => 'KeiBi\View\Helper\Root\RecordDataFormatter'
        ]
    ]
];
