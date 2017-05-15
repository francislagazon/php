<?php
/*
Author: Francis Lagazon
*/

/* DATABASE CONFIG */
define("DB_HOST", "");
define("DB_NAME", "");
define("DB_USER", "");
define("DB_PASS", "");

/* PATHS CONFIG */
define("CSS", "public/css");
define("JS", "public/js");

require "libs/Database.php";
require "libs/Auth.php";
require "libs/Session.php";

$db = new Database();
$auth = new Auth();
Session::init();
