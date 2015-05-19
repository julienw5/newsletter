<?php

/******************************************************
----------------Configuration Obligatoire--------------
Veuillez modifier les variables ci-dessous pour que l'
espace membre puisse fonctionner correctement.
******************************************************/
// int error_reporting (E_ALL);
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

