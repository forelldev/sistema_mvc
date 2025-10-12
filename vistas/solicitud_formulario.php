<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Ayuda Formulario</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body class="solicitud-body">
    <header class="header">
        <div class="titulo-header">Formulario de solicitud de ayuda</div>
        <div class="header-right">
            <a href="<?=BASE_URL?>/solicitudes_list"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver</button></a>
        </div>
    </header>
    <main>
        <form action="<?=BASE_URL?>/enviarFormulario" method="POST" class="formulario-ayuda" autocomplete="off">
            <h2><i class="fa fa-hands-helping"></i> Solicitud de Ayuda</h2>
            <div class="titulo-seccion"><i class="fa fa-user"></i> Datos Personales</div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $datos_beneficiario['solicitante']['nombre'] ?? '' ?>" required>
                </div>
                <div class="campo-formulario">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" value="<?= $datos_beneficiario['solicitante']['apellido'] ?? '' ?>" required>
                </div>
                <div class="campo-formulario">
                    <label for="correo">Correo:</label>
                    <input type="text" id="correo" name="correo" value="<?= $datos_beneficiario['solicitante']['correo'] ?? '' ?>" required>
                </div>
            </div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $datos_beneficiario['info']['fecha_nacimiento'] ?? '' ?>" required>
                    <input type="hidden" id="edad" name="edad" value="<?= $datos_beneficiario['info']['edad'] ?? '' ?>">
                </div>
                <div class="campo-formulario">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" value="<?= $datos_beneficiario['info']['telefono'] ?? '' ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
            </div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="lugar_nacimiento">Lugar de Nacimiento:</label>
                    <input type="text" id="lugar_nacimiento" name="lugar_nacimiento" value="<?= $datos_beneficiario['info']['lugar_nacimiento'] ?? '' ?>" required>
                </div>
                <div class="campo-formulario">
                    <label for="estado_civil">Estado Civil:</label>
                    <select name="estado_civil" id="estado_civil" required>
                        <option value="Soltero/a" <?= ($datos_beneficiario['info']['estado_civil'] ?? '') == 'Soltero/a' ? 'selected' : '' ?>>Soltero/a</option>
                        <option value="Casado/a" <?= ($datos_beneficiario['info']['estado_civil'] ?? '') == 'Casado/a' ? 'selected' : '' ?>>Casado/a</option>
                        <option value="Viudo/a" <?= ($datos_beneficiario['info']['estado_civil'] ?? '') == 'Viudo/a' ? 'selected' : '' ?>>Viudo/a</option>
                    </select>
                </div>
            </div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="codigo_patria">Código de Patria:</label>
                    <input type="text" id="codigo_patria" name="codigo_patria" value="<?= $datos_beneficiario['extra']['codigo_patria'] ?? '' ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
                <div class="campo-formulario">
                    <label for="serial_patria">Serial de Patria:</label>
                    <input type="text" id="serial_patria" name="serial_patria" value="<?= $datos_beneficiario['extra']['serial_patria'] ?? '' ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
            </div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="nivel_instruc">Nivel de Instrucción:</label>
                    <select name="nivel_instruc" id="nivel_instruc" required>
                        <option value="Primaria" <?= ($datos_beneficiario['conocimiento']['nivel_instruc'] ?? '') == 'Primaria' ? 'selected' : '' ?>>Primaria</option>
                        <option value="Secundaria" <?= ($datos_beneficiario['conocimiento']['nivel_instruc'] ?? '') == 'Secundaria' ? 'selected' : '' ?>>Secundaria</option>
                        <option value="Universidad" <?= ($datos_beneficiario['conocimiento']['nivel_instruc'] ?? '') == 'Universidad' ? 'selected' : '' ?>>Universidad</option>
                    </select>
                </div>
                <div class="campo-formulario">
                    <label for="profesion">Profesión:</label>
                    <input type="text" id="profesion" name="profesion" value="<?= $datos_beneficiario['conocimiento']['profesion'] ?? '' ?>" required>
                </div>
            </div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="trabajo1">¿Trabaja?</label>
                    <select name="trabajo1" id="trabajo1" required onchange="mostrarCampoTrabajo()">
                        <option value="">Seleccione</option>
                        <option value="Si" <?= (isset($datos_beneficiario['trabajo']['trabajo']) && strtolower($datos_beneficiario['trabajo']['trabajo']) !== 'No tiene') ? 'selected' : '' ?>>Sí</option>
                        <option value="No" <?= (isset($datos_beneficiario['trabajo']['trabajo']) && strtolower($datos_beneficiario['trabajo']['trabajo']) === 'No tiene') ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
                <div class="campo-formulario" id="campoTrabajo" style="display:none; margin-top:10px;">
                    <label for="trabajo">Trabajo:</label>
                    <input type="text" id="trabajo" name="trabajo" value="<?= $datos_beneficiario['trabajo']['trabajo'] ?? '' ?>">
                    <label for="direccion_trabajo">Dirección de Trabajo:</label>
                    <input type="text" id="direccion_trabajo" name="direccion_trabajo" value="<?= $datos_beneficiario['trabajo']['direccion_trabajo'] ?? '' ?>">
                    <label for="trabaja_public">¿Trabaja en el sector público?</label>
                    <select name="trabaja_public" id="trabaja_public" onchange="mostrarInstitucion()">
                        <option value="">Seleccione</option>
                        <option value="Si" <?= ($datos_beneficiario['trabajo']['trabaja_public'] ?? '') == 'Si' ? 'selected' : '' ?>>Sí</option>
                        <option value="No" <?= ($datos_beneficiario['trabajo']['trabaja_public'] ?? '') == 'No' ? 'selected' : '' ?>>No</option>
                    </select>
                    <div id="campoInstitucion" style="display:none; margin-top:10px;">
                        <label for="nombre_insti">Nombre de la Institución:</label>
                        <input type="text" id="nombre_insti" name="nombre_insti" value="<?= $datos_beneficiario['trabajo']['nombre_insti'] ?? '' ?>">
                    </div>
                </div>
            </div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="comunidad">Comunidad:</label>
                    <select name="comunidad" id="comunidad">
                        <option value="">Seleccione su comunidad...</option>
                        <option value="PALMICHAL">PALMICHAL</option>
                        <option value="LA ENSENADA">LA ENSENADA</option>
                        <option value="CUJISAL">CUJISAL</option>
                        <option value="EL CARDON">EL CARDON</option>
                        <option value="AGUA AZUL">AGUA AZUL</option>
                        <option value="ESPARRAMADERO">ESPARRAMADERO</option>
                        <option value="CAJA DE AGUA">CAJA DE AGUA</option>
                        <option value="PRODUCTORES DE CAMPO ALEGRE">PRODUCTORES DE CAMPO ALEGRE</option>
                        <option value="VILLAS DE YARA">VILLAS DE YARA</option>
                        <option value="RENACER DE UN PUEBLO">RENACER DE UN PUEBLO</option>
                        <option value="EL PARAISO">EL PARAISO</option>
                        <option value="DON ANTONIO">DON ANTONIO</option>
                        <option value="MOTOCROSS">MOTOCROSS</option>
                        <option value="ANA SUAREZ CENTRO">ANA SUAREZ CENTRO</option>
                        <option value="LA MAPORITA">LA MAPORITA</option>
                        <option value="EL JAGUEY">EL JAGUEY</option>
                        <option value="SABANA DE TIQUIRE">SABANA DE TIQUIRE</option>
                        <option value="CERRO GRANDE">CERRO GRANDE</option>
                        <option value="TACARIGUITA">TACARIGUITA</option>
                        <option value="REVOLUCION 106">REVOLUCION 106</option>
                        <option value="SIEMPRE ADELANTE 107 SAN JOSE">SIEMPRE ADELANTE 107 SAN JOSE</option>
                        <option value="MAIZANTA">MAIZANTA</option>
                        <option value="CREANDO CONCIENCIA">CREANDO CONCIENCIA</option>
                        <option value="UNIDAD Y ACCION">UNIDAD Y ACCION</option>
                        <option value="MONTAÑITA I">MONTAÑITA I</option>
                        <option value="DANIEL CARIAS Y BANCO OBREROS">DANIEL CARIAS Y BANCO OBREROS</option>
                        <option value="MONTAÑITA III">MONTAÑITA III</option>
                        <option value="BARRIO BOLIVAR">BARRIO BOLIVAR</option>
                        <option value="LA REALIDAD">LA REALIDAD</option>
                        <option value="TEREPAIMA">TEREPAIMA</option>
                        <option value="COLINAS DE TEREPAIMA (VOLUNTAD Y ACCION)">COLINAS DE TEREPAIMA (VOLUNTAD Y ACCION)</option>
                        <option value="BRISAS DE TEREPAIMA">BRISAS DE TEREPAIMA</option>
                        <option value="CASERIO DE CAÑAVERAL">CASERIO DE CAÑAVERAL</option>
                        <option value="SOL BOLIVARIANO">SOL BOLIVARIANO</option>
                        <option value="EL SALTO">EL SALTO</option>
                        <option value="SABANA DE GUREMAL">SABANA DE GUREMAL</option>
                        <option value="QUEBRADA GRANDE">QUEBRADA GRANDE</option>
                        <option value="EL PLAYON">EL PLAYON</option>
                        <option value="BRISAS DEL PEGON">BRISAS DEL PEGON</option>
                        <option value="ARENALES VIA EL SALTO">ARENALES VIA EL SALTO</option>
                        <option value="CAMBURITO SECTOR LA CRISPINERA">CAMBURITO SECTOR LA CRISPINERA</option>
                        <option value="LA FLORIDA">LA FLORIDA</option>
                        <option value="MONTANITA II BICENTENARIO">MONTANITA II BICENTENARIO</option>
                        <option value="II DE SEPTIEMBRE">II DE SEPTIEMBRE</option>
                        <option value="MONTAÑITA INDIO COY ( LIRIOS DEL VALLE)">MONTAÑITA INDIO COY ( LIRIOS DEL VALLE)</option>
                        <option value="LA VICTORIA">LA VICTORIA</option>
                        <option value="YACURAL">YACURAL</option>
                        <option value="TORBELLAN">TORBELLAN</option>
                        <option value="ANIMAS">ANIMAS</option>
                        <option value="UVEDAL">UVEDAL</option>
                        <option value="DON NICOLA">DON NICOLA</option>
                        <option value="EL SARURO">EL SARURO</option>
                        <option value="PUEBLO UNIDO">PUEBLO UNIDO</option>
                        <option value="OVIDIO MARCHAN">OVIDIO MARCHAN</option>
                        <option value="AGUA VIVA">AGUA VIVA</option>
                        <option value="SAN ANTONIO LA TAPA">SAN ANTONIO LA TAPA</option>
                        <option value="BRISAS DE LA TAPA">BRISAS DE LA TAPA</option>
                        <option value="TAPA LA LUCHA">TAPA LA LUCHA</option>
                        <option value="EL POR VENIR">EL POR VENIR</option>
                        <option value="FRANCISCA HERNANDEZ">FRANCISCA HERNANDEZ</option>
                        <option value="FABRICIO SEQUERA/ LA MORA">FABRICIO SEQUERA/ LA MORA</option>
                        <option value="RIVERA SANTA LUCIA">RIVERA SANTA LUCIA</option>
                        <option value="ALDEA LA PAZ">ALDEA LA PAZ</option>
                        <option value="LA FUENTE">LA FUENTE</option>
                        <option value="CANAAN CELESTIAL TIERRA DE DIOS">CANAAN CELESTIAL TIERRA DE DIOS</option>
                        <option value="TOTUMILLO">TOTUMILLO</option>
                        <option value="SAN ROQUE">SAN ROQUE</option>
                        <option value="AMINTA ABREU">AMINTA ABREU</option>
                        <option value="LA VAQUERA BARRIO AJURO">LA VAQUERA BARRIO AJURO</option>
                        <option value="PIEDRA ARRIBA">PIEDRA ARRIBA</option>
                        <option value="PIEDRA CENTRO">PIEDRA CENTRO</option>
                        <option value="SAN ANTONIO - LA PIEDRA">SAN ANTONIO - LA PIEDRA</option>
                        <option value="PUEBLO NUEVO">PUEBLO NUEVO</option>
                        <option value="DON TEODORO">DON TEODORO</option>
                        <option value="TEOLINDA PAEZ">TEOLINDA PAEZ</option>
                        <option value="SANTA EDUVIGE LOS RANCHOS">SANTA EDUVIGE LOS RANCHOS</option>
                        <option value="PAZ BOLIVARIANA">PAZ BOLIVARIANA</option>
                        <option value="SOMOS TODOS">SOMOS TODOS</option>
                        <option value="URBANIZACION ARAGUANEY">URBANIZACION ARAGUANEY</option>
                        <option value="NUEVA ESPERANZA-CRISTO REY">NUEVA ESPERANZA-CRISTO REY</option>
                        <option value="LOS REVOLUCIONARIOS">LOS REVOLUCIONARIOS</option>
                        <option value="VILLA OLIMPICA">VILLA OLIMPICA</option>
                        <option value="RAFAEL RANGEL">RAFAEL RANGEL</option>
                        <option value="SUEÑOS BOLIVARIANOS  SABANITA 1">SUEÑOS BOLIVARIANOS  SABANITA 1</option>
                        <option value="SECTOR LA VIRGEN">SECTOR LA VIRGEN</option>
                        <option value="LA ROCA DE LA SALVACIÓN">LA ROCA DE LA SALVACIÓN</option>
                        <option value="URIBEQUE">URIBEQUE</option>
                        <option value="URBANIZACION SIMON RODRIGUEZ III">URBANIZACION SIMON RODRIGUEZ III</option>
                        <option value="URBANIZACION SIMON RODRIGUEZ I">URBANIZACION SIMON RODRIGUEZ I</option>
                        <option value="SANTA INES">SANTA INES</option>
                        <option value="ALI PRIMERA PLATANALES">ALI PRIMERA PLATANALES</option>
                        <option value="JUAN BERNARDO NAHACA">JUAN BERNARDO NAHACA</option>
                        <option value="LA ORQUIDEA">LA ORQUIDEA</option>
                        <option value="SABANITA 4/ ALI PRIMERA">SABANITA 4/ ALI PRIMERA</option>
                        <option value="VILLA JARDIN">VILLA JARDIN</option>
                        <option value="UNION BOLIVARIANA /BOLIVARIANA 1">UNION BOLIVARIANA /BOLIVARIANA 1</option>
                        <option value="TRICENTENARIA POPULAR">TRICENTENARIA POPULAR</option>
                        <option value="EL PINAL">EL PINAL</option>
                        <option value="EL POZON">EL POZON</option>
                        <option value="LIMONCITO">LIMONCITO</option>
                        <option value="EL CARMELERO">EL CARMELERO</option>
                        <option value="AGUA NEGRA">AGUA NEGRA</option>
                        <option value="AGUA LINDA">AGUA LINDA</option>
                        <option value="ALBARICAL">ALBARICAL</option>
                        <option value="LA PERDOMERA">LA PERDOMERA</option>
                        <option value="LA HILERA">LA HILERA</option>
                        <option value="PEGON PASTOR GARCIA">PEGON PASTOR GARCIA</option>
                        <option value="TRICENTENARIA 1">TRICENTENARIA 1</option>
                        <option value="TERMO YARACUY">TERMO YARACUY</option>
                        <option value="ENCRUCIJADA">ENCRUCIJADA</option>
                        <option value="VALLES DE PEÑA">VALLES DE PEÑA</option>
                        <option value="HATO VIEJO">HATO VIEJO</option>
                        <option value="CAMINO NUEVO">CAMINO NUEVO</option>
                        <option value="SAN RAFAEL">SAN RAFAEL</option>
                        <option value="LOS TUBOS">LOS TUBOS</option>
                        <option value="LOS PATIECITOS">LOS PATIECITOS</option>
                        <option value="POTRERITO">POTRERITO</option>
                        <option value="CAÑADA TEMA">CAÑADA TEMA</option>
                        <option value="EL MILAGRO DE BARRIO AJURO I">EL MILAGRO DE BARRIO AJURO I</option>
                        <option value="BARRIO AJURO LAS 4R">BARRIO AJURO LAS 4R</option>
                        <option value="SAN ANTONIO (LA REVOLUCION DE SAN ANTONIO)">SAN ANTONIO (LA REVOLUCION DE SAN ANTONIO)</option>
                        <option value="EL VAPOR">EL VAPOR</option>
                        <option value="ARENALES( VIA LAS VELAS)">ARENALES( VIA LAS VELAS)</option>
                        <option value="AMIGO TRES CALLEJONES">AMIGO TRES CALLEJONES</option>
                        <option value="GRANVEL">GRANVEL</option>
                        <option value="LAS VELAS CENTRO">LAS VELAS CENTRO</option>
                        <option value="5 Y 7 CASAS">5 Y 7 CASAS</option>
                        <option value="EL PALMAR">EL PALMAR</option>
                        <option value="YUMARITO">YUMARITO</option>
                        <option value="SANTA BARBARA">SANTA BARBARA</option>
                        <option value="SANTA LUCIA">SANTA LUCIA</option>
                        <option value="LA CONCEPCION">LA CONCEPCION</option>
                        <option value="PILCO MAYO">PILCO MAYO</option>
                        <option value="VILLAS SANTA LUCIA">VILLAS SANTA LUCIA</option>
                        <option value="TIAMA">TIAMA</option>
                        <option value="LA BANDERA">LA BANDERA</option>
                        <option value="JOSE GREGORIO AMAYA">JOSE GREGORIO AMAYA</option>
                        <option value="LA TRILLA">LA TRILLA</option>
                        <option value="TIERRA AMARILLA">TIERRA AMARILLA</option>
                        <option value="EL CHIMBORAZO">EL CHIMBORAZO</option>
                        <option value="LA RURAL SECTOR 102">LA RURAL SECTOR 102</option>
                        <option value="EL JOBITO">EL JOBITO</option>
                        </select>
                    </div>
                <div class="campo-formulario">
                    <label for="direc_habita">Dirección de Habitación:</label>
                    <input type="text" id="direc_habita" name="direc_habita" value="<?= $datos_beneficiario['comunidad']['direc_habita'] ?? '' ?>" required>
                </div>
            </div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="estruc_base">Estructura Base:</label>
                    <input type="text" id="estruc_base" name="estruc_base" value="<?= $datos_beneficiario['comunidad']['estruc_base'] ?? '' ?>" required>
                </div>
            </div>
            <div class="titulo-seccion"><i class="fa fa-home"></i> Datos Físicos Ambientales</div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="propiedad">Propiedad</label>
                    <select name="propiedad" id="propiedad" required>
                        <option value="Casa" <?= ($datos_beneficiario['propiedad']['propiedad'] ?? '') == 'Casa' ? 'selected' : '' ?>>Casa</option>
                        <option value="Apartamento" <?= ($datos_beneficiario['propiedad']['propiedad'] ?? '') == 'Apartamento' ? 'selected' : '' ?>>Apartamento</option>
                        <option value="Rancho" <?= ($datos_beneficiario['propiedad']['propiedad'] ?? '') == 'Rancho' ? 'selected' : '' ?>>Rancho</option>
                        <option value="Otro" <?= ($datos_beneficiario['propiedad']['propiedad'] ?? '') == 'Otro' ? 'selected' : '' ?>>Otro</option>
                    </select>
                </div>
                <div class="campo-formulario">
                    <label for="propiedad_est">Estado de Propiedad</label>
                    <select name="propiedad_est" id="propiedad_est" required>
                        <option value="Propia" <?= ($datos_beneficiario['propiedad']['propiedad_est'] ?? '') == 'Propia' ? 'selected' : '' ?>>Propia</option>
                        <option value="Prestada" <?= ($datos_beneficiario['propiedad']['propiedad_est'] ?? '') == 'Prestada' ? 'selected' : '' ?>>Prestada</option>
                        <option value="Alquiler" <?= ($datos_beneficiario['propiedad']['propiedad_est'] ?? '') == 'Alquiler' ? 'selected' : '' ?>>Alquiler</option>
                    </select>
                </div>
            </div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="observaciones">Observaciones:</label>
                    <input type="text" id="observaciones" name="observaciones_propiedad" placeholder="Detalles adicionales relevantes (Opcional)" value="<?= $datos_beneficiario['propiedad']['observaciones_propiedad'] ?? '' ?>">
                </div>
            </div>
            <div class="titulo-seccion"><i class="fa fa-money-bill"></i> Datos Socio-Económicos</div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="nivel_ingreso">Nivel de Ingresos:</label>
                    <input type="text" id="nivel_ingreso" name="nivel_ingreso" placeholder="Ejem: 500 Bs" required value="<?= $datos_beneficiario['ingresos']['nivel_ingreso'] ?? ''  ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                   
                </div>
                <div class="campo-formulario">
                    <label for="pension">¿Recibe Bonos?</label>
                    <select name="pension" id="pension" required>
                        <option value="Si" <?= ($datos_beneficiario['ingresos']['pension'] ?? '') == 'Si' ? 'selected' : '' ?>>Si</option>
                        <option value="No" <?= ($datos_beneficiario['ingresos']['pension'] ?? '') == 'No' ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
                <div class="campo-formulario">
                    <label for="bono">¿Recibe Pensiones?</label>
                    <select name="bono" id="bono" required>
                        <option value="Si" <?= ($datos_beneficiario['ingresos']['bono'] ?? '') == 'Si' ? 'selected' : '' ?>>Si</option>
                        <option value="No" <?= ($datos_beneficiario['ingresos']['bono'] ?? '') == 'No' ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="titulo-seccion"><i class="fa fa-medkit"></i> Datos de Asistencia Médica</div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="tienePatologia">¿Tiene familiares con patología?</label>
                    <select id="tienePatologia" name="tienePatologia" onchange="mostrarNumeroFamiliares()" required>
                        <option value="">Seleccione</option>
                        <option value="si" <?= !empty($datos_beneficiario['patologia']) ? 'selected' : '' ?>>Sí</option>
                        <option value="no" <?= empty($datos_beneficiario['patologia']) ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
            <?php $cantidad = isset($datos_beneficiario['cantidad']) ? $datos_beneficiario['cantidad'] : 0; ?>
            <div class="campo-formulario" id="numeroFamiliaresContainer" style="<?= $cantidad > 0 ? '' : 'display:none;' ?>; margin-top:10px;">
                <label for="numeroFamiliares" name="numeroFamiliares">¿Cuántos familiares?</label>
                <select id="numeroFamiliares" onchange="generarCamposFamiliares()" required>
                    <option value="">Seleccione</option>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <option value="<?= $i ?>" <?= $cantidad == $i ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>

                </div>
            </div>
            <div id="camposFamiliares" style="margin-top:10px;"></div>
            <div class="titulo-seccion"><i class="fa fa-hand-holding-heart"></i> Datos de la Solicitud</div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="id_manual">Número de documento:</label>
                    <input type="text" id="id_manual" name="id_manual" placeholder="00004578" required>
                </div>
                <div class="campo-formulario">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" placeholder="Ejem: Ayuda para silla de ruedas" required>
                </div>
                <div class="campo-formulario">
                    <label for="ci">Cedula de Identidad:</label>
                    <input type="text" id="ci" name="ci" placeholder="Ejem: V-12345678" value="<?= htmlspecialchars($datos_beneficiario['solicitante']['ci'] ?? '') ?>" required>
                </div>
            </div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="tipo_ayuda">Tipo de Ayuda:</label>
                    <select name="tipo_ayuda" id="tipo_ayuda">
                        <option value="Silla de Ruedas">Silla de Ruedas</option>
                        <option value="Silla de Ruedas(Niño)">Silla de Ruedas(Niño)</option>
                        <option value="Andadera">Andadera</option>
                        <option value="Andadera (Niño)">Andadera (Niño)</option>
                        <option value="Bastón 1 Punta">Bastón 1 Punta</option>
                        <option value="Bastón 3 Puntas">Bastón 3 Puntas</option>
                        <option value="Bastón 4 Puntas">Bastón 4 Puntas</option>
                        <option value="Muletas">Muletas</option>
                        <option value="Muletas (Niño)">Muletas (Niño)</option>
                        <option value="Collarín">Collarín</option>
                        <option value="Colchón Anti-escaras">Colchón Anti-escaras</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>
                <div class="campo-formulario">
                    <label for="categoria">Categoría</label>
                    <select name="categoria" id="categoria">
                        <option value="Ayudas Tecnicas" <?= ($categoria ?? '') == 'Ayudas Tecnicas' ? 'selected' : '' ?>>Ayudas Técnicas</option>
                        <!-- <option value="Medicamentos">Medicamentos</option>
                        <option value="Laboratorio">Laboratorio</option>
                        <option value="Enseres">Enseres</option> -->
                        <option value="Economica" <?= ($categoria ?? '') == 'Economico' ? 'selected' : '' ?>>Económica</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>
            </div>
            <div class="fila-formulario">
                <div class="campo-formulario">
                    <label for="remitente">Remitente:</label>
                    <input type="text" id="remitente" name="remitente" placeholder="Ejem: María González" required>
                </div>
                <div class="campo-formulario">
                    <label for="observaciones">Observaciones:</label>
                    <input type="text" id="observaciones_ayuda" name="observaciones" placeholder="Detalles relevantes (Opcional)">
                </div>
            </div>
            <button type="submit" class="boton-enviar-ayuda"><i class="fa fa-paper-plane"></i> Enviar</button>
        </form>
        <h1 class="mensaje"><?= isset($msj) ? htmlspecialchars($msj) : '' ?></h1>
    </main>
</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/public/js/edad.js"></script>
<script src="<?= BASE_URL ?>/public/js/trabajo.js"></script>
<script>
    const tiposPatologiaGuardados = "<?= $tiposJS ?>".split('|');
    const nombresPatologiaGuardados = "<?= $nombresJS ?>".split('|');
    const data_exists = "<?= $data_exists ? '1' : '0' ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/patologia.js"></script>
</html>