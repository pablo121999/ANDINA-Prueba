<?php

header('Content-Type: application/json; charset=utf-8');

// Solo permitir el método GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido. Usa GET.']);
    exit;
}

require_once 'bd.php';

try {
    // Conexión a la base de datos
    $database = new Database();
    $db = $database->connect();

    // Query: usuarios registrados en últimos 30 días
    $query = "
        SELECT id, nombre, email, fecha_registro
        FROM usuarios
        WHERE fecha_registro >= DATE_SUB(NOW(), INTERVAL 30 DAY)
        ORDER BY fecha_registro DESC
    ";

    $stmt = $db->prepare($query);
    $stmt->execute();

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($usuarios) === 0) {
        http_response_code(404);
        echo json_encode(['mensaje' => 'No se encontraron usuarios recientes']);
        exit;
    }

    http_response_code(200);
    echo json_encode([
        'total' => count($usuarios),
        'data' => $usuarios
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error al obtener los usuarios',
        'detalle' => $e->getMessage()
    ]);
}


// url API , debe adaptar a tu entorno

// http://localhost/ANDINA-PRUEBA/Secci%C3%B3n%203%20%E2%80%93%20Desarrollo%20Pr%C3%A1ctico/Construccion_API_REST.php

?>