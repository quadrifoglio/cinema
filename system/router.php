<?php

require_once "utils.php";
require_once "http_request.php";
require_once "http_response.php";

class Router {

	private $routes = [];

	/*
	 * Ajouter une réponse pour une requête GET
	 */
	public function get($path, $cb) {
		$this->route("GET", $path, $cb);
	}

	/*
	 * Ajouter une réponse pour une requête POST
	 */
	public function post($path, $cb) {
		$this->route("POST", $path, $cb);
	}

	/*
	 * Ajouter une réponse pour une requête PUT
	 */
	public function put($path, $cb) {
		$this->route("PUT", $path, $cb);
	}

	/*
	 * Ajouter une réponse pour une requête DELETE
	 */
	public function delete($path, $cb) {
		$this->route("DELETE", $path, $cb);
	}

	/*
	 * Ajouter une réponse HTTP
	 */
	public function route($method, $path, $cb) {
		$route = [
			"method" => $method,           // Methode HTTP à laquelle la route répond
			"path" => explode("/", $path), // Chemin de la route, sous force de tableau
			"callback" => $cb,             // Fonction à apeller si la route est empruntée
			"vars" => []                   // Variables d'URI de la route (syntaxe: {nom})
		];

		// Déterminer si des variables d'URI sont présentes dans la route
		$vars = []; // Contient en clé les index des variables d'URI
		$index = 0;
		for($i = 0; $i < count($route["path"]); $i++) {
			$s = $route["path"][$i];

			if(isset($s[0]) && $s[0] == "{") {
				$end = strpos($s, "}"); // Détermination de la fin du nom de la variable d'URI
				if(!$end) {
					// Erreur de syntaxe dans l'URI de la route, pas de caractère '}'
					fatal("Erreur de syntaxe dans la route '" . $path . "'");
				}

				$route["vars"][$i] = substr($s, 1, $end - 1); // Enregistrement du nom de la variable d'URI
			}
		}

		$this->routes[] = $route;
	}

	public function process($request) {
		$response = error(404, "Page introuvable");

		if(strlen(ROUTER_PREFIX) > 0) {
			$request->uri = str_replace(ROUTER_PREFIX, "", $request->uri);
		}

		foreach($this->routes as $route) {
			$parts = explode("/", $request->uri); // URI de la requête sous forme de tableau

			if(count($parts) != count($route["path"])) {
				// La route ne peut pas correspondre
				continue;
			}

			$method = $route["method"];
			$path = $route["path"];
			$cb = $route["callback"];
			$vars = $route["vars"];

			// Placement des valeurs des variables d'URI
			if(count($vars) != 0) {
				$index = 0;
				for($i = 0; $i < count($parts); $i++) {
					if(array_key_exists($i, $vars)) {
						$path[$i] = $parts[$i];
					}
				}
			}

			// Vérification de la correspondance de la route
			if(count(array_diff($parts, $path)) == 0) {
				if($method != $request->method) {
					continue;
				}

				// Enregistrement des variables d'URI
				foreach($vars as $k => $v) {
					$request->setVar($v, $parts[$k]);
				}

				ob_start(); // Démarrage du buffering (récupération des sorties)

				// Appel du callback de la route
				$response = $cb($request);
				if(!is_object($response)) {
					$response = new HttpResponse(200);
				}

				if($response->isEmpty()) {
					$response->setBody(ob_get_clean()); // Récupération du buffer
				}
				else {
					ob_end_flush();
				}

				return $response;
			}
		}

		return $response;
	}

}
