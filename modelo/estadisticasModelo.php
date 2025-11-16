<?php
require_once 'conexiondb.php';
class EstadisticasModelo{
   public static function estadisticas_mostrar(){
        $conexion = DB::conectar();
        try {
            // Lista de estados monitoreados
            $estados = [
                'En espera del documento físico para ser procesado 0/3',
                'En Proceso 1/3',
                'En Proceso 2/3',
                'En Proceso 3/3 (Sin Entregar)',
                'Solicitud Finalizada (Ayuda Entregada)'
            ];

            // Construye placeholders para IN (...)
            $placeholders = implode(',', array_fill(0, count($estados), '?'));

            // Consulta: por estado (válido/invalid/total) + fila TOTAL
            $sql = "
                SELECT estado,
                    SUM(CASE WHEN COALESCE(invalido,0) = 0 THEN 1 ELSE 0 END) AS total_valido,
                    SUM(CASE WHEN COALESCE(invalido,0) = 1 THEN 1 ELSE 0 END) AS total_invalido,
                    COUNT(*) AS total_general
                FROM solicitud_ayuda
                WHERE estado IN ($placeholders)
                GROUP BY estado

                UNION ALL

                SELECT 'TOTAL' AS estado,
                    SUM(CASE WHEN COALESCE(invalido,0) = 0 THEN 1 ELSE 0 END) AS total_valido,
                    SUM(CASE WHEN COALESCE(invalido,0) = 1 THEN 1 ELSE 0 END) AS total_invalido,
                    COUNT(*) AS total_general
                FROM solicitud_ayuda
                WHERE estado IN ($placeholders)
            ";

            $stmt = $conexion->prepare($sql);

            // Bind de estados para ambos bloques (dos veces)
            $params = array_merge($estados, $estados);
            foreach ($params as $i => $valor) {
                $stmt->bindValue($i + 1, $valor, PDO::PARAM_STR);
            }

            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Ordena: estados en el orden definido y luego la fila TOTAL
            $ordenDeseado = array_merge($estados, ['TOTAL']);
            usort($resultados, function($a, $b) use ($ordenDeseado) {
                return array_search($a['estado'], $ordenDeseado) <=> array_search($b['estado'], $ordenDeseado);
            });

            return [
                'exito' => true,
                'datos' => $resultados
            ];
        } catch (Exception $e) {
            error_log("Error al obtener estadísticas de solicitud_ayuda: " . $e->getMessage());
            return [
                'exito' => false,
                'error' => $e->getMessage()
            ];
        }
    }


    public static function estadisticas_despacho(){
        $conexion = DB::conectar();
        try {
            $stmt = $conexion->prepare("
                SELECT estado,
                    SUM(CASE WHEN COALESCE(invalido,0) = 0 THEN 1 ELSE 0 END) AS total_valido,
                    SUM(CASE WHEN COALESCE(invalido,0) = 1 THEN 1 ELSE 0 END) AS total_invalido,
                    COUNT(*) AS total_general
                FROM despacho
                WHERE estado IN (
                    'En Revisión 1/2',
                    'En Proceso 2/2',
                    'En Proceso 2/2 (Sin Entregar)',
                    'Solicitud Finalizada (Ayuda Entregada)'
                )
                GROUP BY estado

                UNION ALL

                SELECT 'TOTAL' AS estado,
                    SUM(CASE WHEN COALESCE(invalido,0) = 0 THEN 1 ELSE 0 END) AS total_valido,
                    SUM(CASE WHEN COALESCE(invalido,0) = 1 THEN 1 ELSE 0 END) AS total_invalido,
                    COUNT(*) AS total_general
                FROM despacho
                WHERE estado IN (
                    'En Revisión 1/2',
                    'En Proceso 2/2',
                    'En Proceso 2/2 (Sin Entregar)',
                    'Solicitud Finalizada (Ayuda Entregada)'
                )
            ");

            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'exito' => true,
                'datos' => $resultados
            ];
        } catch (Exception $e) {
            error_log("Error al obtener estadísticas de despacho: " . $e->getMessage());
            return [
                'exito' => false,
                'error' => $e->getMessage()
            ];
        }
    }

public static function estadisticas_desarrollo(){
    $conexion = DB::conectar();
    try {
        $stmt = $conexion->prepare("
            SELECT estado,
                   SUM(CASE WHEN COALESCE(invalido,0) = 0 THEN 1 ELSE 0 END) AS total_valido,
                   SUM(CASE WHEN COALESCE(invalido,0) = 1 THEN 1 ELSE 0 END) AS total_invalido,
                   COUNT(*) AS total_general
            FROM solicitud_desarrollo
            WHERE estado IN (
                'En espera del documento físico para ser procesado 0/2',
                'En Proceso 1/2',
                'En Proceso 2/2 (Sin Entregar)',
                'Solicitud Finalizada (Ayuda Entregada)'
            )
            GROUP BY estado

            UNION ALL

            SELECT 'TOTAL' AS estado,
                   SUM(CASE WHEN COALESCE(invalido,0) = 0 THEN 1 ELSE 0 END) AS total_valido,
                   SUM(CASE WHEN COALESCE(invalido,0) = 1 THEN 1 ELSE 0 END) AS total_invalido,
                   COUNT(*) AS total_general
            FROM solicitud_desarrollo
            WHERE estado IN (
                'En espera del documento físico para ser procesado 0/2',
                'En Proceso 1/2',
                'En Proceso 2/2 (Sin Entregar)',
                'Solicitud Finalizada (Ayuda Entregada)'
            )
        ");

        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'exito' => true,
            'datos' => $resultados
        ];
    } catch (Exception $e) {
        error_log("Error al obtener estadísticas de solicitud_desarrollo: " . $e->getMessage());
        return [
            'exito' => false,
            'error' => $e->getMessage()
        ];
    }
}


}

?>