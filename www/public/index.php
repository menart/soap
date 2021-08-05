<?php

require '../vendor/autoload.php';

use Core\App;

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

try {
	$app = new App();
	$app->run();
} catch (\Exception $exp) {
	echo $exp->getMessage();
}

/*

*/