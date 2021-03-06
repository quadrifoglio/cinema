<?php

require_once "http_response.php";

/*
 * Formater une date donnée au format PostgreSQL
 */
function formatDate($date) {
	$t = explode("-", $date);
	if(count($t) != 3) {
		return "Date invalide";
	}

	switch($t[1]) {
		case "01":
			$month = "Janvier";
			break;
		case "02":
			$month = "Février";
			break;
		case "03":
			$month = "Mars";
			break;
		case "04":
			$month = "Avril";
			break;
		case "05":
			$month = "Mai";
			break;
		case "06":
			$month = "Juin";
			break;
		case "07":
			$month = "Juillet";
			break;
		case "08":
			$month = "Août";
			break;
		case "09":
			$month = "Septembre";
			break;
		case "10":
			$month = "Octobre";
			break;
		case "11":
			$month = "Novembre";
			break;
		case "12":
			$month = "Décembre";
			break;
		default:
			$month = "WTF";
			break;
	}

	return $t[2] . " " . $month . " " . $t[0];
}

/*
 * Envoyer une réponse de redirection
 */
function redirect($url) {
	header("Location: " . ROUTER_PREFIX . $url);
	exit();
}

/*
 * Sécuriser les sorties
 * Failles XSS
 * @param $data Reference vers l'objet à sécuriser (array ou string)
 */
function secure(&$data) {
	if(is_string($data)) {
		$data = htmlentities($data);
	}
	else if(is_array($data)) {
		foreach($data as $k => $v) {
			secure($data[$k]);
		}
	}
}

/*
 * Charger un fichier de "vue", charger les variables du tableau $vars
 * afin qu'elles soit accessible depuis la vue
 */
function render($view, $vars = [], $base = true) {
	if(isset($vars["view"]))
		unset($vars["view"]);
	if(!isset($vars["title"]))
		$vars["title"] = "Cinema";

	secure($vars);
	extract($vars);

	if($base === true)
		include "views/base.php";
	else if(is_string($base))
		include $base;
	else
		include $view;
}

/*
 * Envoi d'un message simple
 */
function message($message) {
	$response = new HttpResponse(200);
	$response->setBody($message);

	return $response;
}

/*
 * Envoi d'une erreur (avec un statut HTTP spécifié)
 */
function error($status, $message) {
	ob_start();
	render("views/error.php", ["message" => $message]);
	$body = ob_get_clean();

	return new HttpResponse($status, $body);
}

/*
 * Erreur fatale: arrêt du script
 */
function fatal($message) {
	die("Erreur fatale: " . $message);
}

/*
 * Debug d'une variable
 */
function debug($var) {
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
}
