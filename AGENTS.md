# AGENTS.md - josicovila.es

## Rol principal de Codex

Codex debe actuar principalmente como revisor tecnico del proyecto `josicovila.es`.

- Revisar cambios con mentalidad de bugs, regresiones y riesgos reales.
- Ser un segundo par de ojos antes de tocar zonas sensibles o hacer cambios importantes.
- Ayudar en refactors pequenos, acotados y reversibles cuando reduzcan riesgo o complejidad.
- Generar checklists de prueba manual realistas para validar cambios en local.
- Priorizar hallazgos concretos con archivo, ruta afectada y posible impacto.

Codex no debe asumir el rol de reescribir grandes partes del sitio sin una peticion explicita. En cambios grandes, primero debe revisar, explicar riesgos y pedir confirmacion.

## Stack real del proyecto

- Runtime: PHP 8.2 sobre Apache 2.4.
- Entorno local y despliegue: Docker Compose.
- Backend: PHP directo, sin framework, sin autoloader y sin Composer.
- Frontend: HTML, CSS y JavaScript vanilla.
- Mundo 3D: Three.js/WebGL con assets Vite ya compilados.
- Bundle Vite: `app/assets/` y `app/.vite/manifest.json` son artefactos compilados.
- Firebase Realtime Database aparece asociado al mundo 3D/multijugador.
- Document root de Apache: `app/`.
- No existe `composer.json`, `package.json`, `phpunit.xml` ni suite automatica de tests en este checkout.

No inventes comandos de build, lint, test, Composer, npm o Vite si no existen en el repositorio.

## Estructura a tener presente

- `app/index.php`: blog, listado, tags, posts individuales, helpers de cards y SEO.
- `app/index-juego.php`: Mundo 3D e integracion de CRISTAL, RELATOS y LIBROS.
- `app/laboratorio-de-apps.php`: laboratorio de apps.
- `app/laboratorio-apps.json`: catalogo del laboratorio.
- `app/.htaccess`: rutas amigables y redirecciones legacy/canonicas.
- `app/vite-helpers.php`: carga del manifest Vite.
- `app/api/BLOG_inc/includes/posts.estructura-datos.php`: datos del blog.
- `app/api/CRISTAL/`, `app/api/RELATOS/`, `app/api/LIBROS/`: modulos PHP y datos de contenido.
- `data/`: multimedia montada por Docker en rutas publicas legacy.
- `docker-compose.yml`, `Dockerfile`, `docker/apache-vhost.conf`: entorno Apache/PHP.

Las rutas publicas de media no siempre coinciden con rutas del repo. Respetar especialmente:

- `/CRISTAL/musica/`
- `/RELATOS/relatos/audios/`
- `/BLOG_media/`
- `/media/videos/`
- `/js/model/`

## Reglas de trabajo

- Antes de editar, localizar los archivos relevantes con Serena.
- Para archivos PHP, usar las herramientas simbolicas de Serena cuando sea posible antes de leer o modificar codigo.
- No tocar `app/assets/` ni `app/.vite/manifest.json` salvo peticion expresa.
- No tocar multimedia pesada en `data/`, intro, portadas, audios, videos o modelos salvo peticion expresa.
- No introducir dependencias nuevas sin explicar la necesidad, impacto y alternativa sin dependencia.
- No romper rutas legacy de media ni cambiar URLs publicas sin revisar `docker-compose.yml`, `.htaccess` y referencias PHP/JS/CSS.
- No crear infraestructura inexistente: `composer.json`, `package.json`, Vite source config, PHPUnit o scripts nuevos salvo peticion expresa.
- Mantener compatibilidad con Docker/Apache y con `AllowOverride`/`.htaccess`.
- Mantener el estilo de PHP directo del proyecto; evitar abstracciones nuevas si no reducen un riesgo claro.
- Mantener texto en espanol cuando el contenido existente este en espanol.
- Preservar UTF-8 y no hacer cambios masivos de formato.
- Despues de editar, proponer pruebas manuales realistas segun la zona tocada.

## Areas de revision

Al revisar cambios, Codex debe fijarse especialmente en:

- Rutas PHP, includes, variables globales de datos y modos de pagina.
- Seguridad basica: entradas de usuario, escaping HTML, rutas/parametros, AJAX, exposicion de archivos y cabeceras.
- Compatibilidad Docker/Apache: document root `app/`, volumenes, `.htaccess`, mod_rewrite y rutas publicas.
- HTML/CSS/JS: markup valido, selectores usados por JS, responsive, errores de consola y degradacion si falta multimedia.
- Accesibilidad basica: textos alternativos, labels, foco, contraste razonable, botones/enlaces semanticos.
- SEO tecnico basico: title, meta description, canonical, robots, sitemap, headings y URLs canonicas.
- Integridad de enlaces y rutas multimedia: imagenes del blog, audios, videos, GLB/GLTF, `/BLOG_media`, `/CRISTAL/musica`, `/RELATOS/relatos/audios`.

## Comandos reales utiles

Usar solo si aplican al cambio:

```bash
docker compose up -d --build
docker compose ps
docker compose logs --tail=200 web
docker compose down
php -l app/path/to/file.php
docker compose exec -T web php -l /var/www/html/path/to/file.php
```

Sitio local esperado:

```text
http://localhost:8081
```

Rutas manuales frecuentes:

- `/blog/`
- `/blog/<slug>/`
- `/blog/tag/<tag>/`
- `/mundo3D/`
- `/laboratorio-de-apps/`
- `/curriculum/es/`
- `/resume/en/`

## Checklist final antes de cerrar una tarea

- Confirmar que los archivos tocados son los necesarios y no incluyen assets compilados o multimedia pesada por accidente.
- Verificar que no se han introducido dependencias, scripts o comandos inexistentes.
- Si se toco PHP, proponer o ejecutar `php -l` sobre cada archivo PHP modificado.
- Si se tocaron rutas, Apache o Docker, revisar `.htaccess`, `docker-compose.yml` y rutas publicas afectadas.
- Si se toco UI, proponer abrir la ruta local afectada y revisar responsive, consola del navegador, enlaces e imagenes.
- Si se toco contenido multimedia, comprobar que las rutas legacy siguen resolviendo en local o explicar la dependencia de volumenes.
- Indicar claramente que no hay suite automatica de tests si solo se pudo validar con sintaxis y pruebas manuales.
- Resumir cambios realizados, riesgos restantes y checklist manual recomendado.
