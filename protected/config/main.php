<?php

$dbConfig = json_decode(file_get_contents(dirname(__FILE__).'/db.json'), true);
$pre_config = require(dirname(__FILE__).'/local.php');

// Location where user images are stored
Yii::setPathOfAlias('uploadPath',dirname(__FILE__).DIRECTORY_SEPARATOR.'../../images/uploads');
Yii::setPathOfAlias('uploadURL', '/images/uploads/');

return CMap::mergeArray(array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'GigaDB',

    'preload'=>array(
        'log',
        'bootstrap',
    ),

    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.behaviors.*',
        'application.vendors.*',
        'application.helpers.*',
    ),
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'gigadbyii',
            'ipFilters'=>array('*'),
        ),
                   
          'comment'=>array(
            'class'=>'ext.comment-module.CommentModule',
            'commentableModels'=>array(
                // define commentable Models here (key is an alias that must be lower case, value is the model class name)
                'dataset'=>'Dataset'),
            
            // set this to the class name of the model that represents your users
            'userModelClass'=>'User',
            // set this to the username attribute of User model class
            'userNameAttribute'=>'first_name',
            // set this to the email attribute of User model class
            'userEmailAttribute'=>'email',
            // you can set controller filters that will be added to the comment controller {@see CController::filters()}
//          'controllerFilters'=>array(),
            // you can set accessRules that will be added to the comment controller {@see CController::accessRules()}
//          'controllerAccessRules'=>array(),
            // you can extend comment class and use your extended one, set path alias here
//          'commentModelClass'=>'comment.models.Comment',
        ),
    ),
    'components'=>array(
        'db'=>array(
            'class'=>'system.db.CDbConnection',
            'connectionString'=>"pgsql:dbname={$dbConfig['database']};host={$dbConfig['host']}",
            'username'=>$dbConfig['user'],
            'password'=>$dbConfig['password'],
            'charset'=>'utf8',
            'persistent'=>true,
            'enableParamLogging'=>true,
            'schemaCachingDuration'=>30
        ),

        'bootstrap'=>array(
            'class'=>'ext.bootstrap.components.Bootstrap',
        ),
        'cache' => array(
            'class' => 'system.caching.CFileCache'
        ),
        'session' => array(
            'class' => 'system.web.CDbHttpSession',
            'connectionID' => 'db',
            'timeout' => 3600,
        ),
        'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                '/dataset/<id:\d+>'=>'dataset/view/id/<id>',
                // REST patterns
                array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),                
                array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
                array('api/sample', 'pattern'=>'api/sample/<name>', 'verb'=>'GET'),
                array('api/keyword', 'pattern'=>'api/keyword/<keyword>', 'verb'=>'GET'),
                array('api/author', 'pattern'=>'api/<action:\w+>/<name>', 'verb'=>'GET'),
                array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
                array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
                array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),
                //others
		'<controller:\w+>/<id:\d+>' => '<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>' =>'<controller>/<action>',
		'<controller:\w+>/<action:\w+>' =>'<controller>/<action>',
                //'search'=>'site/index',
                //'download/<search:.+>'=>'site/index',
                //'download'=>'site/index',
                '.*'=>'site/index',
            ),
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                   /*
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning, info, debug',
                ),
             
                array(
                    'class'=>'CWebLogRoute',
                ),
                    * 
                    */
            ),
        ),
        'messages'=>array(
            'class'=>'CPhpMessageSource',
        ),
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            //User WebUser
            'class'=>'WebUser',
        ),
        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
        ),
        'image'=>array(
          'class'=>'application.extensions.image.CImageComponent',
              // GD or ImageMagick
          'driver'=>'GD',
      ),
         
    ),

    'params' => array(
        // date formats
        'js_date_format' => 'dd-mm-yy',
        'db_date_format' => "%Y-%m-%d",
        'display_date_format' => "%gggggggd-%m-%Y",
        'display_short_date_format' => "%d-%m",
        'language' => 'en' ,
        'languages' => array('en' => 'EN', 'zh_tw' => 'TW'),

   ),
), $pre_config);

