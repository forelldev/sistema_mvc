<?php
// routes.php
Router::get('/', 'loginControl@index'); // RUTA PARA LOGIN CUANDO NO ESTÁS LOGEADO ES LO PRIMERO
Router::get('/registro', 'loginControl@registroIndex'); //RUTA PARA REGISTRO
Router::post('/login', 'loginControl@ingresar'); //RUTA PARA CUANDO SE PRESIONE LOGIN, ESTA ES LA FUNCIÓN DE LOGEARSE
Router::post('/registro', 'loginControl@registro'); //RUTA PARA LA FUNCIÓN DE REGISTRARSE
Router::get('/main', 'loginControl@main'); //RUTA PARA LA VISTA MAIN
Router::get('/logout','loginControl@logout'); //RUTA PARA DESLOGEARSE, SALIR
Router::get('/validar-sesion', 'loginControl@validarSesionAjax'); //RUTA PARA VALIDAR SESIÓN (EN CONJUNTO CON JAVASCRIPT)
Router::get('/solicitudes_list','solicitudControl@lista'); //RUTA PARA LA VISTA DE SOLICITUDES_LIST Y A LA MISMA VEZ MOSTRAR LA TABLA SOLICITUD_AYUDA
Router::get('/busqueda','solicitudControl@busquedaVista'); //RUTA PARA BUSQUEDA VISTA, PARA LA CEDULA ANTES DE RELLENAR FORMULARIO
Router::post('/buscar_cedula','solicitudControl@buscar'); // RUTA PARA FUNCIÓN DE BUSCAR CEDULA EN TABLA SOLICITANTE
Router::get('/formulario','solicitudControl@formulario'); //RUTA PARA VISTA DEL FORMULARIO, LO QUE SE TIENE QUE ENVIAR PARA LA SOLICITUD
Router::post('/enviarFormulario','solicitudControl@enviarFormulario');//RUTA PARA FUNCIÓN DE ENVIAR FORMULARIO A TODAS LAS TABLAS INFORMACIÓN
Router::get('/felicidades','solicitudControl@felicidades'); //RUTA PARA QUE EN CASO DE HABER SUBIDO CON ÉXITO EL FORMULARIO, FELICIDADES AQUÍ
Router::get('/procesar','solicitudControl@procesar');//RUTA PARA PROCESAR LAS SOLICITUDES(ENVIAR A DESPACHO,ADMINISTRACIÓN)
Router::get('/inhabilitar','solicitudControl@inhabilitar');
Router::post('/inhabilitar_solicitud','solicitudControl@inhabilitar_solicitud');
Router::get('/inhabilitados_lista','solicitudControl@inhabilitados_lista');
Router::get('/editar','solicitudControl@editar');
Router::post('/editar_solicitud','solicitudControl@editar_solicitud');
?>