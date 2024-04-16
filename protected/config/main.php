<?php

// uncomment the following to define a path alias

// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable

// CWebApplication properties can be configured here.
$db = include('./con_db/db.php');


Yii::setPathOfAlias('chartjs', dirname(__FILE__).'/../extensions/yii-chartjs');

return array(

	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',

	'name'=>'(RDBL)',

	'defaultController' => 'web', 
	// preloading 'log' component
	'preload'=>array('log','chartjs'),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.crontab.*',
		'ext.yii-mail.YiiMailMessage'//,
		// 'application.extensions.phpmailer.JPhpMailer'
	),
	'modules'=>array(

		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',

			'password'=>'12345',

			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),

		),
	),

	// application components
	'theme'=>'eyes',
	'components'=>array(
		'user'=>array(
		    // enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		 'chartjs' => array('class' => 'chartjs.components.ChartJs'),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
credential: 'connectionString' => 'mysql:host=localhost;dbname=rdlpk_db1',
			'username' => 'rdlpk_admin',
			'password' => 'creative123admin',

		),*/
		// uncomment the following to use a MySQL database
		//	'import'=>array(

////	'application.models.*',
//	'application.components.*',
//	'ext.yii-mail.YiiMailMessage',
//),
			'db'=>array(
               // $con=mysqli_connect($db['host'],$db['username'],$db['password'],$db['db_name']);

			'connectionString' => 'mysql:host=' . $db['host'] . ';dbname=' . $db['db_name'],
			'emulatePrepare' => true,
			'username' => $db['username'],
			'password' => $db['password'],
			'charset' => 'utf8',
		),
		'swiftMailer' => array(
	            'class' => 'ext.swiftMailer.SwiftMailer',
                        ),
		'mail' => array(
				'class' => 'ext.yii-mail.YiiMail',
				'transportType'=>'smtp',
				'transportOptions'=>array(
						'host'=>'mail.rdlpk.com',
						'username'=>'info@rdlpk.com',
						'password'=>'%c!+y~^;FJ[3',
						'port'=>'465',						
				),
				'viewPath' => 'application.views.mail',				
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages

				/*

				array(
					'class'=>'CWebLogRoute',
				),

				*/

			),
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']

	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',

	),

);