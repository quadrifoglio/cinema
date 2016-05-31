<?php

require_once "system/session.php";

$admin = function($request) {
	Session::start();
	render("views/admin.php", [], false);
};
