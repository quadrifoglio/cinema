<?php

require_once "http_response.php";

/*
 * Envoi d'un message simple
 */
function message($message) {
	return new HttpResponse(200, $message);
}

/*
 * Envoi d'une erreur (avec un statut HTTP spécifié)
 */
function error($status, $message) {
	// TODO: Render a nice error view
	return new HttpResponse($status, $message);
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
