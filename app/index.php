<?php
// ══════════════════════════════════════════════════════
// JosicoVila.es — Blog (listing + single post)
// ══════════════════════════════════════════════════════

/* ── Helper: short excerpt from HTML content ── */
function generar_extracto($htmlContent, $maxLength = 155) {
    $text = strip_tags($htmlContent);
    $text = preg_replace('/\s+/', ' ', $text);
    $text = trim($text);
    if (mb_strlen($text) > $maxLength) {
        $text = mb_substr($text, 0, $maxLength - 3) . '...';
    }
    return htmlspecialchars($text);
}

/* ── Helper: first <img> src from HTML ── */
function extraer_primera_imagen($htmlContent) {
    if (empty($htmlContent)) return null;
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $htmlContent);
    libxml_clear_errors();
    $imgs = $doc->getElementsByTagName('img');
    if ($imgs->length > 0) return $imgs->item(0)->getAttribute('src');
    return null;
}

/* ── Helper: card image (from content or fallback) ── */
function get_card_img($post) {
    $img = extraer_primera_imagen($post['content'] ?? '');
    return $img ?: '/BLOG_media/media/img/josico-bienvenida.png';
}

/* ── Helper: excerpt for card ── */
function get_excerpt($post) {
    if (!empty($post['meta_description'])) return htmlspecialchars($post['meta_description']);
    return generar_extracto($post['content'] ?? '', 155);
}

/* ── Helper: estimated reading time in minutes ── */
function estimate_read($post) {
    $text  = strip_tags($post['content'] ?? '');
    $words = str_word_count(preg_replace('/\s+/', ' ', trim($text)));
    return max(1, (int) round($words / 200));
}

/* ── Helper: derive category from tags and slug ── */
function derive_cat($post) {
    $tags    = implode(' ', $post['tags'] ?? []);
    $slug    = $post['slug'] ?? '';
    $tagsLow = mb_strtolower($tags);
    $slugLow = mb_strtolower($slug);

    if (str_contains($tagsLow, 'multijugador') || str_contains($slugLow, 'multijugador') || str_contains($slugLow, 'chat-firebase')) return 'multijugador';
    if (str_contains($tagsLow, 'dragones') || str_contains($tagsLow, 'avatares') || str_contains($slugLow, 'dragon') || str_contains($slugLow, 'cuatro-dragones')) return 'dragones';
    if (str_contains($tagsLow, 'música') || str_contains($tagsLow, 'musica') || str_contains($tagsLow, 'banda sonora') || str_contains($tagsLow, 'audio') || str_contains($tagsLow, 'sonido') || str_contains($slugLow, 'musica') || str_contains($slugLow, 'sonido') || str_contains($slugLow, 'banda')) return 'musica';
    if (str_contains($tagsLow, 'relatos') || str_contains($tagsLow, 'narrativa') || str_contains($tagsLow, 'libros') || str_contains($tagsLow, 'lectura') || str_contains($slugLow, 'relato') || str_contains($slugLow, 'libro')) return 'relatos';
    if (str_contains($slugLow, 'mundo') || str_contains($slugLow, 'bienvenida-pueblo') || str_contains($slugLow, 'nivel-progreso') || str_contains($slugLow, 'islas') || str_contains($slugLow, 'optimizacion') || str_contains($slugLow, 'logo-3d') || str_contains($tagsLow, 'pueblo de los dragones') || str_contains($tagsLow, 'juego 3d') || str_contains($tagsLow, 'juego narrativo') || str_contains($tagsLow, 'exploración')) return 'mundo3d';
    if (str_contains($slugLow, 'bienvenida-blog') || str_contains($slugLow, 'creditos') || str_contains($slugLow, 'faq') || str_contains($slugLow, 'preguntas-frecuentes')) return 'meta';

    return 'desarrollo';
}

/* ── Helper: category display label ── */
function cat_label($cat) {
    return [
        'dragones'     => 'Dragones',
        'mundo3d'      => 'Mundo 3D',
        'desarrollo'   => 'Desarrollo',
        'musica'       => 'Música',
        'multijugador' => 'Multijugador',
        'relatos'      => 'Relatos',
        'meta'         => 'Meta',
    ][$cat] ?? ucfirst($cat);
}

