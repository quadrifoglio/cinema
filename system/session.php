<?php

class Session {

	/*
	 * Vérifier l'existence d'une session utilisateur
	 * Retourne l'id de l'utilisateur si une session existe, false sinon
	 */
	public static function check() {
		$cookie = isset($_COOKIE["ssid"]) ? htmlentities($_COOKIE["ssid"]) : false;
		if(!$cookie) {
			return false;
		}

		$db = Database::get();
		$stmt = $db->prepare("SELECT SessionClientRef FROM session WHERE SessionID = ? LIMIT 1");
		$success = $stmt->execute([$cookie]);
		if(!$success) {
			return false;
		}

		$res = $stmt->fetchAll();
		return $res[0]["sessionclientref"];
	}

	/*
	 * Démarre une nouvelle session pour l'utilisateur spécifié
	 */
	public static function start($clientId) {
		$delay = 604800;
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789,-";

		srand((double)microtime()*1000000);
		$i = 0;
		$ssid = "";

		while($i < 64)  {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$ssid .= $tmp;
			$i++;
		}

		setcookie("ssid", $ssid);

		$db = Database::get();
		$stmt = $db->prepare("INSERT INTO session VALUES (?, ?, ?)");

		return $stmt->execute([$ssid, $clientId, time() + $delay]);
	}

}
