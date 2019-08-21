<?php
ini_set("display_errors",1);
define("DSN","mysql:dbhost=localhost;dbname=myportforio_2");
define("DB_USER","*********");
define("DB_PASSWORD","********");
require_once(__DIR__."/../lib/functions.php");
require_once(__DIR__."/autoload.php");


session_start();

