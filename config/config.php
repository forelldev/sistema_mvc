<?php
// Verifica si la sesión ya está iniciada antes de llamar a session_start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Define rutas base
define('BASE_URL', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_PATH', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/'); // Para JavaScript
?>
