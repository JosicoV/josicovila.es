# CLAUDE.md — josicovila.es

## 1. Descripción del proyecto

Sitio web personal de José Vila (Josico Vila). Combina un **blog de desarrollo**, un **Mundo 3D multijugador** (El Pueblo de los Dragones, Three.js), un portal de **relatos y libros**, una sala de **música instrumental** (CRISTAL), un **laboratorio de apps** y el **currículum** en español e inglés.

Arrancado en 2018 bajo el principio *"Todo por y para mis sobrinos"*. Corre en un VPS propio con Docker y autodeploy desde GitHub Actions.

---

## 2. Stack técnico

| Capa | Tecnología |
|---|---|
| Backend | PHP 8.2 (sin framework, sin Composer) |
| Servidor | Apache 2.4 — `mod_rewrite`, `mod_headers`, `mod_expires` |
| Frontend | HTML5 + CSS3 + JavaScript vanilla |
| Motor 3D | Three.js r168 + GLTF/GLB + WebGL |
| Multijugador | Firebase Realtime Database |
| Bundle (3D) | Vite — **los assets compilados viven en `app/assets/`; el código fuente Vite no está en este repo** |
| Contenedor | Docker + Docker Compose |
| CI/CD | GitHub Actions → SSH → VPS (`docker compose up -d --build`) |

> No existe `composer.json`, `package.json`, `phpunit.xml` ni configuración de Vite en este checkout. Tratar los assets de `app/assets/` como artefactos compilados.

---

## 3. Estructura principal de carpetas

```
josicovila.es/
├── app/                            # Document root de Apache (bind-mount en local)
│   ├── index.php                   # Blog: listing, tag view, single post
│   ├── index-juego.php             # Mundo 3D + módulos CRISTAL/RELATOS/LIBROS embebidos
│   ├── laboratorio-de-apps.php     # Laboratorio de Apps (datos desde laboratorio-apps.json)
│   ├── laboratorio-apps.json       # Catálogo de apps del laboratorio
│   ├── .htaccess                   # Routing con mod_rewrite (URLs amigables)
│   ├── vite-helpers.php            # Helper para cargar el bundle de Vite
│   ├── assets/                     # Bundle compilado de Vite (NO editar manualmente)
│   ├── .vite/manifest.json         # Manifest Vite (NO editar manualmente)
│   ├── css/                        # Estilos globales (blog-styles.css)
│   ├── js/                         # Scripts del blog y sidebar
│   ├── api/
│   │   ├── BLOG_inc/includes/      # posts.estructura-datos.php, ajax search/random
│   │   ├── CRISTAL/includes/       # Arrays de música por categoría (*.estructura-datos.php)
│   │   ├── RELATOS/includes/       # relatos.estructura-datos.php, ajax.relato.php
│   │   └── LIBROS/includes/        # libros.estructura-datos.php
│   ├── CRISTAL/, RELATOS/, LIBROS/ # Imágenes estáticas de cada módulo
│   ├── curri/                      # Imágenes del CV
│   ├── curriculum_es.html          # CV en español
│   ├── curriculum_en.html          # CV en inglés
│   └── intro/images/               # Imágenes de la pantalla de intro
├── data/                           # Contenido multimedia (volúmenes Docker — mayoría fuera del repo)
│   └── blog-media/                 # Imágenes del blog (sí en repo)
├── docker/
│   └── apache-vhost.conf           # VirtualHost de Apache
├── Dockerfile                      # php:8.2-apache
├── docker-compose.yml              # Servicio web + bind-mounts de data/
├── docs/
│   └── AI_CODEBASE_MAP.md          # Mapa comprimido del repo para contexto AI
└── .github/workflows/
    └── deploy.yml                  # Autodeploy al VPS vía SSH
```

### Rutas públicas ≠ rutas del repo

Los volúmenes Docker exponen rutas legacy que difieren de la estructura del repo:

| Ruta pública | Origen en repo/datos |
|---|---|
| `/CRISTAL/musica/` | `data/cristal-musica/` |
| `/RELATOS/relatos/audios/` | `data/relatos-audios/` |
| `/BLOG_media/` | `data/blog-media/` |
| `/media/videos/` | `data/media-videos/` |
| `/js/model/` | `data/js-model/` |

---

## 4. Convenciones del proyecto

