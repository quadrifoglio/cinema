<?php

define("ROUTER_PREFIX", "");
define("WEBROOT", "http://cinema.toh.info/webroot");

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
$router->post("/register", $registerPost);
$router->get("/login", $login);
$router->post("/login", $loginPost);
$router->get("/client", $clientPanel);
$router->get("/logout", $logout);

$router->get("/admin", $adminDash);

$router->get("/admin/films", $adminFilms);
$router->post("/admin/films", $adminFilmPost);
$router->post("/admin/films/{id}", $adminFilmPost);
$router->post("/admin/films/person/add", $adminFilmPersonAdd);
$router->post("/admin/films/staff/add/{id}", $adminFilmStaffAdd);
$router->post("/admin/films/staff/delete/{id}", $adminFilmStaffDel);
$router->get("/admin/films/delete/{id}", $adminFilmDel);

$router->get("/admin/screenings", $adminScreenings);
$router->post("/admin/screenings/room/add", $adminScreeningsRoomAdd);
$router->get("/admin/screenings/room/delete/{id}", $adminScreeningsRoomDel);
$router->post("/admin/screenings/add", $adminScreeningsAdd);
$router->get("/admin/screenings/delete/{id}", $adminScreeningsDel);

$router->get("/admin/rates", $adminRates);
$router->post("/admin/rates", $adminRatePost);
$router->get("/admin/rates/delete/{id}", $adminRateDel);

$response = $router->process(HttpRequest::get());
$response->send();
