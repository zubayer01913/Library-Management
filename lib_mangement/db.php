<?php
function get_db(){
	$db_name="lib_ss"; // Database name
	$host="localhost";
	$username="lib_ss";
	$password="shsagor";
	$db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
	return $db;
}
?>