- **PHP directo**: páginas-controlador con HTML/CSS/JS inline donde corresponde; sin autoloader ni framework.
- **Datos en arrays PHP**: los archivos de contenido siguen el patrón `*.estructura-datos.php` y definen variables como `$blogPosts`, `$relatos`, `$libros`, o arrays de música por categoría.
- **Blog helpers**: `app/index.php` centraliza la generación de cards, extractos, imágenes, tiempo de lectura y metadatos SEO. Los cambios deben ser compatibles con los modos listing, tag y single-post.
- **Laboratorio de Apps**: el contenido es JSON (`laboratorio-apps.json`). Respetar el esquema `id/badge/name/subtitle/stage/layout/glow/icon/description/tags/meta/buttons` al añadir apps.
- **`index-juego.php`**: shell integrado del Mundo 3D; incluye CRISTAL, RELATOS y LIBROS con `include_once`. Un cambio en este archivo puede afectar múltiples secciones.
- **Routing en `.htaccess`**: toda la lógica de URLs amigables vive ahí. Los accesos directos a `.php` redirigen a sus URLs canónicas.
- **Clases CSS**: prefijo `jv-*` para componentes nuevos; nombres en español para la UI legacy del juego/media. No renombrar a gran escala sin verificar referencias en JS y CSS.
- **Texto español primero**: mantener UTF-8 con tildes y caracteres especiales. PowerShell puede mostrar mojibake aunque los archivos sean UTF-8 correcto.

---

## 5. Comandos útiles de desarrollo

```bash
# Levantar el sitio en local (requiere Docker Desktop)
docker compose up -d --build

# Ver el sitio
# http://localhost:8081

# Estado del contenedor
docker compose ps

# Logs del servidor web
docker compose logs --tail=200 web

# Parar el stack
docker compose down

# Verificar sintaxis PHP de un archivo (con PHP local)
php -l app/path/to/archivo.php

# Verificar sintaxis PHP (dentro del contenedor)
docker compose exec -T web php -l /var/www/html/path/to/archivo.php
```

> No hay comandos `npm install`, `composer install`, `phpunit` ni `vite build` en este checkout.

---

## 6. Cómo probar cambios manualmente

1. Arrancar con `docker compose up -d --build`.
2. Abrir `http://localhost:8081` en el navegador.
3. Rutas principales a verificar según el cambio:
   - Blog: `http://localhost:8081/blog/`
   - Post individual: `http://localhost:8081/blog/<slug>/`
   - Tag: `http://localhost:8081/blog/tag/<tag>/`
   - Mundo 3D: `http://localhost:8081/mundo3D/`
   - Laboratorio: `http://localhost:8081/laboratorio-de-apps/`
   - CV: `http://localhost:8081/curriculum/es/` y `/resume/en/`
4. Las secciones que requieren contenido multimedia (CRISTAL, RELATOS con audio/vídeo) no funcionarán sin los volúmenes de datos; es comportamiento esperado en local.
5. Revisar `docker compose logs --tail=50 web` si algo no carga.

---

## 7. Reglas de seguridad

- **No tocar assets compilados** (`app/assets/`, `app/.vite/manifest.json`) salvo indicación expresa del usuario.
- **No tocar multimedia pesada** (carpetas bajo `data/`, imágenes de intro en `app/intro/images/`, carátulas de libros/relatos) salvo indicación expresa.
- **No crear `composer.json`, `package.json` ni suites de tests** si no existen en el repo. No inventar infraestructura de dependencias.
- **No introducir dependencias nuevas** (librerías PHP, npm, CDN) sin justificarlo explícitamente y obtener confirmación.
- **No modificar rutas legacy de media** (las que expone Docker como `/CRISTAL/musica/`, `/BLOG_media/`, etc.) sin revisar el impacto en `docker-compose.yml`, `.htaccess` y el código PHP que las referencia.
- Ante cambios grandes (más de 3 archivos, cambios en `.htaccess`, refactors de helpers de blog), **pedir confirmación** antes de proceder.

---

## 8. Rol de Claude Code en este proyecto

- **Implementación principal**: añadir posts al blog, nuevas apps al laboratorio, ajustes de UI, nuevas secciones.
- **Refactors controlados**: únicamente los que el usuario solicite explícitamente; sin limpiezas oportunistas.
- **Documentación**: actualizar `docs/AI_CODEBASE_MAP.md` o este archivo cuando la estructura cambie significativamente.
- **Revisión antes de cambios grandes**: antes de modificar `index-juego.php`, `app/.htaccess`, helpers de blog o el schema del laboratorio, confirmar con el usuario.
- **Navegación semántica con Serena**: usar `get_symbols_overview`, `find_symbol` y `find_referencing_symbols` para explorar el código en lugar de leer archivos completos cuando sea posible.
- **Memoria de decisiones con Engram**: guardar en Engram las decisiones de arquitectura, convenciones establecidas, bugs corregidos y patrones confirmados para que persistan entre sesiones.