/* ── Helper: format date ── */
function fmt_date($iso) {
    $d = DateTime::createFromFormat('Y-m-d', $iso);
    if (!$d) return htmlspecialchars($iso);
    $months = ['','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
    return $d->format('j') . ' ' . $months[(int)$d->format('n')] . ' ' . $d->format('Y');
}

/* ── Helper: related posts by shared tags ── */
function get_related_posts($currentPostSlug, $allPosts, $maxRelated = 4) {
    $currentPost = null;
    foreach ($allPosts as $p) {
        if ($p['slug'] === $currentPostSlug) { $currentPost = $p; break; }
    }
    if (!$currentPost || empty($currentPost['tags'])) return [];

    $scored = [];
    foreach ($allPosts as $post) {
        if ($post['slug'] === $currentPostSlug || empty($post['tags'])) continue;
        $score = count(array_intersect($currentPost['tags'], $post['tags']));
        if ($score > 0) $scored[] = ['post' => $post, 'score' => $score];
    }
    usort($scored, fn($a, $b) => $b['score'] <=> $a['score']);
    $result = array_column($scored, 'post');

    if (count($result) < $maxRelated) {
        $existing = array_merge(array_map(fn($p) => $p['slug'], $result), [$currentPostSlug]);
        $extra = array_filter($allPosts, fn($p) => !in_array($p['slug'], $existing));
        shuffle($extra);
        $result = array_merge($result, array_slice(array_values($extra), 0, $maxRelated - count($result)));
    }
    return array_slice($result, 0, $maxRelated);
}

/* ── Helper: build one editorial grid row ── */
function build_card($post, $variant = '') {
    $url      = '/blog/' . htmlspecialchars($post['slug']) . '/';
    $cat      = derive_cat($post);
    $catLbl   = cat_label($cat);
    $img      = get_card_img($post);
    $excerpt  = get_excerpt($post);
    $read     = estimate_read($post);
    $date     = fmt_date($post['date'] ?? '');
    $dateIso  = htmlspecialchars($post['date'] ?? '');
    $title    = htmlspecialchars($post['title'] ?? '');
    return '
    <div class="card-wrap" data-cat="' . $cat . '">
      <article class="card ' . $variant . '" itemscope itemtype="https://schema.org/BlogPosting">
        <a href="' . $url . '" aria-label="' . $title . '">
          <div class="card-img">
            <img src="' . htmlspecialchars($img) . '" alt="' . $title . '" loading="lazy" width="400" height="225" itemprop="image">
          </div>
          <div class="card-body">
            <span class="card-category cat-' . $cat . '" itemprop="articleSection">' . $catLbl . '</span>
            <h2 class="card-title" itemprop="headline">' . $title . '</h2>
            <p class="card-excerpt" itemprop="description">' . $excerpt . '</p>
            <footer class="card-footer">
              <time datetime="' . $dateIso . '" itemprop="datePublished">' . $date . '</time>
              <span class="reading-time">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                ' . $read . ' min
              </span>
            </footer>
          </div>
        </a>
      </article>
    </div>';
}

function build_grid($posts) {
    if (empty($posts)) return '<p style="color:var(--muted);padding:3rem 2.5rem;font-size:0.95rem;">No hay artículos en esta categoría.</p>';
    $templates = [[7,5],[4,4,4],[12],[5,7],[6,3,3],[4,4,4],[7,5],[4,4,4],[12],[5,7],[4,4,4],[7,5]];
    $html = ''; $i = 0; $tIdx = 0;
    while ($i < count($posts)) {
        $tpl   = $templates[$tIdx % count($templates)];
        $count = min(count($tpl), count($posts) - $i);
        $slice = array_slice($posts, $i, $count);
        $activeTpl = array_slice($tpl, 0, $count);
        $cols  = implode('-', $activeTpl);
        $rowHtml = '';
        foreach ($slice as $pos => $p) {
            $variant = '';
            if ($count === 1) $variant = 'wide';
            elseif ($pos === 0 && str_starts_with($cols, '7')) $variant = 'large';
            elseif ($cols === '12') $variant = 'overlay';
            $rowHtml .= build_card($p, $variant);
        }
        $html .= '<div class="grid-row r-' . $cols . '">' . $rowHtml . '</div>';
        $i += $count; $tIdx++;
    }
    return $html;
}

// ── Load post data ──
include_once __DIR__ . '/api/BLOG_inc/includes/posts.estructura-datos.php';

// Attach stable sort index
foreach ($blogPosts as $k => &$ref) { $ref['original_index'] = $k; }
unset($ref);

// Sort newest first
usort($blogPosts, function($a, $b) {
    $tA = isset($a['date']) ? (strtotime($a['date']) ?: 0) : 0;
    $tB = isset($b['date']) ? (strtotime($b['date']) ?: 0) : 0;
    if ($tB === $tA) return ($b['original_index'] ?? 0) <=> ($a['original_index'] ?? 0);
    return $tB <=> $tA;
});
$all_posts = $blogPosts;

// ── URL & routing ──
$proto    = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? 'https:' : 'http:';
$host     = $_SERVER['HTTP_HOST'] ?? 'josicovila.es';
$base_url = $proto . '//' . $host;

$currentPost        = null;
$is_single          = false;
$is_tag             = false;
$current_tag        = null;
$canonical          = $base_url . '/';
$page_title         = 'Blog de Josico Vila — Mundo 3D, Dragones, Desarrollo y Relatos';
$meta_description   = 'El blog de Josico Vila: detrás del Pueblo de los Dragones. Artículos sobre desarrollo 3D con Three.js, dragones, música, multijugador y relatos para toda la familia.';

if (isset($_GET['post'])) {
    $slug = strip_tags((string)$_GET['post']);
    foreach ($all_posts as $p) {
        if ($p['slug'] === $slug) { $currentPost = $p; break; }
    }
    if ($currentPost) {
        $is_single        = true;
        $page_title       = htmlspecialchars($currentPost['title']) . ' | Blog de Josico Vila';
        $meta_description = !empty($currentPost['meta_description'])
            ? htmlspecialchars($currentPost['meta_description'])
            : generar_extracto($currentPost['content']);
        $canonical = $base_url . '/blog/' . htmlspecialchars($currentPost['slug']) . '/';
    }
} elseif (isset($_GET['tag'])) {
    $current_tag = trim(strip_tags((string)$_GET['tag']));
    if ($current_tag) {
        $is_tag     = true;
        $page_title = 'Etiqueta: ' . htmlspecialchars($current_tag) . ' — Blog de Josico Vila';
        $canonical  = $base_url . '/blog/tag/' . urlencode($current_tag) . '/';
    }
}
?>
<!DOCTYPE html>
<html lang="es" prefix="og: https://ogp.me/ns#">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page_title ?></title>
  <meta name="description" content="<?= $meta_description ?>">
  <meta name="author" content="Josico Vila">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
  <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
  <link rel="icon" type="image/png" href="/media/img/logo.png">

  <?php if ($is_single && $currentPost): ?>
  <meta property="og:type" content="article">
  <meta property="article:published_time" content="<?= htmlspecialchars($currentPost['date'] ?? '') ?>">
  <meta property="article:author" content="Josico Vila">
  <?php else: ?>
  <meta property="og:type" content="website">
  <?php endif; ?>
  <meta property="og:site_name" content="JosicoVila.es">
  <meta property="og:title" content="<?= $page_title ?>">
  <meta property="og:description" content="<?= $meta_description ?>">
  <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
  <meta property="og:image" content="https://josicovila.es/BLOG_media/media/img/pequeno-dragon-volando.png">
  <meta property="og:locale" content="es_ES">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= $page_title ?>">
  <meta name="twitter:description" content="<?= $meta_description ?>">
  <meta name="twitter:image" content="https://josicovila.es/BLOG_media/media/img/pequeno-dragon-volando.png">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Uncial+Antiqua&family=Almendra:ital,wght@0,400;0,700;1,400&family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/css/blog-styles.css">

  <!-- Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-MZ739R29ER"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date()); gtag('config', 'G-MZ739R29ER');
  </script>

  <!-- JSON-LD -->
  <?php if ($is_single && $currentPost): ?>
  <script type="application/ld+json">
  {
    "@context":"https://schema.org",
    "@type":"BlogPosting",
    "headline":<?= json_encode($currentPost['title']) ?>,
    "datePublished":<?= json_encode($currentPost['date'] ?? '') ?>,
    "author":{"@type":"Person","name":"Josico Vila","url":"https://josicovila.es/"},
    "publisher":{"@type":"Organization","name":"JosicoVila.es","logo":{"@type":"ImageObject","url":"https://josicovila.es/media/img/firma-transparente-blanco.png"}},
    "mainEntityOfPage":<?= json_encode($canonical) ?>,
    "inLanguage":"es"
  }
  </script>
  <?php else: ?>
  <script type="application/ld+json">
  {
    "@context":"https://schema.org",
    "@type":"Blog",
    "name":"Blog de Josico Vila",
    "url":"https://josicovila.es/",
    "author":{"@type":"Person","name":"Josico Vila","url":"https://josicovila.es/"},
    "inLanguage":"es"
  }
  </script>
  <?php endif; ?>
</head>
<body>

<?php if ($is_single): ?>
<!-- ── READING PROGRESS (post view) ── -->
<div id="progress-bar" role="progressbar" aria-label="Progreso de lectura"></div>
<?php endif; ?>

<!-- ══════════ NAV ══════════ -->
<nav class="site-nav" aria-label="Navegación principal">
  <a class="nav-logo" href="/" aria-label="Inicio JosicoVila.es">
    <img src="/media/img/firma-transparente-blanco.png" alt="Josico Vila" width="120" height="36">
  </a>
  <ul class="nav-links" role="list">
    <li><a href="/">Blog</a></li>
    <li><a href="/mundo3D/">Mundo 3D</a></li>
    <li><a href="/blog/guia-nuevos-jugadores/">Guía</a></li>
  </ul>
  <a class="nav-cta" href="/mundo3D/" aria-label="Jugar al Mundo 3D de Josico Vila">▶ Jugar ahora</a>
</nav>

<?php if ($is_single && $currentPost): ?>
<!-- ══════════════════════════════════════════════════════
     SINGLE POST VIEW
     ══════════════════════════════════════════════════════ -->

<?php
$postCat    = derive_cat($currentPost);
$postRead   = estimate_read($currentPost);
$postImg    = get_card_img($currentPost);
$postDate   = fmt_date($currentPost['date'] ?? '');
$postDateIso= htmlspecialchars($currentPost['date'] ?? '');
?>

<!-- POST HERO -->
<header class="post-hero" aria-label="Cabecera del artículo"
        style="--post-hero-img: url('<?= htmlspecialchars($postImg) ?>')">
  <div class="post-hero-img" role="img"
       aria-label="<?= htmlspecialchars($currentPost['title']) ?>"></div>
  <div class="post-hero-inner">
    <nav class="breadcrumb" aria-label="Ruta de navegación">
      <a href="/">Inicio</a>
      <span class="sep">›</span>
      <a href="/">Blog</a>
      <span class="sep">›</span>
      <a href="/blog/tag/<?= urlencode($postCat) ?>/"><?= cat_label($postCat) ?></a>
      <span class="sep">›</span>
      <span class="current"><?= htmlspecialchars(mb_substr($currentPost['title'], 0, 40)) ?>…</span>
    </nav>
    <span class="post-category-label cat-<?= $postCat ?>"><?= cat_label($postCat) ?></span>
    <h1 class="post-title" itemprop="headline"><?= htmlspecialchars($currentPost['title']) ?></h1>
    <div class="post-meta">
      <time datetime="<?= $postDateIso ?>"><?= $postDate ?></time>
      <span class="dot">·</span>
      <span class="post-read-time">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <?= $postRead ?> min de lectura
      </span>
      <span class="dot">·</span>
      <span>por <strong>Josico Vila</strong></span>
    </div>
  </div>
</header>

<!-- POST LAYOUT -->
<div class="post-layout">

  <!-- BODY -->
  <article class="post-body" itemscope itemtype="https://schema.org/BlogPosting">
    <meta itemprop="headline"      content="<?= htmlspecialchars($currentPost['title']) ?>">
    <meta itemprop="datePublished" content="<?= $postDateIso ?>">
    <meta itemprop="author"        content="Josico Vila">

    <div class="post-content" id="post-content">
      <?= $currentPost['content'] ?>
    </div>

    <!-- Tags -->
    <?php if (!empty($currentPost['tags'])): ?>
    <nav class="post-tags" aria-label="Etiquetas del artículo">
      <?php foreach ($currentPost['tags'] as $tag): ?>
      <a href="/blog/tag/<?= urlencode($tag) ?>/"><?= htmlspecialchars($tag) ?></a>
      <?php endforeach; ?>
    </nav>
    <?php endif; ?>

    <!-- Social -->
    <div class="post-social">
      <span>Josico en</span>
      <a class="social-link" href="https://www.youtube.com/@josicovila" rel="noopener" target="_blank" aria-label="Canal YouTube de Josico Vila">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23 7s-.3-2-1.2-2.7c-1.1-1.2-2.4-1.2-3-1.3C16.2 3 12 3 12 3s-4.2 0-6.8.1c-.6.1-1.9.1-3 1.3C1.3 5 1 7 1 7S.7 9.1.7 11.2v2c0 2 .3 4.1.3 4.1s.3 2 1.2 2.7c1.1 1.2 2.6 1.1 3.3 1.2C7.2 21.4 12 21.5 12 21.5s4.2 0 6.8-.2c.6-.1 1.9-.1 3-1.3.9-.7 1.2-2.7 1.2-2.7s.3-2.1.3-4.1v-2C23.3 9.1 23 7 23 7zM9.7 15.5V8.4l6.6 3.6-6.6 3.5z"/></svg>
        YouTube
      </a>
      <a class="social-link" href="https://www.facebook.com/JosicoVila78" rel="noopener" target="_blank" aria-label="Facebook de Josico Vila">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
        Facebook
      </a>
      <a class="social-link" href="https://www.instagram.com/josicovila/" rel="noopener" target="_blank" aria-label="Instagram de Josico Vila">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
        Instagram
      </a>
    </div>

    <!-- Author -->
    <div class="author-box" itemscope itemtype="https://schema.org/Person">
      <img src="/media/img/firma-transparente-blanco.png" alt="Josico Vila" width="56" height="56" itemprop="image">
      <div>
        <p class="author-name" itemprop="name">Josico Vila</p>
        <p class="author-bio" itemprop="description">Desarrollador, compositor y escritor. Creador del Pueblo de los Dragones y de todo lo que contiene este sitio. Ha escrito cuatro libros y trece relatos cortos, y compone música instrumental desde 2018.</p>
      </div>
    </div>

    <!-- Comments (Cusdis) -->
    <div class="comments-section">
      <h2>Comentarios</h2>
      <div id="cusdis_thread"
           data-host="https://cusdis.com"
           data-app-id="815efe41-40d2-4b22-955b-70a6e46e8cc7"
           data-page-id="<?= htmlspecialchars($currentPost['slug']) ?>"
           data-page-url="<?= htmlspecialchars($canonical) ?>"
           data-page-title="<?= htmlspecialchars($currentPost['title']) ?>"
           data-language="es"
           data-theme="dark"></div>
      <script async defer src="https://cusdis.com/js/cusdis.es.js"></script>
    </div>
  </article>

  <!-- SIDEBAR TOC (JS-generated) -->
  <aside class="post-aside" aria-label="Tabla de contenidos">
    <p class="toc-label">En este artículo</p>
    <ul class="toc-list" id="toc-list" role="list"></ul>
  </aside>

</div><!-- /post-layout -->

<!-- RELATED -->
<?php
$related = get_related_posts($currentPost['slug'], $all_posts, 4);
if (!empty($related)):
?>
<section class="related-section" aria-label="Artículos relacionados">
  <div class="related-inner">
    <p class="related-label">También te podría interesar</p>
    <div class="related-grid">
      <?php foreach ($related as $rp): ?>
      <?php
        $rCat = derive_cat($rp);
        $rImg = get_card_img($rp);
        $rExc = get_excerpt($rp);
      ?>
      <a class="rel-card" href="/blog/<?= htmlspecialchars($rp['slug']) ?>/">
        <img src="<?= htmlspecialchars($rImg) ?>" alt="<?= htmlspecialchars($rp['title']) ?>" loading="lazy" width="400" height="225">
        <div class="rel-card-body">
          <p class="rel-cat cat-<?= $rCat ?>"><?= cat_label($rCat) ?></p>
          <h3 class="rel-title"><?= htmlspecialchars($rp['title']) ?></h3>
          <p class="rel-excerpt"><?= $rExc ?></p>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php else: ?>
<!-- ══════════════════════════════════════════════════════
     BLOG HOME / TAG VIEW
     ══════════════════════════════════════════════════════ -->

<?php if ($is_tag): ?>
<!-- TAG VIEW: simple header + full grid filtered -->
<?php
$tag_posts = array_filter($all_posts, fn($p) => in_array($current_tag, $p['tags'] ?? []));
$tag_posts = array_values($tag_posts);
?>
<div style="margin-top:64px"></div>
<div class="tag-view-header">
  <p class="section-label" aria-hidden="true">Etiqueta</p>
  <h1 class="tag-filter-heading">Artículos sobre <em><?= htmlspecialchars($current_tag) ?></em></h1>
</div>
<main class="blog-main" aria-label="Artículos con la etiqueta <?= htmlspecialchars($current_tag) ?>">
  <div class="grid-wrap">
    <?= build_grid($tag_posts) ?>
  </div>
</main>

<?php else: ?>
<!-- HOME: hero + filter + full editorial grid -->

<?php
$hero = $all_posts[0] ?? null;
$heroImg     = $hero ? get_card_img($hero) : '';
$heroExcerpt = $hero ? get_excerpt($hero) : '';
$heroCat     = $hero ? derive_cat($hero) : '';
$heroDate    = $hero ? fmt_date($hero['date'] ?? '') : '';
$heroRead    = $hero ? estimate_read($hero) : 0;
$heroDateIso = $hero ? htmlspecialchars($hero['date'] ?? '') : '';
?>

<!-- HERO -->
<header class="blog-hero" aria-label="Artículo destacado"
        style="--hero-img: url('<?= htmlspecialchars($heroImg) ?>')">
  <div class="blog-hero-bg" role="img"
       aria-label="<?= $hero ? htmlspecialchars($hero['title']) : '' ?>"></div>
  <?php if ($hero): ?>
  <div class="blog-hero-content">
    <span class="hero-tag">Destacado</span>
    <h1 class="blog-hero-title"><?= htmlspecialchars($hero['title']) ?></h1>
    <p class="blog-hero-excerpt"><?= $heroExcerpt ?></p>
    <div class="blog-hero-meta">
      <time datetime="<?= $heroDateIso ?>"><?= $heroDate ?></time>
      <span class="sep">·</span>
      <span><?= $heroRead ?> min de lectura</span>
      <span class="sep">·</span>
      <a class="hero-read-link" href="/blog/<?= htmlspecialchars($hero['slug']) ?>/">
        Leer artículo →
      </a>
    </div>
  </div>
  <?php endif; ?>
</header>

<!-- FILTER BAR -->
<div class="filter-bar" role="navigation" aria-label="Filtrar por categoría">
  <div class="filter-inner">
    <button class="filter-btn active" data-cat="todos">Todos</button>
    <button class="filter-btn" data-cat="dragones">Dragones</button>
    <button class="filter-btn" data-cat="mundo3d">Mundo 3D</button>
    <button class="filter-btn" data-cat="desarrollo">Desarrollo</button>
    <button class="filter-btn" data-cat="musica">Música</button>
    <button class="filter-btn" data-cat="multijugador">Multijugador</button>
    <button class="filter-btn" data-cat="relatos">Relatos</button>
  </div>
</div>

<!-- MAIN GRID -->
<main id="articulos" class="blog-main" aria-label="Todos los artículos del blog">
  <p class="section-label" aria-hidden="true">Últimas publicaciones</p>
  <div class="grid-wrap" id="grid">
    <?= build_grid($all_posts) ?>
  </div>
</main>

<?php endif; ?>
<?php endif; ?>

<!-- ══════════ FOOTER ══════════ -->
<footer class="site-footer">
  <div class="footer-logo">
    <img src="/media/img/firma-transparente-blanco.png" alt="Josico Vila" width="100" height="30">
  </div>
  <p>© <?= date('Y') ?> <a href="/">JosicoVila.es</a> · Blog personal sobre el <a href="/mundo3D/">Pueblo de los Dragones</a></p>
</footer>

<!-- ══════════ SCRIPTS ══════════ -->

<?php if (!$is_single && !$is_tag): ?>
<script>
/* Category filter — toggle hidden class on card-wrap elements */
const filterBtns = document.querySelectorAll('.filter-btn');
const grid       = document.getElementById('grid');

filterBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    filterBtns.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const cat = btn.dataset.cat;

    grid.style.transition = 'opacity 0.18s ease';
    grid.style.opacity = '0';
    setTimeout(() => {
      grid.querySelectorAll('.card-wrap').forEach(el => {
        el.classList.toggle('hidden', cat !== 'todos' && el.dataset.cat !== cat);
      });
      /* re-trigger stagger animation */
      grid.querySelectorAll('.card-wrap:not(.hidden)').forEach((el, i) => {
        el.style.animationDelay = Math.min(i * 0.06, 0.5) + 's';
        el.style.animation = 'none';
        el.offsetHeight;
        el.style.animation = '';
      });
      grid.style.opacity = '1';
    }, 180);
  });
});

