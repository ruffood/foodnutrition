<?php
define('YOUKE_VERSION', '1.0');
define('APP_NAME', 'app');
define('APP_PATH', './app/');
define('YOUKE_DATA', './data/');
define('EXTEND_PATH', APP_PATH . 'Extend/');
define('CONF_PATH', YOUKE_DATA . 'config/');
define('RUNTIME_PATH', YOUKE_DATA . 'runtime/');
// define('APP_DEBUG', false);
define('APP_DEBUG', true);
require("./framework/run.php");
