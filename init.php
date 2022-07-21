<?php

//timezone

date_default_timezone_set('America/Sao_Paulo');


require 'environment.php';

global $config;
$config = array();
if(ENVIRONMENT == 'development') {
	define('BD_SERVIDOR','localhost');
	define('BD_USUARIO','root');
	define('BD_SENHA','root');
	define('BD_BANCO','inmescom_distribuidor');
} else {
	define('BD_SERVIDOR','187.102.40.34:3306');
	define('BD_USUARIO','inmes_bd2020dist');
	define('BD_SENHA',';cL+Zu;0Nn[F');
	define('BD_BANCO','inmes_bd2020dist');
}
?>

