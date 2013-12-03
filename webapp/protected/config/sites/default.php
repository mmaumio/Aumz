<?php

return array(
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'stirplateio',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
        //'demo' // Yii on Google App Engine demo module
	),
	// application components
	'components'=>array(
        'assetManager'=>array(
            // This is special Asset Manger which can work under Google App Engine
            'class'=>'application.components.CGAssetManager',
            'basePath'=>Yii::getPathOfAlias('assets'),
            'baseUrl'=> '/assets'
        ),
        'request'=>array(
            'baseUrl' => '/',
            'scriptUrl' => '/',
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
            'baseUrl'=>'', // added to fix URL issues under Google App Engine
			'rules'=>array(
				'dashboard' => 'project/dashboard',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=stirplateio',
			'emulatePrepare' => true,
			'username' => 'setsocia_omni',
			'password' => 'angelhack123',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute', // default
					//'class'=>'CSyslogRoute', // log errors to syslog (supported by Google App Engine)
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),
		'clientScript'=>array(
			'class' => 'CClientScript',
			'scriptMap' => array(
				'jquery.min.js' => false
			)
		)
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'fbAppId' => '155307377991444',
		'fbApiSecret' => 'd6b72609ff6cc3be6a4c3db13eb34416',
	),


);