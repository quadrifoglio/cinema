<?php

require_once "system/router.php";

require_once "app/index.php";
require_once "app/film.php";
require_once "app/book.php";
require_once "app/login.php";
require_once "app/client.php";
require_once "app/admin.php";

define("WEBROOT", "http://cinema.tabarnouche.wha.la/webroot");

$router = new Router();

$router->get("/", $index);
$router->get("/film/{id}", $film);

$router->get("/book/{id}", $book);
$router->get("/book/cancel/{id}", $bookCancel);
$router->post("/book", $bookAction);

$router->post("/login", $login);
$router->get("/logout", $logout);

$router->get("/client", $clientPanel);
$router->get("/admin", $admin);

$response = $router->process(HttpRequest::get());
$response->send();
