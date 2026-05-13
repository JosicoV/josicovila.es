<?php
// Establecer cabecera JSON
header('Content-Type: application/json; charset=utf-8');

// Obtener término de búsqueda (usamos GET para simplicidad AJAX)
$searchTerm = isset($_GET['term']) ? trim($_GET['term']) : '';

// Si el término está vacío, devolver un array vacío
if (empty($searchTerm)) {
    echo json_encode([]);
    exit;
}

// Incluir la estructura de datos
include_once __DIR__ . '/posts.estructura-datos.php';

if (!isset($blogPosts) || !is_array($blogPosts)) {
    http_response_code(500);
    echo json_encode(['error' => 'No se pudo cargar la estructura de datos.']);
    exit;
}

// Filtrar los posts (búsqueda simple insensible a mayúsculas en título y contenido)
$results = array_filter($blogPosts, function($post) use ($searchTerm) {
    // stripos busca la primera ocurrencia insensible a mayúsculas
    return stripos($post['title'], $searchTerm) !== false || stripos(strip_tags($post['content']), $searchTerm) !== false;
});

// Devolver los resultados encontrados (solo título y slug para el enlace)
echo json_encode(array_map(function($post) {
    return ['title' => $post['title'], 'slug' => $post['slug']];
}, array_values($results))); // array_values para reindexar el array

exit;
?>