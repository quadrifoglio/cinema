<?php

define("ROUTER_PREFIX", "");
define("WEBROOT", "http://cinema.tabarnouche.wha.la/webroot");

require_once "system/router.php";
require_once "app/index.php";
require_once "app/film.php";
require_once "app/book.php";
require_once "app/login.php";
require_once "app/client.php";
require_once "app/admin.php";

$router = new Router();

$router->get("/", $index);
$router->get("/film/{id}", $film);
$router->get("/random", $random);

$router->get("/book/{id}", $book);
$router->post("/book/action/{id}", $bookAction);
$router->get("/book/cancel/{id}", $bookCancel);

$router->get("/register", $register);
$router->get("/login", $login);
$router->post("/login", $loginPost);
$router->get("/logout", $logout);

$router->get("/client", $clientPanel);
$router->get("/admin", $admin);

$response = $router->process(HttpRequest::get());
$response->send();
