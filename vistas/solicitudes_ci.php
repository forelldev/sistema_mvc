<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se han encontrado otras solicitudes</title>
</head>
<body>
    <section class="solicitudes-lista">
        <h1 class="mensaje"><?= isset($msj) ? htmlspecialchars($msj) : '' ?></h1>
    <?php if (!empty($datos)): ?>
                <?php foreach ($datos as $fila): ?>
                    <div class="solicitud-card">
                        <div class="solicitud-header">
                            <span class="solicitud-estado 
                                <?php
                                    $estado = htmlspecialchars($fila['estado'] ?? '');
                                    if ($estado == 'En espera del documento físico para ser procesado 0/3') echo 'pendiente';
                                    else if ($estado == 'En Proceso 1/3') echo 'activo1';
                                    else if ($estado == 'En Proceso 2/3') echo 'activo2';
                                    else if ($estado == 'En Proceso 3/3 (Sin entregar)') echo 'activo3';
                                    else if ($estado == 'Solicitud Finalizada (Ayuda Entregada)') echo 'finalizada';
                                    else if ($estado == 'Documento inválido') echo 'invalido';
                                ?>">
                                <?= $estado ?>
                            </span>
                            <div><strong>Fecha:</strong> <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha']))) ?></div>
                        </div>
                        <div class="solicitud-info">
                            <div><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></div>
                            <div><strong>Tipo de ayuda:</strong> <?= htmlspecialchars($fila['tipo_ayuda']) ?></div>
                            <div><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></div>
                            <div><strong>ID Manual:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></div>
                            <div><strong>CI:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></div>
                            <div><strong>Remitente:</strong> <?= htmlspecialchars($fila['remitente'] ?? '') ?></div>
                            <div><strong>Observaciones:</strong> <?= htmlspecialchars($fila['observaciones'] ?? '') ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="solicitud-card">
                    <div class="solicitud-header">
                        <span class="solicitud-estado">Sin información</span>
                    </div>
                    <div class="solicitud-info">
                        No hay información disponible.
                    </div>
                </div>
            <?php endif; ?>
        </section>
    <form action="solicitudes_ci" method="POST">
        <input type="submit" value="Registrar Solicitud">
        <input type="hidden" name="ci" value="<?= $ci ?>">
    </form>
    <a href="<?=BASE_URL?>/">Volver (No registrar)</a>
</body>
</html>