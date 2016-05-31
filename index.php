<?php

require_once "system/router.php";
require_once "system/session.php";

require_once "app/index.php";
require_once "app/film.php";
require_once "app/admin.php";

define("WEBROOT", "http://cinema.tabarnouche.wha.la/webroot");

$router = new Router();

$router->get("/", $index);
$router->get("/film/{id}", $filmId);
$router->get("/admin", $admin);

$response = $router->process(HttpRequest::get());
$response->send();
