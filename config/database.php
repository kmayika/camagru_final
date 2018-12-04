<?php

function db_camagru()
{
	$server = 'localhost';
	$username = 'root';
	$password = '1911993k';
	try
	{
		$connect = new PDO("mysql:host=$server", $username, $password);
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $connect;
	}
	catch (PDOException $e)
	{
		return "Error!: " . $e->getMessage();
		die();
	}
}

?>
