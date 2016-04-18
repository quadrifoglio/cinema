<?php

require_once "system/router.php";

$router = new Router();

$router->get("/", function($request) {
	render("views/index.php");
});

$router->get("/films", function($request) {
	render("views/films.php");
});

$router->get("/film/{id}", function($request) {
	$id =  $request->getVar("id");
	render("views/film.php", ["id" => $id]);
});

$response = $router->process(HttpRequest::get());
$response->send();
