<?php

require_once "http_response.php";

/*
 * Charger un fichier de "vue", charger les variables du tableau $vars
 * afin qu'elles soit accessible depuis la vue
 */
function render($view, $vars = []) {
	if(isset($vars["view"])) {
		unset($vars["view"]);
	}
	if(!isset($vars["title"])) {
		$vars["title"] = "Cinema";
	}

	foreach($vars as $k => $v) {
		$vars[$k] = htmlspecialchars($v, ENT_QUOTES, "UTF-8");
	}

	extract($vars);
	include "views/base.php";
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
