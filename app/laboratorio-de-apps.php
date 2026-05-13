<?php
$page_title       = 'Laboratorio de Apps — JosicoVila.es';
$meta_description = 'Un rincón nocturno donde guardo las apps que voy criando en mi taller. Algunas son huevos aún por incubar, otras eclosionan entre líneas de código, y unas pocas ya vuelan libres.';
$canonical        = 'https://josicovila.es/laboratorio-de-apps/';

/* ── Load apps data ── */
$apps_data = json_decode(file_get_contents(__DIR__ . '/laboratorio-apps.json'), true);
$apps      = $apps_data['apps'] ?? [];

/* ── Stage metadata ── */
$stage_meta = [
    'free'  => ['label' => 'Vuela libre',  'class' => 'stage-free',  'dot_color' => 'var(--lab-ember)'],
    'hatch' => ['label' => 'Eclosionando', 'class' => 'stage-hatch', 'dot_color' => 'var(--lab-aurora)'],
    'egg'   => ['label' => 'En el huevo',  'class' => 'stage-egg',   'dot_color' => 'var(--lab-magic)'],
];

/* ── Stage counts for filter chips ── */
$counts = ['all' => count($apps), 'free' => 0, 'hatch' => 0, 'egg' => 0];
foreach ($apps as $a) {
    $s = $a['stage'] ?? '';
    if (isset($counts[$s])) $counts[$s]++;
}

/* ── Icon SVG paths (inner content only, wrapper added in render) ── */
$icons = [
    'globe'   => '<circle cx="12" cy="12" r="9"/><path d="M12 3c-2.5 3-4 5.5-4 9s1.5 6 4 9"/><path d="M12 3c2.5 3 4 5.5 4 9s-1.5 6-4 9"/><path d="M3 12h18"/>',
    'compass' => '<circle cx="12" cy="12" r="9"/><path d="M15.5 8.5 13 13l-4.5 2.5L11 11z"/><circle cx="12" cy="12" r=".8" fill="currentColor"/>',
    'box3d'   => '<path d="M4 7h16v12H4z"/><path d="M4 7 12 3l8 4"/><path d="M9 13h6"/>',
    'timer'   => '<path d="M12 21V8"/><path d="M6 21v-8"/><path d="M18 21v-5"/><circle cx="12" cy="4.5" r="1.5"/>',
    'prompt'  => '<path d="M3 7h18v4H3zM3 13h12v4H3z"/><path d="M7 17v2M11 17v2M15 17v2"/>',
    'drop'    => '<path d="M12 3c4 0 7 5 7 10a7 7 0 1 1-14 0c0-5 3-10 7-10Z"/><path d="M9 11h6M9 14h6M9 17h4"/>',
    'screen'  => '<rect x="3" y="4" width="18" height="14" rx="2"/><path d="M8 20h8M12 18v2"/><path d="M8 9l3 3-3 3M13 15h4"/>',
    'code'    => '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>',
    'mobile'  => '<rect x="5" y="2" width="14" height="20" rx="2"/><circle cx="12" cy="17" r="1"/>',
    'link'    => '<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>',
];

$github_svg = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 .5a11.5 11.5 0 0 0-3.63 22.42c.58.1.79-.25.79-.56v-2.18c-3.2.7-3.87-1.36-3.87-1.36-.53-1.34-1.29-1.7-1.29-1.7-1.05-.72.08-.7.08-.7 1.16.08 1.77 1.2 1.77 1.2 1.03 1.76 2.7 1.25 3.36.96.1-.75.4-1.26.73-1.55-2.55-.3-5.24-1.28-5.24-5.7 0-1.26.45-2.28 1.19-3.09-.12-.3-.52-1.48.11-3.07 0 0 .97-.31 3.18 1.18a11 11 0 0 1 5.79 0c2.21-1.5 3.18-1.18 3.18-1.18.63 1.59.23 2.77.11 3.07.74.81 1.19 1.83 1.19 3.09 0 4.43-2.69 5.4-5.26 5.69.41.36.78 1.05.78 2.13v3.16c0 .31.21.67.8.55A11.5 11.5 0 0 0 12 .5Z"/></svg>';

