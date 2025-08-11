<?php
// routes.php
Router::get('/', 'loginControl@index'); // RUTA PARA LOGIN CUANDO NO ESTÁS LOGEADO ES LO PRIMERO
Router::post('/login', 'loginControl@ingresar'); //RUTA PARA CUANDO SE PRESIONE LOGIN, ESTA ES LA FUNCIÓN DE LOGEARSE
Router::get('/registro', 'loginControl@registroIndex'); //RUTA PARA REGISTRO VISTA
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
Router::get('/beneficiario_info','solicitudControl@beneficiario_info');
Router::get('/inhabilitar','solicitudControl@inhabilitar');
Router::post('/inhabilitar_solicitud','solicitudControl@inhabilitar_solicitud');
Router::get('/inhabilitados_lista','solicitudControl@inhabilitados_lista');
Router::get('/habilitar','solicitudControl@habilitar');
Router::get('/editar','solicitudControl@editar');
Router::post('/editar_solicitud','solicitudControl@editar_solicitud');
Router::post('/buscar_cidespacho','despachoControl@buscar');
Router::post('/despacho_enviarForm','despachoControl@enviarFormulario');
Router::get('/despacho_list','despachoControl@despacho_list');
Router::get('/procesarDespacho','despachoControl@procesar');
Router::get('/inhabilitados_despacho','despachoControl@inhabilitados_lista');
Router::get('/inhabilitarDespacho','despachoControl@inhabilitar');
Router::post('/inhabilitar_solicitudDespacho','despachoControl@inhabilitar_solicitud');
Router::get('/habilitarDespacho','despachoControl@habilitar');
Router::get('/beneficiario_infoDespacho','despachoControl@beneficiario_info');
Router::get('/editarDespacho','despachoControl@editar');
Router::post('/editar_solicitudDespacho','despachoControl@editar_solicitud');
?>