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
Router::get('/busqueda','solicitudControl@busquedaVista');
Router::post('/solicitud_registro','solicitudControl@buscar');
Router::get('/solicitud_registro','solicitudControl@formulario');
Router::post('/solicitud_formulario','solicitudControl@enviarFormulario');
Router::get('/felicidades','solicitudControl@felicidades');
?>