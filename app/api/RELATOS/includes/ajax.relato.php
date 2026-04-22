<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput);
$jsonError = json_last_error();

if ($jsonError !== JSON_ERROR_NONE || !$data || !isset($data->nombre)) {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode([
        'error' => 'Datos de entrada invalidos o faltantes.',
        'json_error_code' => $jsonError,
        'json_error_message' => json_last_error_msg(),
        'raw_input_received' => $rawInput,
    ]);
    exit;
}

$nombrejs = $data->nombre;

include_once __DIR__ . '/relatos.estructura-datos.php';

if (!isset($relatos) || !is_array($relatos)) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['error' => 'Error interno: no se pudo cargar la estructura de datos de relatos.']);
    exit;
}

$htmlOutput = '';
$found = false;

for ($z = 0; $z < count($relatos); $z++) {
    if ($relatos[$z]['nombrejs'] !== $nombrejs) {
        continue;
    }

    $found = true;
    ob_start();
    ?>
<div class="relato jv-story-detail" id="<?php echo htmlspecialchars($relatos[$z]['nombrejs'], ENT_QUOTES, 'UTF-8'); ?>" data-audio="<?php echo htmlspecialchars($relatos[$z]['audio'], ENT_QUOTES, 'UTF-8'); ?>">
    <div class="controlRelato backdrop-blur jv-story-detail__control">
        <img class="cerrarRelato" src="/RELATOS/img/cerrar.png" alt="Cerrar">
        <div class="audio jv-story-detail__audio">
            <div class="audioControl jv-story-detail__transport">
                <img class="playPause" id="playPause" src="/RELATOS/img/play-pause.png" alt="Play/Pause">
                <div id="time">0%</div>
            </div>
            <div class="jv-story-detail__wave">
                <div id="wavediv">Audio relato</div>
            </div>
            <div class="jv-story-detail__pdf">
                <a class="jv-story-detail__pdf-link" href="/RELATOS/relatos/pdf/<?php echo htmlspecialchars($relatos[$z]['pdf'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">Abrir version PDF</a>
            </div>
        </div>
    </div>
    <div class="jv-story-detail__body">
        <div class="jv-story-detail__hero">
            <div class="jv-story-detail__eyebrow">Portal abierto</div>
            <h1><?php echo htmlspecialchars($relatos[$z]['nombre'], ENT_QUOTES, 'UTF-8'); ?></h1>
            <p class="jv-story-detail__intro"><?php echo htmlspecialchars($relatos[$z]['descripcion'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <div class="jv-story-detail__prose">
            <p><?php echo nl2br($relatos[$z]['texto']); ?></p>
        </div>
        <p class="jv-story-detail__signoff">Muchas gracias por leerme,<br>Josico Vila</p>
    </div>
</div>
<?php
    $htmlOutput = ob_get_clean();
    break;
}

if ($found) {
    header('Content-Type: text/html; charset=utf-8');
    echo $htmlOutput;
} else {
    header('HTTP/1.0 404 Not Found');
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Relato no encontrado para el ID: ' . htmlspecialchars($nombrejs, ENT_QUOTES, 'UTF-8');
}

exit;
