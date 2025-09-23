<?php
// routes.php
Router::get('/', 'LoginControl@index'); // RUTA PARA LOGIN CUANDO NO ESTÁS LOGEADO ES LO PRIMERO
Router::post('/login', 'LoginControl@ingresar'); //RUTA PARA CUANDO SE PRESIONE LOGIN, ESTA ES LA FUNCIÓN DE LOGEARSE
Router::get('/registro', 'LoginControl@registroIndex'); //RUTA PARA REGISTRO VISTA
Router::post('/registro', 'LoginControl@registro'); //RUTA PARA LA FUNCIÓN DE REGISTRARSE
Router::get('/main', 'LoginControl@main'); //RUTA PARA LA VISTA MAIN
Router::get('/logout','LoginControl@logout'); //RUTA PARA DESLOGEARSE, SALIR
Router::get('/validar-sesion', 'LoginControl@validarSesionAjax'); //RUTA PARA VALIDAR SESIÓN (EN CONJUNTO CON JAVASCRIPT)
Router::get('/noti', 'LoginControl@solicitud_notificacion'); 
Router::get('/marcar_vistas', 'LoginControl@marcar_vistas');
Router::get('/marcar_vistasDespacho', 'LoginControl@marcar_vistasDespacho'); 
Router::get('/solicitudes_list','SolicitudControl@lista'); //RUTA PARA LA VISTA DE SOLICITUDES_LIST Y A LA MISMA VEZ MOSTRAR LA TABLA SOLICITUD_AYUDA
Router::get('/busqueda','SolicitudControl@busquedaVista'); //RUTA PARA BUSQUEDA VISTA, PARA LA CEDULA ANTES DE RELLENAR FORMULARIO
Router::post('/buscar_cedula','SolicitudControl@buscar'); // RUTA PARA FUNCIÓN DE BUSCAR CEDULA EN TABLA SOLICITANTE
Router::get('/formulario','SolicitudControl@formulario'); //RUTA PARA VISTA DEL FORMULARIO, LO QUE SE TIENE QUE ENVIAR PARA LA SOLICITUD
Router::post('/enviarFormulario','SolicitudControl@enviarFormulario');//RUTA PARA FUNCIÓN DE ENVIAR FORMULARIO A TODAS LAS TABLAS INFORMACIÓN
Router::get('/felicidades','SolicitudControl@felicidades'); //RUTA PARA QUE EN CASO DE HABER SUBIDO CON ÉXITO EL FORMULARIO, FELICIDADES AQUÍ
Router::get('/procesar','SolicitudControl@procesar');//RUTA PARA PROCESAR LAS SOLICITUDES(ENVIAR A DESPACHO,ADMINISTRACIÓN)
Router::get('/beneficiario_info','SolicitudControl@beneficiario_info');
Router::get('/inhabilitar','SolicitudControl@inhabilitar');
Router::post('/inhabilitar_solicitud','SolicitudControl@inhabilitar_solicitud');
Router::get('/inhabilitados_lista','SolicitudControl@inhabilitados_lista');
Router::get('/habilitar','SolicitudControl@habilitar');
Router::get('/editar','SolicitudControl@editar');
Router::post('/editar_solicitud','SolicitudControl@editar_solicitud');
Router::get('/filtrar','SolicitudControl@filtrar');
Router::post('/filtrar_fecha','SolicitudControl@filtrar_fecha');
Router::post('/buscar_cidespacho','DespachoControl@buscar');
Router::post('/despacho_enviarForm','DespachoControl@enviarFormulario');
Router::get('/despacho_list','DespachoControl@despacho_list');
Router::get('/procesarDespacho','DespachoControl@procesar');
Router::get('/inhabilitados_despacho','DespachoControl@inhabilitados_lista');
Router::get('/inhabilitarDespacho','DespachoControl@inhabilitar');
Router::post('/inhabilitar_solicitudDespacho','DespachoControl@inhabilitar_solicitud');
Router::get('/habilitarDespacho','DespachoControl@habilitar');
Router::get('/beneficiario_infoDespacho','DespachoControl@beneficiario_info');
Router::get('/editarDespacho','DespachoControl@editar');
Router::post('/editar_solicitudDespacho','DespachoControl@editar_solicitud');
Router::get('/reportes','ReportesControl@reportes_entradas');
Router::post('/fecha_reportes','ReportesControl@filtrar_fecha');
Router::get('/reportes_acciones','ReportesControl@reportes_acciones');
Router::post('/filtro_acciones','ReportesControl@filtrar_acciones');
Router::get('/limites','ReportesControl@limites');
Router::get('/limite_editar','ReportesControl@edit_limite');
Router::post('/consulta_limite','ReportesControl@consulta_limite');
Router::get('/informacion_beneficiario','BeneficiarioControl@mostrar');
Router::get('/estadisticas','EstadisticasControl@estadisticas');
?>