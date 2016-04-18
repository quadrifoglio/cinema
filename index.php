<?php

require_once "system/router.php";

$router = new Router();

$router->get("/", function($request) {
	echo "Index";
});

$router->get("/films", function($request) {
	echo "Films";
});

$router->get("/film/{id}", function($request) {
	echo "Film " . $request->getVar("id");
});

$response = $router->process(HttpRequest::get());
$response->send();
