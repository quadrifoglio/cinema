<?php

require_once "system/router.php";

define("WEBROOT", "http://cinema.tabarnouche.wha.la/webroot");

$router = new Router();

$router->get("/", function($request) {
	render("views/index.php");
});

$router->get("/film/{id}", function($request) {
	$id =  $request->getVar("id");
	render("views/film.php", ["id" => $id]);
});

$router->get("/admin", function($request) {
	render("views/admin.php", [], false);
});

$response = $router->process(HttpRequest::get());
$response->send();
