<?php

class Session {

	/*
	 * Vérifier l'existence d'une session utilisateur
	 * Retourne l'id de l'utilisateur si une session existe, false sinon
	 */
	public static function check() {
		$cookie = isset($_COOKIE["sssid"]) ? htmlentities($_COOKIE["sssid"]) : false;
		if(!$cookie) {
			return false;
		}

		$db = Database::get();
		$stmt = $db->prepare("SELECT ClientID FROM session WHERE SessionId = ?");
		$success = $stmt->execute([$cookie]);
		if(!$success) {
			return false;
		}

		$res = $stmt->fetchAll();
		return $res[0]["clientid"];
	}

	/*
	 * Démarre une nouvelle session pour l'utilisateur spécifié
	 */
	public static function start($clientId) {
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$ssid = str_shuffle($chars);
		setcookie("ssid", $ssid);

		$db = Database::get();
		$stmt = $db->prepare("INSERT INTO session VALUES (?, ?)");

		return $db->execute([$clientId, $ssid]);
	}

}
