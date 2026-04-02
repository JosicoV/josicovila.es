<?php
// c:\wamp64\www\josicodist\api\BLOG_inc\includes\ajax.random-posts.php
error_reporting(E_ALL);
ini_set('display_errors', 0); // Desactivar en producción, activar para desarrollo
header('Content-Type: application/json; charset=utf-8');

include_once __DIR__ . '/posts.estructura-datos.php';

// Función para generar un extracto
function generar_extracto_ajax($htmlContent, $maxLength = 155) {
    $text = strip_tags($htmlContent);
    $text = preg_replace('/\s+/', ' ', $text);
    $text = trim($text);
    if (mb_strlen($text) > $maxLength) {
        $text = mb_substr($text, 0, $maxLength - 3) . '...';
    }
    return htmlspecialchars($text);
}

// Función para extraer la primera imagen URL del contenido HTML
function extraer_primera_imagen_ajax($htmlContent) {
    if (empty($htmlContent)) return null;
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $htmlContent);
    libxml_clear_errors();

    $imgTags = $doc->getElementsByTagName('img');
    if ($imgTags->length > 0) {
        return $imgTags->item(0)->getAttribute('src');
    }
    return null;
}


if (!isset($blogPosts) || !is_array($blogPosts) || count($blogPosts) === 0) {
    http_response_code(500);
    echo json_encode(['error' => 'No se pudieron cargar los posts o no hay posts disponibles.']);
    exit;
}

shuffle($blogPosts); // Aleatorizar el array de posts

$num_posts_to_display = 6;
$selected_posts = array_slice($blogPosts, 0, min($num_posts_to_display, count($blogPosts)));

$output_posts = [];
foreach ($selected_posts as $post) {
    $output_posts[] = [
        'slug' => $post['slug'],
        'title' => $post['title'],
        'excerpt_featured' => generar_extracto_ajax($post['content'], 100), // Para los 2 destacados
        'excerpt_secondary' => generar_extracto_ajax($post['content'], 70), // Para los 4 secundarios
        'image_url' => extraer_primera_imagen_ajax($post['content']),
        'url' => '/blog/' . htmlspecialchars($post['slug']) . '/',
    ];
}

echo json_encode($output_posts);
exit;
?>