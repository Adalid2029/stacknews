<?php
$dsn = 'mysql:dbname=platzixy_p;host=134.119.190.82';
$user = 'platzixy_p';
$password = 'Tecem001+';
try{
	$pdo = new PDO(	$dsn, 
					$user,
					$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
}catch( PDOException $e ){
	echo 'Error al conectarnos: ' . $e->getMessage();
}