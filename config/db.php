<?php
class Database{
	public static function connect(){
		$db = new mysqli('db', 'user', 'password', 'tienda_master');
		if ($db->connect_error) {
			die("Error de conexión: " . $db->connect_error);
	} $db->query("SET NAMES 'utf8'");
		return $db;
	}
}

