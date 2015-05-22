<?php

error_reporting (E_ALL ^E_NOTICE);
 ini_set( 'display_errors','1');
 
$host = "aeria-app.be.mysql";
$dbname = "aeria_app_be";
$user = "aeria_app_be";
$password = "imdY6pMG";
try
{
	$bdd = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=UTF8', $user, $password);
}catch (PDOException $e)
{
	die('Error : '.$e->getMessage());
}

?>