<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
    	'markdown' => [
            'class' => 'kartik\markdown\Module',
            'smartyPants' => false
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
	        'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
	    ]
    ],
];
