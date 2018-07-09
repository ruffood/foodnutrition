<?php
return array(

	  'DB_HOST' => 'localhost',
	  'DB_NAME' => 'nutrition',
	  'DB_USER' => 'root',
	  'DB_PWD' => 'q1w2e3',
	  'DB_PORT' => '3306',
	  'DB_PREFIX' => 'yk_',

    'DEFAULT_MODULE' => 'index', //默认控制器

    'TMPL_PARSE_STRING'=>array(
        '__STATICS__'=>__ROOT__.'/statics',
        '__UPLOAD__'=>__ROOT__.'/data/upload',
    ),
);
