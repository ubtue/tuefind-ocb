<?php
namespace KeiBi\Module\Config;

$config = [
    'service_manager' => [
        'factories' => [
            'KeiBi\RecordDriver\PluginManager' => 'VuFind\ServiceManager\AbstractPluginManagerFactory'
        ],
        'aliases' => [
         'VuFind\RecordDriverPluginManager' => 'KeiBi\RecordDriver\PluginManager',
         'VuFind\RecordDriver\PluginManager' => 'KeiBi\RecordDriver\PluginManager',
        ]
    ]
];

$recordRoutes = [
    'record' => 'Record'
];
$dynamicRoutes = [];
$staticRoutes = [
    'Help/FAQ',
    'MyResearch/Newsletter',
];

$routeGenerator = new \VuFind\Route\RouteGenerator();
$routeGenerator->addRecordRoutes($config, $recordRoutes);
$routeGenerator->addDynamicRoutes($config, $dynamicRoutes);
$routeGenerator->addStaticRoutes($config, $staticRoutes);

return $config;
