<?php

class Session {

	/*
	 * Vérifier l'existence d'une session utilisateur
	 * Retourne les infos de l'utilisateur si une session existe, false sinon
	 */
	public static function get() {
		$cookie = isset($_COOKIE["ssid"]) ? htmlentities($_COOKIE["ssid"]) : false;
		if(!$cookie) {
			return false;
		}

		$db = Database::get();
		$res = $db->request("SELECT SessionClientRef FROM session WHERE SessionID = ? LIMIT 1", [$cookie]);
		if(!$res) {
			return false;
		}

		if(count($res) == 1) {
			return $db->request("SELECT * FROM client WHERE ClientID = ?", [$res[0]["sessionclientref"]])[0];
		}

		return false;
	}

	/*
	 * Retourne true si la session courante est admin
	 */
	public static function admin() {
		$ss = Session::get();
		if(!$ss) {
			return false;
		}

		return $ss["clientadmin"] == 1;
	}

	/*
	 * Démarre une nouvelle session pour l'utilisateur spécifié
	 * @param $clientId ID du client pour lequel une session doit être crée
	 */
	public static function start($clientId) {
		$delay = 604800;
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789,-";

		srand((double)microtime() * 1000000);
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

	/*
	 * Supprime la session spécifiée
	 * @param $clientId ID du client dont la session doit être supprimée
	 */
	public static function remove($clientId) {
		$db = Database::get();
		$db->request("DELETE FROM session WHERE SessionClientRef = ?", [$clientId]);
	}

}
