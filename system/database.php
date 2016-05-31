<?php

class Database extends PDO {
	static $instance = null;

	public function request($sql, $data) {
		$stmt = $this->prepare($sql);
		$res = $stmt->execute($data);

		if($res) {
			return $stmt->fetchAll();
		}

		return false;
	}

	public static function get() {
		$host = "127.0.0.1";
		$user = "cinema";
		$password = "WilliamPeel";
		$name = "cinema";

		if(Database::$instance == null) {
			try {
				Database::$instance = new Database("pgsql:host=$host dbname=$name", $user, $password);
			}
			catch(Exception $e) {
				die("Database error: " . $e->getMessage());
			}
		}

		return Database::$instance;
	}
}
