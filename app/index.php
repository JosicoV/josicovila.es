<?php
// c:\wamp64\www\josicodist\index.php

// Función para generar un extracto si no se proporciona una meta descripción específica
function generar_extracto($htmlContent, $maxLength = 155) {
    $text = strip_tags($htmlContent); // Eliminar HTML
    $text = preg_replace('/\s+/', ' ', $text); // Reemplazar múltiples espacios con uno solo
    $text = trim($text);
    if (mb_strlen($text) > $maxLength) {
        $text = mb_substr($text, 0, $maxLength - 3) . '...';
    }
    return htmlspecialchars($text);
}

// Función para extraer la primera imagen URL del contenido HTML
function extraer_primera_imagen($htmlContent) {
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

// Función para obtener posts relacionados basados en etiquetas
function get_related_posts($currentPostSlug, $allPosts, $maxRelated = 4) {
    $currentPostData = null;
    foreach ($allPosts as $p) {
        if ($p['slug'] === $currentPostSlug) {
            $currentPostData = $p;
            break;
        }
    }

    if (!$currentPostData || empty($currentPostData['tags'])) {
        return [];
    }

    $currentPostTags = $currentPostData['tags'];
    $relatedPostsWithScores = [];

    foreach ($allPosts as $post) {
        if ($post['slug'] === $currentPostSlug || empty($post['tags'])) {
            continue;
        }
        $commonTags = array_intersect($currentPostTags, $post['tags']);
        $score = count($commonTags);
        if ($score > 0) {
            $relatedPostsWithScores[] = ['post' => $post, 'score' => $score];
        }
    }

    usort($relatedPostsWithScores, fn($a, $b) => $b['score'] <=> $a['score']); // Ordenar por más etiquetas en común
    $sorted_posts = array_column($relatedPostsWithScores, 'post');
    
    // Si hay menos posts con etiquetas comunes que $maxRelated, completamos con otros posts (excluyendo el actual)
    // para intentar llegar a $maxRelated, si es posible.
    $final_related_posts = $sorted_posts;
    if (count($final_related_posts) < $maxRelated) {
        $existing_slugs = array_map(fn($p) => $p['slug'], $final_related_posts);
        $existing_slugs[] = $currentPostSlug; // No incluir el post actual

        $additional_posts_needed = $maxRelated - count($final_related_posts);
        $candidate_posts = [];
        foreach ($allPosts as $post) {
            if (!in_array($post['slug'], $existing_slugs)) {
                $candidate_posts[] = $post;
            }
        }
        shuffle($candidate_posts); // Aleatorizar los candidatos restantes
        $final_related_posts = array_merge($final_related_posts, array_slice($candidate_posts, 0, $additional_posts_needed));
    }
    
    return array_slice($final_related_posts, 0, $maxRelated);
}


// Incluir los datos del blog
include_once __DIR__ . "/api/BLOG_inc/includes/posts.estructura-datos.php"; // Define $blogPosts

// Añadir índice original a cada post para desempate estable.
// Esto es crucial para que los posts con la misma fecha se ordenen
// consistentemente: los que aparecen más tarde en el archivo de datos (considerados "más nuevos"
// para una misma fecha) se mostrarán primero después de la ordenación general por fecha descendente.
foreach ($blogPosts as $original_key => &$post_ref) {
    $post_ref['original_index'] = $original_key;
}
unset($post_ref); // Importante romper la referencia después del bucle

// Ordenar todos los posts por fecha en orden descendente (los más nuevos primero)
// y por índice original descendente si las fechas son iguales.
usort($blogPosts, function ($a, $b) {
    $timeA = isset($a['date']) ? strtotime($a['date']) : 0; // Tratar sin fecha o fecha inválida como la más antigua
    $timeB = isset($b['date']) ? strtotime($b['date']) : 0;

    if ($timeA === false) $timeA = 0; // strtotime puede devolver false en error, tratar como la más antigua
    if ($timeB === false) $timeB = 0;

    if ($timeB == $timeA) {
        // Misma fecha: los posts con mayor índice original (más abajo en el archivo de datos)
        // deben aparecer primero.
        $indexA = $a['original_index'] ?? PHP_INT_MIN; // Usar un valor bajo si el índice no existe (aunque siempre debería existir aquí)
        $indexB = $b['original_index'] ?? PHP_INT_MIN;
        return $indexB <=> $indexA; // Orden descendente por índice original
    }
    // Diferentes fechas: ordenar por fecha descendente (más nuevas primero).
    return $timeB <=> $timeA;
});

$all_blog_posts_original = $blogPosts; // $blogPosts ahora está ordenado por fecha (y por índice para misma fecha)

// Variables para controlar la vista y el contenido
$currentPost = null;
$is_single_post_view = false;
$is_tag_view = false;
$current_tag_filter = null;
$posts_to_display_on_page = []; // Posts para la cuadrícula principal o lista filtrada por tag

// Definir la URL canónica base
$base_url_protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https:" : "http:";
$base_url_host = $_SERVER['HTTP_HOST'] ?? 'josicovila.es';
$base_canonical_url = $base_url_protocol . '//' . $base_url_host;

// Definir metaetiquetas por defecto para el blog
$page_title_default = "Josico Vila - Blog y Mundo 3D";
$meta_description_default = "Explora el blog y el mundo 3D interactivo creado por Josico Vila. Descubre relatos, música y el proceso de desarrollo.";
$meta_keywords_default = "Josico Vila, juego 3d, webgl, three.js, phaser, enable3d, blog, desarrollo web, relatos, música";

$page_title = $page_title_default;
$meta_description = $meta_description_default;
$meta_keywords = $meta_keywords_default;
$canonical_href = $base_canonical_url . '/'; // Default para la home del blog

// Determinar el slug del post actual para marcarlo como activo en el sidebar
$activePostSlugInSidebar = $_GET['post'] ?? null;
if (!$activePostSlugInSidebar && !$is_tag_view && !empty($all_blog_posts_original)) {
    // Si estamos en la home (sin post ni tag), no marcamos ninguno como activo,
    // o podríamos marcar el "concepto" de home si tuviéramos un enlace para ello.
    // Por ahora, $activePostSlugInSidebar será null en la home.
}


if (isset($_GET['post'])) {
    // Reemplazar FILTER_SANITIZE_STRING obsoleto. strip_tags es adecuado para slugs.
    $slug = strip_tags((string)$_GET['post']);
    foreach ($all_blog_posts_original as $post_item) {
        if ($post_item['slug'] === $slug) {
            $currentPost = $post_item;
            $is_single_post_view = true;
            $activePostSlugInSidebar = $slug; // Asegurar que el slug activo es el del post actual
            break;
        }
    }

    if ($currentPost) {
        $page_title = htmlspecialchars($currentPost['title']) . " | Blog de Josico Vila";
        $meta_description = isset($currentPost['meta_description']) && !empty($currentPost['meta_description'])
                            ? htmlspecialchars($currentPost['meta_description'])
                            : generar_extracto($currentPost['content']);
        $post_keywords_array = [htmlspecialchars($currentPost['title'])];
        if (isset($currentPost['tags']) && is_array($currentPost['tags'])) {
            $post_keywords_array = array_merge($post_keywords_array, array_map('htmlspecialchars', $currentPost['tags']));
        }
        $meta_keywords = implode(', ', $post_keywords_array) . ", blog, Josico Vila";
        $canonical_href = $base_canonical_url . '/blog/' . htmlspecialchars($currentPost['slug']) . '/';
    } else {
        // Post no encontrado. Podríamos redirigir a una página 404 o mostrar un mensaje.
        // Por ahora, se mostrará la home del blog si no se encuentra el post.
        $page_title = "Post no encontrado - Blog de Josico Vila";
        // $canonical_href ya es la home por defecto.
        // Para la cuadrícula, si el post no se encuentra, mostramos la home normal.
        $posts_to_display_on_page = array_slice($all_blog_posts_original, 0, min(6, count($all_blog_posts_original)));
    }

} elseif (isset($_GET['tag'])) {
    // Reemplazar FILTER_SANITIZE_STRING obsoleto. strip_tags y trim son adecuados para tags.
    $current_tag_filter = trim(strip_tags((string)$_GET['tag']));
    if ($current_tag_filter) {
        $is_tag_view = true;
        $filtered_posts = [];
        foreach ($all_blog_posts_original as $post_item) {
            if (isset($post_item['tags']) && is_array($post_item['tags']) && in_array($current_tag_filter, $post_item['tags'])) {
                $filtered_posts[] = $post_item;
            }
        }
        $posts_to_display_on_page = $filtered_posts; // Mostrar todos los posts filtrados
        $page_title = "Artículos con la etiqueta: " . htmlspecialchars($current_tag_filter) . " - Blog de Josico Vila";
        $meta_description = "Explora artículos sobre " . htmlspecialchars($current_tag_filter) . " en el blog de Josico Vila.";
        $canonical_href = $base_canonical_url . '/blog/tag/' . urlencode($current_tag_filter) . '/';
         $activePostSlugInSidebar = null; // Ningún post individual activo en vista de tag
    } else { // Tag vacío, tratar como la home
        $posts_to_display_on_page = array_slice($all_blog_posts_original, 0, min(6, count($all_blog_posts_original)));
        // $canonical_href y metas ya son los de la home por defecto.
    }

} else { // Página principal del blog (sin post específico ni tag)
    $posts_to_display_on_page = array_slice($all_blog_posts_original, 0, min(6, count($all_blog_posts_original)));
    // $canonical_href y metas ya son los de la home por defecto.
    $activePostSlugInSidebar = null; // Ningún post individual activo en la home
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta name="keywords" content="<?php echo $meta_keywords; ?>">
    <meta name="author" content="Josico Vila">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_href); ?>" />
    <link rel="icon" type="image/png" href="/media/img/logo.png">
    <link rel="stylesheet" href="/css/blog-styles.css">

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MZ739R29ER"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      function inicializarAnalytics() {
        if (typeof gtag === 'function') {
          gtag('config', 'G-MZ739R29ER');
          console.log("Google Analytics inicializado para el blog tras consentimiento.");
        }
      }
    </script>