$external_svg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>';

/* ── Render a single specimen card ── */
function render_specimen(array $app, array $stage_meta, array $icons, string $github_svg, string $external_svg): string {
    $stage      = $app['stage']  ?? 'egg';
    $layout     = $app['layout'] ?? 'normal';
    $sm         = $stage_meta[$stage] ?? $stage_meta['egg'];
    $icon_paths = $icons[$app['icon'] ?? 'globe'] ?? $icons['globe'];
    $glow       = htmlspecialchars($app['glow'] ?? 'rgba(212,180,101,.10)');
    $id_text    = htmlspecialchars('N.º ' . ($app['id'] ?? '???'));
    $badge      = !empty($app['badge']) ? ' · ' . htmlspecialchars($app['badge']) : '';

    $extra_class = match($layout) {
        'featured' => ' featured',
        'wide'     => ' wide',
        default    => '',
    };

    /* Tags */
    $tags_html = '';
    foreach ($app['tags'] ?? [] as $tag) {
        $tags_html .= '<span class="sp-tag">' . htmlspecialchars($tag) . '</span>';
    }

    /* Buttons */
    $btns_html = '';
    foreach ($app['buttons'] ?? [] as $btn) {
        $url   = htmlspecialchars($btn['url'] ?? '#');
        $label = htmlspecialchars($btn['label'] ?? '');
        $style = $btn['style'] ?? 'default';
        if ($style === 'github') {
            $btns_html .= '<a class="lab-btn" href="' . $url . '" aria-label="Ver en GitHub" target="_blank" rel="noopener">' . $github_svg . $label . '</a>';
        } elseif ($style === 'gold') {
            $btns_html .= '<a class="lab-btn gold" href="' . $url . '" target="_blank" rel="noopener">' . $external_svg . $label . '</a>';
        } elseif ($style === 'faded') {
            $btns_html .= '<span class="lab-btn faded">' . $label . '</span>';
        } else {
            $btns_html .= '<a class="lab-btn" href="' . $url . '" target="_blank" rel="noopener">' . $label . '</a>';
        }
    }

    $name     = htmlspecialchars($app['name'] ?? '');
    $subtitle = htmlspecialchars($app['subtitle'] ?? '');
    $desc     = htmlspecialchars($app['description'] ?? '');
    $meta     = $app['meta'] ?? '';

    return <<<HTML
    <article class="specimen{$extra_class}" data-stage="{$stage}" style="--glow:{$glow}">
      <span class="corner"></span><span class="corner bl"></span>
      <div class="sp-head">
        <span class="sp-id">{$id_text}{$badge}</span>
        <span class="sp-stage {$sm['class']}"><span class="dot"></span>{$sm['label']}</span>
      </div>
      <div class="sp-glyph">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{$icon_paths}</svg>
      </div>
      <h3 class="sp-name">{$name}
        <span class="latin">— {$subtitle}</span>
      </h3>
      <p class="sp-desc">{$desc}</p>
      <div class="sp-tags">{$tags_html}</div>
      <div class="sp-foot">
        <div class="sp-meta">{$meta}</div>
        <div class="sp-actions">{$btns_html}</div>
      </div>
    </article>
    HTML;
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
  <link rel="canonical" href="<?= $canonical ?>">
  <link rel="icon" type="image/png" href="/media/img/logo.png">

  <meta property="og:type" content="website">
  <meta property="og:site_name" content="JosicoVila.es">
  <meta property="og:title" content="<?= $page_title ?>">
  <meta property="og:description" content="<?= $meta_description ?>">
  <meta property="og:url" content="<?= $canonical ?>">
  <meta property="og:image" content="https://josicovila.es/BLOG_media/media/img/pequeno-dragon-volando.png">
  <meta property="og:locale" content="es_ES">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= $page_title ?>">
  <meta name="twitter:description" content="<?= $meta_description ?>">
  <meta name="twitter:image" content="https://josicovila.es/BLOG_media/media/img/pequeno-dragon-volando.png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=DM+Sans:wght@300;400;500;600&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/css/blog-styles.css">

  <script async src="https://www.googletagmanager.com/gtag/js?id=G-MZ739R29ER"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date()); gtag('config', 'G-MZ739R29ER');
  </script>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Laboratorio de Apps",
    "url": "https://josicovila.es/laboratorio-de-apps/",
    "author": {"@type": "Person", "name": "Josico Vila", "url": "https://josicovila.es/"},
    "inLanguage": "es"
  }
  </script>

  <style>
    /* ── Lab CSS variables ── */
    :root {
      --lab-ember:   #d4b465;
      --lab-ember2:  #b48e3a;
      --lab-aurora:  #5fb5b5;
      --lab-magic:   #a78bfa;
      --lab-ink:     #ece8df;
      --lab-ink2:    #b9b6a7;
      --lab-ink3:    #7a7768;
      --lab-line:    rgba(236,232,223,.10);
      --lab-line2:   rgba(236,232,223,.18);
      --serif:       "Cormorant Garamond", "EB Garamond", Georgia, serif;
      --mono:        "JetBrains Mono", ui-monospace, "SF Mono", Menlo, monospace;
    }

    /* ── Override body for lab page ── */
    body {
      background:
        radial-gradient(1200px 700px at 78% -8%, rgba(167,139,250,.12), transparent 60%),
        radial-gradient(900px 600px at 5% 105%, rgba(95,181,181,.10), transparent 55%),
        radial-gradient(1100px 800px at 50% 50%, rgba(212,180,101,.04), transparent 60%),
        linear-gradient(180deg, #06080d 0%, #0a0e1a 50%, #07090f 100%);
      color: var(--lab-ink);
      font-family: -apple-system, BlinkMacSystemFont, "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    /* ── Stars (replace noise texture) ── */
    body::before {
      background-image:
        radial-gradient(1.2px 1.2px at 12% 18%, rgba(255,255,255,.55), transparent 60%),
        radial-gradient(1px   1px   at 27% 72%, rgba(255,255,255,.4),  transparent 60%),
        radial-gradient(1.4px 1.4px at 58% 32%, rgba(255,255,255,.5),  transparent 60%),
        radial-gradient(1px   1px   at 84% 64%, rgba(255,255,255,.35), transparent 60%),
        radial-gradient(1.6px 1.6px at 91% 14%, rgba(255,255,255,.6),  transparent 60%),
        radial-gradient(1px   1px   at 41% 88%, rgba(255,255,255,.35), transparent 60%),
        radial-gradient(1.2px 1.2px at 70%  8%, rgba(255,255,255,.45), transparent 60%),
        radial-gradient(1px   1px   at  7% 50%, rgba(255,255,255,.35), transparent 60%);
      opacity: .7;
    }

    /* ── Nav: active link ── */
    .nav-links a[aria-current="page"] { color: var(--gold); }

    /* ── Main layout ── */
    .lab-main {
      position: relative; z-index: 1;
      max-width: 1200px; margin: 0 auto;
      padding: 88px 28px 120px;
    }

    /* ── Hero ── */
    .lab-hero {
      display: grid;
      grid-template-columns: 1.2fr .9fr;
      gap: 64px;
      align-items: end;
      padding-bottom: 56px;
      border-bottom: 1px solid var(--lab-line);
      margin-bottom: 48px;
    }
    .lab-eyebrow {
      font-family: var(--mono);
      font-size: 11px;
      letter-spacing: .32em;
      text-transform: uppercase;
      color: var(--lab-ember);
      display: inline-flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 24px;
    }
    .lab-eyebrow::before { content: ""; width: 28px; height: 1px; background: var(--lab-ember); }
    .lab-title {
      font-family: var(--serif);
      font-weight: 500;
      font-style: italic;
      font-size: clamp(48px, 7vw, 96px);
      line-height: .98;
      letter-spacing: -.01em;
      margin: 0 0 28px;
      color: var(--lab-ink);
      text-wrap: balance;
    }
    .lab-title em  { font-style: italic; color: var(--lab-ember); font-weight: 600; }
    .lab-title .amp { font-family: var(--serif); font-style: italic; color: var(--lab-ink3); padding: 0 .12em; }
    .lab-lede {
      font-family: var(--serif);
      font-size: 20px;
      line-height: 1.5;
      color: var(--lab-ink2);
      max-width: 54ch;
      font-weight: 400;
    }
    .lab-lede em { color: var(--lab-ember); font-style: italic; }
    .lab-hero-meta {
      font-family: var(--mono);
      font-size: 11px;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: var(--lab-ink3);
      display: grid;
      gap: 18px;
      padding-bottom: 18px;
    }
    .lab-hero-meta .row {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px dashed var(--lab-line);
      padding-bottom: 14px;
    }
    .lab-hero-meta .row b { color: var(--lab-ink); font-weight: 500; letter-spacing: .1em; }

    /* ── Filter chips ── */
    .lab-legend {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      align-items: center;
      margin-bottom: 36px;
    }
    .lab-legend .label {
      font-family: var(--mono);
      font-size: 10.5px;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: var(--lab-ink3);
      margin-right: 6px;
    }
    .lab-chip {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 7px 14px 7px 10px;
      border-radius: 999px;
      border: 1px solid var(--lab-line2);
      background: rgba(255,255,255,.02);
      font-family: var(--mono);
      font-size: 11px;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--lab-ink2);
      cursor: pointer;
      transition: all .2s;
      user-select: none;
    }
    .lab-chip:hover { color: var(--lab-ink); background: rgba(255,255,255,.04); }
    .lab-chip.active {
      color: #0b0c10;
      background: var(--lab-ember);
      border-color: var(--lab-ember2);
      box-shadow: 0 0 18px rgba(212,180,101,.25);
    }
    .lab-chip .dot { width: 7px; height: 7px; border-radius: 50%; }
    .lab-chip .count { opacity: .55; margin-left: 4px; }

    /* ── Specimen grid ── */
    .lab-grid {
      display: grid;
      grid-template-columns: repeat(12, 1fr);
      gap: 22px;
    }
    .specimen {
      grid-column: span 4;
      position: relative;
      padding: 24px 24px 22px;
      border-radius: 18px;
      background: linear-gradient(180deg, rgba(255,255,255,.03), rgba(255,255,255,.015));
      border: 1px solid var(--lab-line);
      transition: transform .35s cubic-bezier(.2,.7,.2,1), border-color .25s, box-shadow .35s;
      overflow: hidden;
      min-height: 300px;
      display: flex;
      flex-direction: column;
      text-decoration: none;
      color: inherit;
    }
    .specimen::before {
      content: "";
      position: absolute;
      inset: 0;
      border-radius: inherit;
      pointer-events: none;
      background: radial-gradient(380px 200px at var(--mx,30%) var(--my,0%), var(--glow,rgba(212,180,101,.10)), transparent 60%);
      opacity: 0;
      transition: opacity .35s;
    }
    .specimen:hover { transform: translateY(-4px); border-color: var(--lab-line2); }
    .specimen:hover::before { opacity: 1; }
    .specimen.featured { grid-column: span 8; min-height: 380px; padding: 36px 38px 32px; }
    .specimen.wide { grid-column: span 6; }

    .specimen .corner {
      position: absolute; top: 14px; right: 14px;
      width: 10px; height: 10px;
      border-top: 1px solid var(--lab-line2); border-right: 1px solid var(--lab-line2);
    }
    .specimen .corner.bl {
      top: auto; right: auto; bottom: 14px; left: 14px;
      border: 0;
      border-bottom: 1px solid var(--lab-line2); border-left: 1px solid var(--lab-line2);
    }

    .sp-head {
      display: flex; align-items: center;
      justify-content: space-between; gap: 12px; margin-bottom: 18px;
    }
    .sp-id {
      font-family: var(--mono); font-size: 10px;
      letter-spacing: .2em; text-transform: uppercase;
      color: var(--lab-ink3);
    }
    .sp-stage {
      display: inline-flex; align-items: center; gap: 7px;
      font-family: var(--mono); font-size: 10px;
      letter-spacing: .14em; text-transform: uppercase;
      padding: 5px 10px 5px 8px; border-radius: 999px;
      border: 1px solid var(--lab-line2);
      background: rgba(0,0,0,.25); color: var(--lab-ink2);
    }
    .sp-stage .dot { width: 6px; height: 6px; border-radius: 50%; }
    .stage-egg .dot  { background: var(--lab-magic); box-shadow: 0 0 8px var(--lab-magic); }
    .stage-egg       { color: #cdbef9; border-color: rgba(167,139,250,.35); }
    .stage-hatch .dot { background: var(--lab-aurora); box-shadow: 0 0 8px var(--lab-aurora); animation: lab-pulse 1.8s infinite; }
    .stage-hatch     { color: #a4dadc; border-color: rgba(95,181,181,.35); }
    .stage-free .dot { background: var(--lab-ember); box-shadow: 0 0 10px var(--lab-ember); }
    .stage-free      { color: #f0d999; border-color: rgba(212,180,101,.45); }
    @keyframes lab-pulse { 0%,100%{ opacity:1; transform:scale(1) } 50%{ opacity:.55; transform:scale(.85) } }

    .sp-glyph {
      width: 64px; height: 64px; margin-bottom: 18px;
      display: flex; align-items: center; justify-content: center;
      border-radius: 14px;
      background: rgba(255,255,255,.03); border: 1px solid var(--lab-line);
      position: relative; overflow: hidden;
    }
    .sp-glyph svg { width: 34px; height: 34px; color: var(--lab-ember); filter: drop-shadow(0 0 6px rgba(212,180,101,.5)); }
    .specimen.featured .sp-glyph { width: 78px; height: 78px; }
    .specimen.featured .sp-glyph svg { width: 44px; height: 44px; }

    h3.sp-name {
      font-family: var(--serif);
      font-weight: 500; font-size: 30px;
      line-height: 1.05; margin: 0 0 10px;
      letter-spacing: -.01em; color: var(--lab-ink);
    }
    .specimen.featured h3.sp-name { font-size: 44px; }
    h3.sp-name .latin {
      display: block; font-style: italic;
      font-size: .55em; color: var(--lab-ink3);
      font-weight: 400; margin-top: 4px; letter-spacing: .02em;
    }

    p.sp-desc {
      font-family: var(--serif);
      font-size: 17px; line-height: 1.5;
      color: var(--lab-ink2); margin: 0 0 20px; flex: 1;
    }
    .specimen.featured p.sp-desc { font-size: 19px; max-width: 48ch; }

    .sp-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 18px; }
    .sp-tag {
      font-family: var(--mono); font-size: 10px;
      letter-spacing: .12em; text-transform: uppercase;
      padding: 4px 8px; border-radius: 4px;
      background: rgba(255,255,255,.04);
      color: var(--lab-ink3); border: 1px solid var(--lab-line);
    }

    .sp-foot {
      display: flex; align-items: center;
      justify-content: space-between; gap: 12px;
      padding-top: 16px; border-top: 1px dashed var(--lab-line);
      margin-top: auto;
    }
    .sp-actions { display: flex; gap: 8px; flex-wrap: wrap; }
    .lab-btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 8px 13px; border-radius: 8px;
      font-family: var(--mono); font-size: 11px;
      letter-spacing: .12em; text-transform: uppercase;
      border: 1px solid var(--lab-line2);
      color: var(--lab-ink); background: rgba(255,255,255,.03);
      transition: all .2s; text-decoration: none;
    }
    .lab-btn:hover { background: rgba(255,255,255,.07); border-color: var(--lab-ink3); color: var(--lab-ink); }
    .lab-btn.gold {
      color: #0b0c10; background: var(--lab-ember); border-color: var(--lab-ember2);
      box-shadow: 0 0 18px rgba(212,180,101,.2), inset 0 1px 0 rgba(255,255,255,.3);
    }
    .lab-btn.gold:hover { box-shadow: 0 0 24px rgba(212,180,101,.4), inset 0 1px 0 rgba(255,255,255,.35); }
    .lab-btn svg { width: 12px; height: 12px; }
    .lab-btn.faded { opacity: .55; pointer-events: none; }

    .sp-meta {
      font-family: var(--mono); font-size: 10px;
      letter-spacing: .18em; text-transform: uppercase;
      color: var(--lab-ink3);
    }
    .sp-meta b { color: var(--lab-ink2); font-weight: 500; }

    /* ── Empty card ── */
    .empty-card {
      grid-column: span 4;
      border: 1px dashed var(--lab-line2); border-radius: 18px;
      min-height: 300px; display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      text-align: center; padding: 24px;
      background: transparent; color: var(--lab-ink3);
      font-family: var(--serif); font-style: italic; font-size: 20px;
    }
    .empty-card .plus {
      font-family: var(--serif); font-size: 48px;
      line-height: 1; margin-bottom: 10px; color: var(--lab-ember);
    }
    .empty-card small {
      display: block; margin-top: 10px; font-family: var(--mono);
      font-style: normal; font-size: 10px;
      letter-spacing: .22em; text-transform: uppercase; color: var(--lab-ink3);
    }

    /* ── Lab footer ── */
    .lab-footer {
      max-width: 1200px; margin: 0 auto;
      padding: 48px 28px 64px;
      border-top: 1px solid var(--lab-line);
      position: relative; z-index: 1;
      display: flex; justify-content: space-between;
      align-items: center; gap: 24px;
      font-family: var(--mono); font-size: 11px;
      letter-spacing: .16em; text-transform: uppercase;
      color: var(--lab-ink3);
    }
    .lab-footer .sig {
      font-family: var(--serif); font-style: italic;
      font-size: 18px; letter-spacing: .02em;
      color: var(--lab-ink); text-transform: none;
    }

    /* ── Responsive ── */
    @media (max-width: 900px) {
      .lab-hero { grid-template-columns: 1fr; gap: 32px; }
      .specimen, .specimen.featured, .specimen.wide { grid-column: span 12; }
      .empty-card { grid-column: span 12; }
      .lab-main { padding: 80px 20px 80px; }
    }
  </style>
</head>
<body>

<nav class="site-nav" aria-label="Navegación principal">
  <a class="nav-logo" href="/" aria-label="Inicio JosicoVila.es">
    <img src="/media/img/firma-transparente-blanco.png" alt="Josico Vila" width="120" height="36">
  </a>
  <ul class="nav-links" role="list">
    <li><a href="/">Blog</a></li>
    <li><a href="/mundo3D/">Mundo 3D</a></li>
    <li><a href="/blog/guia-nuevos-jugadores/">Guía</a></li>
    <li><a href="/laboratorio-de-apps/" aria-current="page">Laboratorio</a></li>
  </ul>
  <button class="nav-hamburger" aria-label="Abrir menú" aria-expanded="false" aria-controls="nav-links-menu">
    <span></span><span></span><span></span>
  </button>
  <a class="nav-cta" href="/mundo3D/" aria-label="Jugar al Mundo 3D de Josico Vila">▶ Jugar ahora</a>
</nav>

<main class="lab-main">

  <!-- ── Hero ── -->
  <section class="lab-hero">
    <div>
      <div class="lab-eyebrow">Bitácora del laboratorio · MMXXVI</div>
      <h1 class="lab-title">
        El laboratorio<br>
        de las <em>criaturas</em><br>
        <span class="amp">&amp;</span>los <em>experimentos</em>.
      </h1>
      <p class="lab-lede">
        Un rincón nocturno donde guardo las <em>apps</em> que voy criando en mi taller. Algunas son
        <em>huevos</em> aún por incubar, otras <em>eclosionan</em> entre líneas de código,
        y unas pocas ya <em>vuelan libres</em>. Aquí las verás todas en su frasco.
      </p>
    </div>
    <div class="lab-hero-meta">
      <div class="row"><span>Coordenadas</span><b>48°N · Taller nocturno</b></div>
      <div class="row"><span>Especímenes</span><b>06 catalogados</b></div>
      <div class="row"><span>Actualizado</span><b>Mayo · MMXXVI</b></div>
      <div class="row"><span>Custodio</span><b>Josico Vila</b></div>
    </div>
  </section>

  <!-- ── Filter chips ── -->
  <div class="lab-legend" id="lab-legend" role="group" aria-label="Filtrar por fase">
    <span class="label">Filtrar por fase ›</span>
    <button class="lab-chip active" data-stage="all">Todos <span class="count">·<?= $counts['all'] ?></span></button>
    <button class="lab-chip" data-stage="free">
      <span class="dot" style="background:var(--lab-ember)"></span>Vuela libre <span class="count">·<?= $counts['free'] ?></span>
    </button>
    <button class="lab-chip" data-stage="hatch">
      <span class="dot" style="background:var(--lab-aurora)"></span>Eclosionando <span class="count">·<?= $counts['hatch'] ?></span>
    </button>
    <button class="lab-chip" data-stage="egg">
      <span class="dot" style="background:var(--lab-magic)"></span>En el huevo <span class="count">·<?= $counts['egg'] ?></span>
    </button>
  </div>

  <!-- ── Specimen grid ── -->
  <section class="lab-grid" id="lab-grid" aria-label="Apps del laboratorio">

    <?php foreach ($apps as $app): ?>
    <?= render_specimen($app, $stage_meta, $icons, $github_svg, $external_svg) ?>
    <?php endforeach; ?>

    <div class="empty-card">
      <span class="plus">+</span>
      Un frasco vacío
      <small>esperando una idea</small>
    </div>

  </section>

</main>

<footer class="lab-footer">
  <span class="sig">Josico Vila</span>
  <span>© MMXXVI · Pueblo de los Dragones · Laboratorio</span>
</footer>

<script>
  /* Filter chips */
  const chips = document.querySelectorAll('#lab-legend .lab-chip');
  const cards = document.querySelectorAll('#lab-grid .specimen');
  chips.forEach(chip => {
    chip.addEventListener('click', () => {
      chips.forEach(c => c.classList.remove('active'));
      chip.classList.add('active');
      const s = chip.dataset.stage;
      cards.forEach(card => {
        card.style.display = (s === 'all' || card.dataset.stage === s) ? '' : 'none';
      });
    });
  });

  /* Cursor glow on cards */
  cards.forEach(card => {
    card.addEventListener('mousemove', e => {
      const r = card.getBoundingClientRect();
      card.style.setProperty('--mx', ((e.clientX - r.left) / r.width  * 100) + '%');
      card.style.setProperty('--my', ((e.clientY - r.top)  / r.height * 100) + '%');
    });
  });

  /* Hamburger nav toggle */
  (function () {
    const btn   = document.querySelector('.nav-hamburger');
    const links = document.querySelector('.nav-links');
    if (!btn || !links) return;
    btn.addEventListener('click', () => {
      const open = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', String(!open));
      btn.setAttribute('aria-label', !open ? 'Cerrar menú' : 'Abrir menú');
      links.classList.toggle('is-open', !open);
    });
    document.addEventListener('click', (e) => {
      if (!e.target.closest('nav.site-nav') && links.classList.contains('is-open')) {
        btn.setAttribute('aria-expanded', 'false');
        btn.setAttribute('aria-label', 'Abrir menú');
        links.classList.remove('is-open');
      }
    });
  })();
</script>

</body>
</html>
