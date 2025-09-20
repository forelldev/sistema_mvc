<?php 
session_start();
define('BASE_URL', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_PATH', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/'); // Para JavaScript
?>