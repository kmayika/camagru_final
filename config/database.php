<?php

function db_camagru()
{
	$server = 'localhost';
	$username = 'root';
	$password = '1911993k';
	$database = 'db_camagru';
	try
	{
		$connect = new PDO("mysql:host=$server", $username, $password);
		return $connect;
	}
	catch (PDOException $e)
	{
		return "Error!: " . $e->getMessage();
		die();
	}
}

?>
