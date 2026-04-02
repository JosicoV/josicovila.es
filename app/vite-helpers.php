<?php

// Define si estás en modo desarrollo (ej. basado en una variable de entorno o un archivo)
// Usaremos la existencia del archivo 'hot' como indicador principal.

// --- Configuración ---
// Cambia estas rutas si tu estructura es diferente

// Ruta absoluta a la carpeta 'public' donde Vite podría colocar el archivo 'hot'.
// Esta carpeta (ej. 'public') suele estar en la raíz de tu proyecto Vite.
define('VITE_PUBLIC_DIR_PATH', __DIR__ . '/public');
// Ruta absoluta al archivo 'hot' generado por Vite en desarrollo
define('HOT_FILE_PATH', VITE_PUBLIC_DIR_PATH . '/hot');

// Ruta absoluta al directorio de build de Vite (donde Vite genera los archivos para producción).
// Usualmente es una carpeta 'dist' en la raíz de tu proyecto Vite.
define('BUILD_OUTPUT_PATH', __DIR__ );
// Ruta web relativa al directorio de build (para las URLs en HTML)
// Si tu proyecto está en la raíz del servidor web (ej. http://localhost/), y 'dist' está en 'josicodist/dist',
// entonces '/dist/' es correcto si 'josicodist' es la raíz del documento.
// Si accedes a tu proyecto como http://localhost/josicodist/, entonces BUILD_URI debería ser '/josicodist/dist/' o simplemente '/dist/' si el servidor está configurado adecuadamente.
// Dado que tus otros assets en index-juego.php usan rutas como '/media/img/logo.png', '/dist/' es probablemente correcto.
define('BUILD_URI', '/');
// Ruta absoluta al manifest generado por Vite en producción.
// Vite >= 3.0.0 por defecto guarda el manifest en '.vite/manifest.json' dentro del directorio de build.
define('MANIFEST_PATH', BUILD_OUTPUT_PATH . '/.vite/manifest.json');


// --- Fin Configuración ---

$_manifestData = null; // Cache para el manifest decodificado

/**
 * Obtiene la URL base del servidor de desarrollo Vite desde el archivo 'hot'.
 *
 * @return string|null La URL base o null si el archivo no existe/está vacío.
 */
function getViteDevServerBaseUrl(): ?string {
    if (file_exists(HOT_FILE_PATH)) {
        $content = trim(file_get_contents(HOT_FILE_PATH));
        // Asegúrate de que la URL tenga un esquema (http/https)
        if (!empty($content) && (strpos($content, 'http://') === 0 || strpos($content, 'https://') === 0)) {
             // Asegúrate de que la URL termine con una barra
             return rtrim($content, '/') . '/';
        }
    }
    return null;
}

/**
 * Lee y decodifica el manifest.json de Vite.
 * Cachea el resultado para evitar lecturas repetidas.
 *
 * @return array|null El array del manifest o null si no se encuentra/decodifica.
 */
function getManifest(): ?array {
    global $_manifestData;
    if ($_manifestData !== null) {
        return $_manifestData;
    }

    if (!file_exists(MANIFEST_PATH)) {
        error_log('Vite manifest not found at: ' . MANIFEST_PATH);
        return null;
    }

    try {
        $_manifestData = json_decode(file_get_contents(MANIFEST_PATH), true, 512, JSON_THROW_ON_ERROR);
        return $_manifestData;
    } catch (\JsonException $e) {
        error_log('Error decoding Vite manifest: ' . $e->getMessage());
        return null;
    }
}

/**
 * Genera las etiquetas HTML <script> y <link> para un punto de entrada de Vite.
 *
 * @param string $entryPoint El punto de entrada relativo al root del proyecto (ej: 'resources/js/app.js').
 * @return string Las etiquetas HTML generadas.
 */
function vite(string $entryPoint): string {
    $html = '';
    $devServerUrl = getViteDevServerBaseUrl();

    if ($devServerUrl !== null) {
        // --- Modo Desarrollo ---
        // Incluye el cliente Vite para HMR y conexión WebSocket
        $html .= '<script type="module" src="' . $devServerUrl . '@vite/client"></script>' . "\n";
        // Incluye el punto de entrada directamente desde el servidor de desarrollo
        $html .= '<script type="module" src="' . $devServerUrl . $entryPoint . '"></script>' . "\n";
    } else {
        // --- Modo Producción ---
        $manifest = getManifest();
        if ($manifest === null) {
            // Error: Manifest no encontrado o inválido
            // Podrías lanzar una excepción o mostrar un mensaje de error más visible
            return '<!-- Vite Manifest Error -->'; 
        }

        if (!isset($manifest[$entryPoint])) {
            error_log('Vite entry point not found in manifest: ' . $entryPoint);
            return '<!-- Vite Entry Point Error -->';
        }

        $manifestEntry = $manifest[$entryPoint];

        // Incluir CSS asociado al punto de entrada
        if (isset($manifestEntry['css']) && is_array($manifestEntry['css'])) {
            foreach ($manifestEntry['css'] as $cssFile) {
                $html .= '<link rel="stylesheet" href="' . BUILD_URI . $cssFile . '">' . "\n";
            }
        }

        // Incluir archivo JS principal del punto de entrada
        if (isset($manifestEntry['file'])) {
             $html .= '<script type="module" src="' . BUILD_URI . $manifestEntry['file'] . '"></script>' . "\n";
        } else {
             error_log('Vite entry point file key missing in manifest for: ' . $entryPoint);
             return '<!-- Vite Entry Point File Error -->';
        }

        // Opcional: Manejar 'imports' si usas split chunking avanzado
        // if (isset($manifestEntry['imports']) && is_array($manifestEntry['imports'])) {
        //     foreach ($manifestEntry['imports'] as $importKey) {
        //         if (isset($manifest[$importKey]['css']) && is_array($manifest[$importKey]['css'])) {
        //             foreach ($manifest[$importKey]['css'] as $cssFile) {
        //                 $html .= '<link rel="stylesheet" href="' . BUILD_URI . $cssFile . '">' . "\n";
        //             }
        //         }
        //     }
        // }

    }

    return $html;
}

?>
