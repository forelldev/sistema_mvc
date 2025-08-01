<?php
// routes.php
Router::get('/', 'loginControl@index');
Router::get('/registro', 'loginControl@registroIndex');
Router::post('/login', 'loginControl@ingresar');
Router::post('/registro', 'loginControl@registro');
Router::get('/main', 'loginControl@main');
Router::get('/logout','loginControl@logout');
Router::get('/validar-sesion', 'loginControl@validarSesionAjax');
Router::get('/solicitudes_list','solicitudControl@lista');
Router::get('/busqueda','solicitudControl@busqueda');
?>