</head>
<body>

    <header>
        <div class="logo">
            <a href="/">
                <img src="/media/img/firma-transparente-blanco.png" alt="Josico Vila" title="Josico Vila" loading="lazy">
            </a>
        </div>
        <nav class="play-button">
            <a href="/mundo3D/">
                <img src="/intro/images/llamada-juego.png" alt="Jugar ahora al Mundo 3D de Josico Vila" title="Entra al Mundo 3D de Josico Vila" loading="lazy">
            </a>
        </nav>
    </header>

    <aside id="blog-sidebar">
        <div class="search-container">
            <input type="text" id="blog-search-input" placeholder="Buscar artículos...">
            <div id="search-results"></div>
        </div>
        <h2>Todos los artículos</h2>
        <ul>
            <?php foreach ($all_blog_posts_original as $post_sidebar_item): ?>
                <li>
                    <?php $img_sidebar_url = extraer_primera_imagen($post_sidebar_item['content']); ?>
                    <a href="/blog/<?php echo htmlspecialchars($post_sidebar_item['slug']); ?>/"
                       class="<?php echo ($activePostSlugInSidebar === $post_sidebar_item['slug']) ? 'active' : ''; ?>">
                        <?php if ($img_sidebar_url): ?>
                            <img src="<?php echo htmlspecialchars($img_sidebar_url); ?>" alt="Miniatura de <?php echo htmlspecialchars($post_sidebar_item['title']); ?>" class="sidebar-post-thumbnail" loading="lazy">
                        <?php endif; ?>
                        <span class="sidebar-post-title"><?php echo htmlspecialchars($post_sidebar_item['title']); ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <button id="toggle-sidebar" title="Ocultar/Mostrar menú">&lt;</button>

    <main>
        <?php if ($is_single_post_view && $currentPost): // Vista de un solo post ?>
            <article>
                <h1><?php echo htmlspecialchars($currentPost['title']); ?></h1>
                <?php if (isset($currentPost['date'])): ?>
                    <p class="post-meta">Publicado el: <?php echo htmlspecialchars($currentPost['date']); ?></p>
                <?php endif; ?>
                <div class="post-content">
                    <?php echo $currentPost['content']; ?>
                </div>

                <?php if (!empty($currentPost['tags'])): ?>
                    <div class="post-tags">
                        <strong>Etiquetas:</strong>
                        <?php
                        $tag_links = [];
                        foreach ($currentPost['tags'] as $tag_item) { // Renombrada variable para evitar confusión
                            $tag_links[] = '<a href="/blog/tag/' . urlencode($tag_item) . '/">' . htmlspecialchars($tag_item) . '</a>';
                        }
                        echo implode(' ', $tag_links); // Espacio entre etiquetas en lugar de coma para mejor estilo con bg
                        ?>
                    </div>
                <?php endif; ?>

                <?php // <!-- SECCIÓN DE CONTACTO DIRECTO --> ?>
                <div class="direct-contact-section">
                    <p>
                        <strong>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="contact-svg">
                                <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            </svg>
                            Contacto directo:
                        </strong>
                        <a href="https://www.youtube.com/@josicovila" target="_blank" rel="noopener noreferrer" title="Visita mi canal de Youtube" class="social-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="social-svg youtube-svg">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg> Youtube
                        </a>,
                        <a href="https://www.facebook.com/JosicoVila78" target="_blank" rel="noopener noreferrer" title="Visita mi perfil de Facebook" class="social-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="social-svg facebook-svg">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                            </svg> Facebook
                        </a> e
                        <a href="https://www.instagram.com/josicovila/" target="_blank" rel="noopener noreferrer" title="Visita mi perfil de Instagram" class="social-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="social-svg instagram-svg">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.231 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.884a1.161 1.161 0 1 0 0 2.322 1.161 1.161 0 0 0 0-2.322zM7.999 3.882a4.106 4.106 0 1 0 0 8.212 4.106 4.106 0 0 0 0-8.212zm0 1.443a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                            </svg> Instagram
                        </a>
                    </p>
                </div>
                <?php // <!-- FIN SECCIÓN DE CONTACTO DIRECTO --> ?>


                <?php
                $related_posts = get_related_posts($currentPost['slug'], $all_blog_posts_original);
                if (!empty($related_posts)):
                ?>
                <div class="related-posts-section">
                    <h2>También te podría interesar:</h2>
                    <div class="related-posts-grid">
                        <?php foreach ($related_posts as $related_post_item): ?>
                            <div class="post-card related-post-card">
                                <?php $img_url_related = extraer_primera_imagen($related_post_item['content']); ?>
                                <?php if ($img_url_related): ?>
                                    <a href="/blog/<?php echo htmlspecialchars($related_post_item['slug']); ?>/"><img loading="lazy" src="<?php echo htmlspecialchars($img_url_related); ?>" alt="<?php echo htmlspecialchars($related_post_item['title']); ?>" class="post-card-image"></a>
                                <?php endif; ?>
                                <h4 class="post-card-title"><a href="/blog/<?php echo htmlspecialchars($related_post_item['slug']); ?>/"><?php echo htmlspecialchars($related_post_item['title']); ?></a></h4>
                                <p class="post-card-excerpt"><?php echo generar_extracto($related_post_item['content'], 70); ?></p>
                                <a href="/blog/<?php echo htmlspecialchars($related_post_item['slug']); ?>/" class="post-card-readmore">Leer más</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php // <!-- SECCIÓN DE COMENTARIOS CUSDIS --> ?>
                <?php if ($is_single_post_view && $currentPost): ?>
                <h2>Comentarios:</h2>
                <div id="cusdis_thread"
                    data-host="https://cusdis.com"
                    data-app-id="815efe41-40d2-4b22-955b-70a6e46e8cc7" <?php // <!-- ¡¡¡IMPORTANTE: CAMBIA ESTO!!! --> ?>
                    data-page-id="<?php echo htmlspecialchars($currentPost['slug']); ?>"
                    data-page-url="<?php echo htmlspecialchars($canonical_href); ?>"
                    data-page-title="<?php echo htmlspecialchars($currentPost['title']); ?>"
                    data-language="es"
                    data-theme="light"
                    style="margin-top: 40px; padding-top:30px; border-top: 1px solid #555;"
                ></div>
                <script async defer src="https://cusdis.com/js/cusdis.es.js"></script> <?php // <!-- 'es.js' para idioma español --> ?>
                
                <?php // Script para ajustar la altura del iframe de Cusdis dinámicamente ?>
                <script>
                window.addEventListener('load', function () {
                    // Esperar un poco para asegurar que Cusdis haya cargado su iframe
                    setTimeout(function() {
                        const cusdisDiv = document.getElementById('cusdis_thread');
                        if (cusdisDiv) {
                            const iframe = cusdisDiv.querySelector('iframe');
                            if (iframe) {
                                const resizeIframe = () => {
                                    if (iframe.contentWindow && iframe.contentWindow.document.body) {
                                        const scrollHeight = iframe.contentWindow.document.body.scrollHeight;
                                        iframe.style.height = scrollHeight + 'px';
                                    }
                                };
                                // Ajustar al cargar y observar cambios
                                iframe.addEventListener('load', resizeIframe); // Ajustar cuando el iframe termine de cargar su contenido inicial
                                resizeIframe(); // Intento inicial
                                const observer = new MutationObserver(resizeIframe);
                                observer.observe(iframe.contentWindow.document.body, { childList: true, subtree: true, attributes: true });
                            }
                        }
                    }, 1000); // Un pequeño retardo para dar tiempo a Cusdis a inyectar el iframe
                });
                </script>
                <?php endif; ?>

            </article>
        <?php else: // Vista de la página principal del blog (home o filtrada por tag) o post no encontrado ?>
            <div class="blog-index-container">
                <?php if ($is_tag_view && $current_tag_filter): ?>
                    <h1 class="tag-filter-title">Artículos con la etiqueta: "<?php echo htmlspecialchars($current_tag_filter); ?>"</h1>
                <?php elseif (!$is_single_post_view && !$currentPost && isset($_GET['post'])): // Mensaje si se intentó acceder a un post que no existe ?>
                    <h1>Post no encontrado</h1>
                    <p>El artículo que buscas no existe o ha sido movido. Mientras tanto, puedes ver nuestros últimos artículos:</p>
                <?php endif; ?>

                <div id="blog-posts-grid">
                    <?php
                    // Para la vista de tag, $posts_to_display_on_page contiene todos los posts del tag.
                    // Para la home (o post no encontrado), contiene los primeros 6.
                    // Dividimos en destacados y secundarios solo si hay suficientes posts.
                    $num_posts_for_current_view = count($posts_to_display_on_page);
                    $featured_posts = [];
                    $secondary_posts = [];

                    if ($num_posts_for_current_view > 0) {
                        if ($is_tag_view) { // En vista de tag, podríamos mostrar todos de forma más uniforme o mantener el 2+4 si hay muchos
                            // Por simplicidad, si es vista de tag, mostramos todos como "secundarios" o en una lista simple.
                            // O mantenemos la lógica 2+4 si hay al menos 2.
                            if ($num_posts_for_current_view >= 1) $featured_posts = array_slice($posts_to_display_on_page, 0, 2);
                            if ($num_posts_for_current_view > 2) $secondary_posts = array_slice($posts_to_display_on_page, 2, ($is_tag_view ? $num_posts_for_current_view - 2 : 4) );

                        } else { // Home o post no encontrado (muestra home)
                            $featured_posts = array_slice($posts_to_display_on_page, 0, 2);
                            $secondary_posts = array_slice($posts_to_display_on_page, 2, 4);
                        }
                    }
                    ?>
                    <?php if (!empty($featured_posts)): ?>
                    <div class="posts-row-featured">
                        <?php foreach ($featured_posts as $post_item): ?>
                            <div class="post-card featured-post">
                                <?php $img_url = extraer_primera_imagen($post_item['content']); ?>
                                <?php if ($img_url): ?>
                                    <a href="/blog/<?php echo htmlspecialchars($post_item['slug']); ?>/"><img loading="lazy" src="<?php echo htmlspecialchars($img_url); ?>" alt="<?php echo htmlspecialchars($post_item['title']); ?>" class="post-card-image"></a>
                                <?php endif; ?>
                                <h3 class="post-card-title"><a href="/blog/<?php echo htmlspecialchars($post_item['slug']); ?>/"><?php echo htmlspecialchars($post_item['title']); ?></a></h3>
                                <p class="post-card-excerpt"><?php echo generar_extracto($post_item['content'], 100); ?></p>
                                <a href="/blog/<?php echo htmlspecialchars($post_item['slug']); ?>/" class="post-card-readmore">Leer más</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($secondary_posts)): ?>
                    <div class="posts-row-secondary">
                        <?php foreach ($secondary_posts as $post_item): ?>
                            <div class="post-card secondary-post">
                                <?php $img_url = extraer_primera_imagen($post_item['content']); ?>
                                <?php if ($img_url): ?>
                                    <a href="/blog/<?php echo htmlspecialchars($post_item['slug']); ?>/"><img loading="lazy" src="<?php echo htmlspecialchars($img_url); ?>" alt="<?php echo htmlspecialchars($post_item['title']); ?>" class="post-card-image"></a>
                                <?php endif; ?>
                                <h4 class="post-card-title"><a href="/blog/<?php echo htmlspecialchars($post_item['slug']); ?>/"><?php echo htmlspecialchars($post_item['title']); ?></a></h4>
                                <p class="post-card-excerpt"><?php echo generar_extracto($post_item['content'], 70); ?></p>
                                <a href="/blog/<?php echo htmlspecialchars($post_item['slug']); ?>/" class="post-card-readmore">Leer más</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <?php if (empty($featured_posts) && empty($secondary_posts)): ?>
                        <?php if ($is_tag_view): ?>
                            <p>No hay artículos con la etiqueta "<?php echo htmlspecialchars($current_tag_filter); ?>".</p>
                        <?php else: ?>
                            <p>No hay artículos para mostrar en este momento.</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php if (!$is_tag_view && !$is_single_post_view && count($all_blog_posts_original) > 6): // Mostrar botón solo en la home y si hay más de 6 posts en total ?>
                <button id="load-random-posts" class="blog-button">Ver otros 6 artículos</button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>

    <script src="/js/blog-sidebar.js"></script>
    
    <?php if (!$is_single_post_view && !$is_tag_view): // Solo incluir script de posts aleatorios en la home real ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const loadRandomButton = document.getElementById('load-random-posts');
        const postsGrid = document.getElementById('blog-posts-grid');

        if (loadRandomButton && postsGrid) {
            loadRandomButton.addEventListener('click', function() {
                postsGrid.innerHTML = '<p>Cargando nuevos artículos...</p>';
                fetch('/api/BLOG_inc/includes/ajax.random-posts.php')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('La respuesta de la red no fue correcta: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(posts => {
                        renderPosts(posts);
                    })
                    .catch(error => {
                        console.error('Error al cargar posts aleatorios:', error);
                        postsGrid.innerHTML = '<p>Error al cargar los artículos. Inténtalo de nuevo más tarde.</p>';
                    });
            });
        }

        function renderPosts(posts) {
            if (!postsGrid) return;
            postsGrid.innerHTML = ''; 

            if (!posts || posts.length === 0) {
                postsGrid.innerHTML = '<p>No hay artículos para mostrar en este momento.</p>';
                return;
            }

            const featuredPostsData = posts.slice(0, 2);
            const secondaryPostsData = posts.slice(2, 6);
            let html = '';

            if (featuredPostsData.length > 0) {
                html += '<div class="posts-row-featured">';
                featuredPostsData.forEach(post => {
                    html += `
                        <div class="post-card featured-post">
                            ${post.image_url ? `<a href="${escapeHtml(post.url)}"><img loading="lazy" src="${escapeHtml(post.image_url)}" alt="${escapeHtml(post.title)}" class="post-card-image"></a>` : ''}
                            <h3 class="post-card-title"><a href="${escapeHtml(post.url)}">${escapeHtml(post.title)}</a></h3>
                            <p class="post-card-excerpt">${escapeHtml(post.excerpt_featured)}</p>
                            <a href="${escapeHtml(post.url)}" class="post-card-readmore">Leer más</a>
                        </div>
                    `;
                });
                html += '</div>';
            }

            if (secondaryPostsData.length > 0) {
                html += '<div class="posts-row-secondary">';
                secondaryPostsData.forEach(post => {
                    html += `
                        <div class="post-card secondary-post">
                            ${post.image_url ? `<a href="${escapeHtml(post.url)}"><img loading="lazy" src="${escapeHtml(post.image_url)}" alt="${escapeHtml(post.title)}" class="post-card-image"></a>` : ''}
                            <h4 class="post-card-title"><a href="${escapeHtml(post.url)}">${escapeHtml(post.title)}</a></h4>
                            <p class="post-card-excerpt">${escapeHtml(post.excerpt_secondary)}</p>
                            <a href="${escapeHtml(post.url)}" class="post-card-readmore">Leer más</a>
                        </div>
                    `;
                });
                html += '</div>';
            }
             if (html === '') {
                postsGrid.innerHTML = '<p>No se encontraron artículos.</p>';
            } else {
                postsGrid.innerHTML = html;
            }
        }

        function escapeHtml(unsafe) {
            if (unsafe === null || typeof unsafe === 'undefined') return '';
            return unsafe
                 .replace(/&/g, "&amp;")
                 .replace(/</g, "&lt;")
                 .replace(/>/g, "&gt;")
                 .replace(/"/g, "&quot;")
                 .replace(/'/g, "&#039;");
        }
    });
    </script>
    <?php endif; ?>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
    <script>
    window.addEventListener("load", function(){
    window.cookieconsent.initialise({
        "palette": {
        "popup": { "background": "#252e39", "text": "#ffffff" },
        "button": { "background": "#14a7d0", "text": "#ffffff" }
        },
        "theme": "classic",
        "position": "bottom-left",
        "content": {
        "message": "Este sitio web utiliza cookies para mejorar tu experiencia. Al hacer clic en \"Aceptar\", aceptas nuestro uso de cookies analíticas.",
        "dismiss": "Aceptar",
        "deny": "Rechazar",
        "link": "Más información",
        "href": "/politica-de-privacidad.html"
        },
        "showDenyButton": true,
        onInitialise: function (status) {
            var didConsent = this.hasConsented();
            if (didConsent) {
                if (typeof inicializarAnalytics === 'function') { inicializarAnalytics(); }
            }
        },
        onStatusChange: function(status, chosenBefore) {
            var didConsent = this.hasConsented();
            if (didConsent) {
                if (typeof inicializarAnalytics === 'function') { inicializarAnalytics(); }
            } else {
                console.log("Consentimiento de cookies rechazado o no gestionado.");
            }
        }
    })
    });
    </script>
</body>
</html>
