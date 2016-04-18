<?php

class HttpRequest {

	public $method;    // Méthode HTTP
	public $uri;       // URI
	public $headers;   // Headers HTTP
	public $body;      // Contenu
	public $vars = []; // Variables d'URI (voir classe Router)

	public function __construct($method, $uri, $body) {
		$this->method = $method;
		$this->uri = htmlentities($uri);
		$this->body = htmlentities($body);
	}

	/*
	 * Ajoute/modifie une en-tête HTTP
	 */
	public function setHeader($name, $value) {
		$this->headers[$name] = $value;
	}

	/*
	 * Retourne la valeur d'une en-tête HTTP
	 */
	public function getHeader($name) {
		return $this->headers[$name];
	}

	/*
	 * Ajoute/modifie une variable d'URI
	 */
	public function setVar($key, $value) {
		$this->vars[$key] = $value;
	}

	/*
	 * Retourne la valeur d'une variable d'URI
	 */
	public function getVar($key) {
		return $this->vars[$key];
	}

	/*
	 * Retourne la requête HTTP effectuée par le client
	 */
	public static function get() {
		$request = new HttpRequest($_SERVER["REQUEST_METHOD"], $_SERVER["REQUEST_URI"], null);

		foreach(getallheaders() as $name => $value) {
			$request->setHeader($name, $value);
		}

		return $request;
	}

}
