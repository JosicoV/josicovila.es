<?php

// 1. Configuración inicial de errores (SOLO para desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. Obtener y validar la entrada JSON
$rawInput = file_get_contents("php://input");
$data = json_decode($rawInput);
$jsonError = json_last_error();

if ($jsonError !== JSON_ERROR_NONE || !$data || !isset($data->nombre)) {
    // Error en la entrada: Enviar respuesta JSON y salir
    header('Content-Type: application/json');
    http_response_code(400); // Bad Request
    echo json_encode([
        'error' => 'Datos de entrada inválidos o faltantes.',
        'json_error_code' => $jsonError,
        'json_error_message' => json_last_error_msg(),
        'raw_input_received' => $rawInput
    ]);
    exit;
}

// Si llegamos aquí, la entrada es válida.
$nombrejs = $data->nombre;

// 3. Incluir la estructura de datos AHORA
// (Asegúrate que esta ruta sea correcta desde ajax.relato.php)
include_once __DIR__ . '/relatos.estructura-datos.php'; // O solo 'relatos.estructura-datos.php' si está en el mismo dir

// 4. Verificar si $relatos se cargó correctamente
if (!isset($relatos) || !is_array($relatos)) {
    // Error interno: No se pudieron cargar los datos
    header('Content-Type: application/json');
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Error interno: No se pudo cargar la estructura de datos de relatos.']);
    exit;
}

// 5. Buscar el relato y generar HTML usando Output Buffering
$htmlOutput = '';
$found = false;

for ($z = 0; $z < count($relatos); $z++) {
    if ($relatos[$z]['nombrejs'] == $nombrejs) {
        $found = true;
        ob_start(); // Iniciar captura de salida
?>
<div class="relato" id="<?php echo htmlspecialchars($relatos[$z]['nombrejs'], ENT_QUOTES, 'UTF-8'); ?>" data-audio="<?php echo htmlspecialchars($relatos[$z]['audio'], ENT_QUOTES, 'UTF-8'); ?>">
    <div class="controlRelato backdrop-blur">
        <img class="cerrarRelato" src="/RELATOS/img/cerrar.png" alt="Cerrar">
        <div class="audio">
            <div class="audioControl">
                <img class="playPause" id="playPause" src="/RELATOS/img/play-pause.png" alt="Play/Pause">
                <div id="time">0%</div>
            </div>
            <div style="width:100%;">
                <div id="wavediv">Audio relato</div>
            </div>
        </div>
    </div>
    <br><br>
    <h1><?php echo htmlspecialchars($relatos[$z]['nombre'], ENT_QUOTES, 'UTF-8'); ?></h1>
    <p><?php echo nl2br($relatos[$z]['texto']); // Añadido nl2br y htmlspecialchars ?></p><br><br>
    <p>Muchas gracias por leerme,<br>Josico Vila</p>
    <br><br><br><br>
</div>
<?php
        $htmlOutput = ob_get_clean(); // Obtener el HTML capturado
        break; // Salir del bucle una vez encontrado
    }
}

// 6. Enviar la respuesta final
if ($found) {
    header('Content-Type: text/html; charset=utf-8'); // Cabecera para HTML
    echo $htmlOutput; // Enviar el HTML generado
} else {
    // No se encontró el relato
    header("HTTP/1.0 404 Not Found");
    header('Content-Type: text/plain; charset=utf-8');
    echo "Relato no encontrado para el ID: " . htmlspecialchars($nombrejs, ENT_QUOTES, 'UTF-8');
}

exit; // Terminar explícitamente el script

?>