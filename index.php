<?php

require_once "system/router.php";

define("WEBROOT", "http://127.0.0.1:8000/webroot");

$router = new Router();

$router->get("/", function($request) {
	render("views/index.php");
});

$router->get("/film/{id}", function($request) {
	$id =  $request->getVar("id");
	render("views/film.php", ["id" => $id]);
});

$response = $router->process(HttpRequest::get());
$response->send();