/* Scroll reveal */
const revealObs = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el = entry.target;
      el.style.animation = 'none';
      el.offsetHeight;
      el.style.animation = '';
      revealObs.unobserve(el);
    }
  });
}, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

grid.querySelectorAll('.card-wrap').forEach((el, i) => {
  el.style.animationDelay = Math.min(i * 0.04, 0.5) + 's';
  revealObs.observe(el);
});
</script>
<?php endif; ?>

<?php if ($is_single): ?>
<script>
/* Reading progress bar */
const bar = document.getElementById('progress-bar');
window.addEventListener('scroll', () => {
  const scrolled = window.scrollY;
  const total    = document.documentElement.scrollHeight - window.innerHeight;
  if (total > 0) bar.style.width = Math.min((scrolled / total) * 100, 100) + '%';
}, { passive: true });

/* Build TOC from post content h2/h3 */
const tocList = document.getElementById('toc-list');
const postContent = document.getElementById('post-content');

if (tocList && postContent) {
  const hs = Array.from(postContent.querySelectorAll('h2, h3'))
    .filter((heading) => heading.textContent.trim().length > 0);

  const slugifyHeading = (text) => text
    .toLowerCase()
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '')
    .replace(/[^\w\s-]/g, '')
    .trim()
    .replace(/\s+/g, '-');

  hs.forEach((heading, index) => {
    if (!heading.id) {
      const baseId = slugifyHeading(heading.textContent) || `seccion-${index + 1}`;
      let nextId = baseId;
      let suffix = 2;
      while (document.getElementById(nextId)) {
        nextId = `${baseId}-${suffix++}`;
      }
      heading.id = nextId;
    }

    const li = document.createElement('li');
    li.className = `toc-item toc-item--${heading.tagName.toLowerCase()}`;

    const a = document.createElement('a');
    a.href = `#${heading.id}`;
    a.textContent = heading.textContent.replace(/^[^\p{L}\p{N}]+/u, '').trim();
    a.addEventListener('click', (event) => {
      event.preventDefault();
      heading.scrollIntoView({ behavior: 'smooth', block: 'start' });
      history.replaceState(null, '', `#${heading.id}`);
    });

    li.appendChild(a);
    tocList.appendChild(li);
  });

  if (hs.length === 0) {
    const empty = document.createElement('li');
    empty.className = 'toc-empty';
    empty.textContent = 'Este artículo no tiene subtítulos.';
    tocList.appendChild(empty);
  } else {
    const tocLinks = Array.from(tocList.querySelectorAll('a'));

    const setActiveHeading = (heading) => {
      tocLinks.forEach((link) => link.classList.toggle('active', link.getAttribute('href') === `#${heading.id}`));
      hs.forEach((item) => item.classList.toggle('is-current-section', item === heading));
    };

    setActiveHeading(hs[0]);

    const obs = new IntersectionObserver((entries) => {
      const visible = entries
        .filter((entry) => entry.isIntersecting)
        .sort((a, b) => a.boundingClientRect.top - b.boundingClientRect.top);

      if (visible.length > 0) {
        setActiveHeading(visible[0].target);
      }
    }, { rootMargin: '-18% 0px -68% 0px', threshold: [0, 1] });

    hs.forEach((heading) => obs.observe(heading));
  }
}
</script>
<?php endif; ?>

</body>
</html>
