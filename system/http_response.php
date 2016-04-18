<?php

class HttpResponse {

	/*
	 * Correspondance entre code de statut et message de statut
	 * (Foutu protocole HTTP...)
	 */
	private static $statusMessage = [
		200 => "OK",
		201 => "Created",
		202 => "Accepted",
		301 => "Moved Permanently",
		302 => "Moved Temporarily",
		400 => "Bad Request",
		403 => "Forbidden",
		404 => "Not Found",
		405 => "Method Not Allowed"
		// TODO: Add missing values (https://en.wikipedia.org/wiki/List_of_HTTP_status_codes)
	];

	public $status;       // Code de statut HTTP (200, 404...)
	public $headers = []; // En-têtes de réponse HTTP
	public $body;         // Contenu de la réponse

	public function __construct($status, $body) {
		$this->status = $status;
		$this->body = $body;
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

	public function send() {
		// Envoi de la "status line" HTTP
		header("HTTP/1.1 " . $this->status . " " . HttpResponse::$statusMessage[$this->status]);

		// Envoi des headers HTTP
		foreach($this->headers as $name => $value) {
			header($name . ": " . $value);
		}

		// Envoi du "body" de la réponse HTTP, prévention XSS
		echo htmlspecialchars($this->body, ENT_QUOTES, "UTF-8");
	}

}
