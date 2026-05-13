<div align="center">

<img src="data/blog-media/media/img/logo-transparente.png" alt="JosicoVila.es" width="96" />

# JosicoVila.es

**Portfolio personal · Blog · Mundo 3D multijugador · Laboratorio de Apps**

[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net/)
[![Apache](https://img.shields.io/badge/Apache-2.4-D22128?style=flat-square&logo=apache&logoColor=white)](https://httpd.apache.org/)
[![Three.js](https://img.shields.io/badge/Three.js-r168-black?style=flat-square&logo=threedotjs&logoColor=white)](https://threejs.org/)
[![Firebase](https://img.shields.io/badge/Firebase-Realtime_DB-FFCA28?style=flat-square&logo=firebase&logoColor=black)](https://firebase.google.com/)
[![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=flat-square&logo=docker&logoColor=white)](https://www.docker.com/)
[![CI/CD](https://img.shields.io/badge/GitHub_Actions-autodeploy-2088FF?style=flat-square&logo=githubactions&logoColor=white)](https://github.com/features/actions)
[![Live](https://img.shields.io/badge/Live-josicovila.es-4CAF50?style=flat-square&logo=firefox&logoColor=white)](https://josicovila.es)

</div>

---

## ¿Qué es esto?

El código fuente completo de [josicovila.es](https://josicovila.es) — mi rincón personal en la web. Un sitio que combina un **blog de desarrollo**, un **mundo 3D multijugador** construido con Three.js, un portal de **relatos y libros**, una sala de **música instrumental** y un **laboratorio de apps** donde voy publicando mis proyectos.

Todo corre en un VPS propio con Docker, con autodeploy automático desde GitHub Actions.

---

## Secciones

| Sección | Ruta | Descripción |
|---|---|---|
| **Blog** | `/` | Artículos sobre desarrollo 3D, El pueblo de los dragones, música y relatos |
| **Mundo 3D** | `/mundo3D/` | Pueblo de los Dragones — exploración 3D multijugador con Three.js |
| **Laboratorio de Apps** | `/laboratorio-de-apps/` | Catálogo de apps propias en distintas fases de desarrollo |
| **Relatos** | `/relatos/` | Relatos con audio, vídeo y PDF |
| **Libros** | `/libros/` | Portal de libros con carrusel interactivo |
| **Cristal** | `/cristal/` | Sala de música instrumental con reproductor completo |
| **Currículum** | `/curriculum/es/` · `/resume/en/` | CV en español e inglés |

---

## Stack técnico

```
Frontend   →  PHP 8.2 (sin framework), HTML5, CSS3, JS vanilla
3D Engine  →  Three.js r168 + GLTF/GLB + WebGL
Multiplayer→  Firebase Realtime Database
Bundler    →  Vite (solo para el Mundo 3D)
Servidor   →  Apache 2.4 + mod_rewrite + mod_headers + mod_expires
Contenedor →  Docker + Docker Compose
CI/CD      →  GitHub Actions → SSH → VPS
```

---

## Estructura del repositorio

```
josicovila.es/
├── app/                        # Código fuente servido por Apache
│   ├── index.php               # Blog (listing + single post)
│   ├── index-juego.php         # Mundo 3D
│   ├── laboratorio-de-apps.php # Laboratorio de Apps
│   ├── .htaccess               # Routing con mod_rewrite
│   ├── api/                    # Endpoints PHP (blog, relatos, libros, música)
│   ├── assets/                 # Bundle compilado por Vite (3D game)
│   ├── css/                    # Estilos globales
│   └── js/                     # Scripts del blog y sidebar
├── data/                       # Contenido estático y multimedia (montado como volúmenes)
│   └── blog-media/             # Imágenes del blog (sí en repo)
│       ── cristal-musica/      # Archivos de audio (no en repo — volumen Docker)
│       ── relatos-*/           # Audios, vídeos y PDFs de relatos (no en repo)
├── docker/
│   └── apache-vhost.conf       # VirtualHost de Apache
├── Dockerfile                  # Imagen PHP 8.2 + Apache
├── docker-compose.yml          # Servicio web + volúmenes de datos
└── .github/workflows/
    └── deploy.yml              # Autodeploy al VPS vía SSH
```

> **Nota:** Las carpetas de media pesada (audios, vídeos, PDFs) no están en el repositorio. Se montan como volúmenes Docker en el servidor y se gestionan por separado.

---

## Arrancar en local

Necesitas **Docker Desktop** instalado.

```bash
# 1. Clona el repositorio
git clone https://github.com/josicovila/josicovila.es.git
cd josicovila.es

# 2. Levanta el contenedor
docker compose up -d --build

# 3. Abre en el navegador
open http://localhost:8081
```

> Las secciones que dependen de contenido multimedia (relatos con audio, música de Cristal) no funcionarán sin los volúmenes de datos. El blog, el Mundo 3D y el Laboratorio sí funcionan sin datos adicionales.

---

## Autodeploy

Cada push a `main` lanza el workflow de GitHub Actions:

```
push → main
  └─ SSH al VPS
       ├─ git pull --ff-only
       └─ DOCKER_BUILDKIT=0 docker compose up -d --build
```

Las credenciales del servidor (host, usuario, clave SSH, puerto) se configuran como **GitHub Secrets** en el repositorio — nunca están en el código.

---

## Licencia

El **código** de este repositorio está bajo licencia [MIT](LICENSE).

El **contenido** (textos del blog, relatos, imágenes propias, música) es © Josico Vila — todos los derechos reservados.
