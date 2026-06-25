This file is a merged representation of a subset of the codebase, containing files not matching ignore patterns, combined into a single document by Repomix.
The content has been processed where content has been compressed (code blocks are separated by ⋮---- delimiter).

# File Summary

## Purpose
This file contains a packed representation of a subset of the repository's contents that is considered the most important context.
It is designed to be easily consumable by AI systems for analysis, code review,
or other automated processes.

## File Format
The content is organized as follows:
1. This summary section
2. Repository information
3. Directory structure
4. Repository files (if enabled)
5. Multiple file entries, each consisting of:
  a. A header with the file path (## File: path/to/file)
  b. The full contents of the file in a code block

## Usage Guidelines
- This file should be treated as read-only. Any changes should be made to the
  original repository files, not this packed version.
- When processing this file, use the file path to distinguish
  between different files in the repository.
- Be aware that this file may contain sensitive information. Handle it with
  the same level of security as you would the original repository.

## Notes
- Some files may have been excluded based on .gitignore rules and Repomix's configuration
- Binary files are not included in this packed representation. Please refer to the Repository Structure section for a complete list of file paths, including binary files
- Files matching these patterns are excluded: node_modules/**, dist/**, build/**, .git/**, vendor/**, .serena/**, docs/AI_CODEBASE_MAP.md, app/assets/**, app/js/gltf/**, app/js/ammo/**, app/**/media/**, app/sitemap.xml, app/**/*.svg, *.png, *.jpg, *.jpeg, *.webp, *.gif, *.zip, *.pdf, *.mp3, *.wav, *.mp4, *.wasm
- Files matching patterns in .gitignore are excluded
- Files matching default ignore patterns are excluded
- Content has been compressed - code blocks are separated by ⋮---- delimiter
- Files are sorted by Git change count (files with more changes are at the bottom)

# Directory Structure
```
.dockerignore
.github/workflows/deploy.yml
.gitignore
app/.gitignore
app/.htaccess
app/.vite/manifest.json
app/api/BLOG_inc/includes/ajax.random-posts.php
app/api/BLOG_inc/includes/ajax.search.php
app/api/BLOG_inc/includes/posts.estructura-datos.php
app/api/CRISTAL/includes/ballads.estructura-datos.php
app/api/CRISTAL/includes/cinematics.estructura-datos.php
app/api/CRISTAL/includes/musica.estructura-datos.php
app/api/CRISTAL/includes/nombreCancion.php
app/api/CRISTAL/includes/nombreMp3Ballad.php
app/api/CRISTAL/includes/nombreMp3Cinematic.php
app/api/CRISTAL/includes/nombreMp3Role.php
app/api/CRISTAL/includes/nombreMp3Warlike.php
app/api/CRISTAL/includes/numeroAlbumPorNombreCancion.php
app/api/CRISTAL/includes/obtenerCaratula.php
app/api/CRISTAL/includes/roles.estructura-datos.php
app/api/CRISTAL/includes/tiraCanciones.php
app/api/CRISTAL/includes/tiraCancionesBallad.php
app/api/CRISTAL/includes/tiraCancionesCinematic.php
app/api/CRISTAL/includes/tiraCancionesRole.php
app/api/CRISTAL/includes/tiraCancionesWarlike.php
app/api/CRISTAL/includes/warlikes.estructura-datos.php
app/api/CRISTAL/index.php
app/api/LIBROS/includes/libros.estructura-datos.php
app/api/LIBROS/index.php
app/api/RELATOS/includes/ajax.relato.php
app/api/RELATOS/includes/relatos.estructura-datos.php
app/api/RELATOS/index.php
app/css/blog-styles.css
app/curri/css.png
app/curri/es.png
app/curri/foto.jpg
app/curri/gb.png
app/curri/html.png
app/curri/js.png
app/curri/php.png
app/curri/qr-josicovila.png
app/curriculum_en.html
app/curriculum_es.html
app/google008ad7e3ad497ffb.html
app/index-juego.php
app/index.php
app/intro/images/Demon.gif
app/intro/images/Dragon_Evolved.gif
app/intro/images/fondo-josico.png
app/intro/images/Goleling.gif
app/intro/images/Josico-Vila-letras.png
app/intro/images/llamada-juego.png
app/intro/images/movimiento.png
app/intro/images/Pigeon.gif
app/intro/images/senal-continua.png
app/js/blog-sidebar.js
app/laboratorio-apps.json
app/laboratorio-de-apps.php
app/LIBROS/img/burbuja.png
app/LIBROS/img/cerrar.png
app/LIBROS/img/fondo-Hansik.png
app/LIBROS/img/fondo-misDemonios.png
app/LIBROS/img/fondo-preguntasSabaticas.png
app/LIBROS/img/fondo-unManojo.png
app/LIBROS/img/galaxia.png
app/LIBROS/img/hoja.png
app/LIBROS/img/JV.png
app/LIBROS/img/logos/available-at-amazon-es-cc-vertical-clr-471x164.png
app/LIBROS/img/logos/ES_Apple_Music_Listen_on_Badge_CMYK_090120.webp
app/LIBROS/img/logos/es_badge_web_generic.png
app/LIBROS/img/logos/ndice-370x136.png
app/LIBROS/img/logos/Spotify_Logo_CMYK_Green.webp
app/LIBROS/img/logos/ytm_lp2_logo_desktop_552x71.png
app/LIBROS/img/next.png
app/LIBROS/img/pause.png
app/LIBROS/img/pista-relatos.gif
app/LIBROS/img/play-pause.png
app/LIBROS/img/play.png
app/LIBROS/img/playico.png
app/LIBROS/img/textura1.png
app/LIBROS/img/textura2.jpg
app/LIBROS/img/yo/defrente.png
app/LIBROS/img/yo/guitarra.png
app/LIBROS/img/yo/leyendo.png
app/LIBROS/img/yo/relato.png
app/LIBROS/libros/El-juego-de-Hansik-Josico-Vila.webp
app/LIBROS/libros/Mis-demonios-mis-angeles-Josico-Vila.webp
app/LIBROS/libros/Preguntas-sabaticas-Josico-Vila.webp
app/LIBROS/libros/Un-manojo-de-llaves-Josico-Vila.webp
app/politica-de-privacidad.html
app/RELATOS/img/burbuja.png
app/RELATOS/img/cerrar.png
app/RELATOS/img/fondo-Hansik.png
app/RELATOS/img/fondo-misDemonios.png
app/RELATOS/img/fondo-preguntasSabaticas.png
app/RELATOS/img/fondo-unManojo.png
app/RELATOS/img/galaxia.png
app/RELATOS/img/hoja.png
app/RELATOS/img/JV.png
app/RELATOS/img/logos/available-at-amazon-es-cc-vertical-clr-471x164.png
app/RELATOS/img/logos/ES_Apple_Music_Listen_on_Badge_CMYK_090120.webp
app/RELATOS/img/logos/es_badge_web_generic.png
app/RELATOS/img/logos/ndice-370x136.png
app/RELATOS/img/logos/Spotify_Logo_CMYK_Green.webp
app/RELATOS/img/logos/ytm_lp2_logo_desktop_552x71.png
app/RELATOS/img/next.png
app/RELATOS/img/pause.png
app/RELATOS/img/pista-relatos.gif
app/RELATOS/img/play-pause.png
app/RELATOS/img/play.png
app/RELATOS/img/playico.png
app/RELATOS/img/textura1.png
app/RELATOS/img/textura2.jpg
app/RELATOS/img/yo/defrente.png
app/RELATOS/img/yo/guitarra.png
app/RELATOS/img/yo/leyendo.png
app/RELATOS/img/yo/relato.png
app/RELATOS/relatos/portadas/0010-dos-josico-vila.webp
app/RELATOS/relatos/portadas/3-folios-josico-vila.webp
app/RELATOS/relatos/portadas/4-microrrelatos-jose-vila-villa-ceballos.webp
app/RELATOS/relatos/portadas/bruja.webp
app/RELATOS/relatos/portadas/corre-neko-josico-vila.webp
app/RELATOS/relatos/portadas/El-circo.webp
app/RELATOS/relatos/portadas/El-Explorador.webp
app/RELATOS/relatos/portadas/el-sueno-de-un-angel-josico-vilawebp.webp
app/RELATOS/relatos/portadas/la-temida-hoja-en-blanco-jose-vila-villa-ceballos.webp
app/RELATOS/relatos/portadas/micro-Su-regalo.webp
app/RELATOS/relatos/portadas/omirp-de-modrolimpa-josico-vila.webp
app/RELATOS/relatos/portadas/phibo-y-nachi-josico-vila.webp
app/RELATOS/relatos/portadas/practicamente-inutiles-josico-vila.webp
app/RELATOS/relatos/PROYECTO-PRACTICAMENTE-INUTILES.mp3
app/robots.txt
app/vite-helpers.php
docker-compose.yml
docker/apache-vhost.conf
Dockerfile
README.md
```

# Files

## File: .dockerignore
````
.git
.gitignore
docker-compose.override.yml
data/
````

## File: app/.gitignore
````
# Local dev artifacts
public/hot

# OS / editor noise
.DS_Store
Thumbs.db
desktop.ini
.idea/
.vscode/
*.log
````

## File: app/.vite/manifest.json
````json
{
  "node_modules/wavesurfer.js/dist/wavesurfer.esm.js": {
    "file": "assets/wavesurfer.esm-jFUz3WWG.js",
    "name": "wavesurfer.esm",
    "src": "node_modules/wavesurfer.js/dist/wavesurfer.esm.js",
    "isDynamicEntry": true
  },
  "src/CRISTAL/js/app.js": {
    "file": "assets/app-Diiq_LMy.js",
    "name": "app",
    "src": "src/CRISTAL/js/app.js",
    "isDynamicEntry": true,
    "imports": [
      "src/main.js"
    ]
  },
  "src/LIBROS/js/carruselLibros.js": {
    "file": "assets/carruselLibros-BCttP92M.js",
    "name": "carruselLibros",
    "src": "src/LIBROS/js/carruselLibros.js",
    "isDynamicEntry": true
  },
  "src/RELATOS/js/carrusel.js": {
    "file": "assets/carrusel-BGSmweJR.js",
    "name": "carrusel",
    "src": "src/RELATOS/js/carrusel.js",
    "isDynamicEntry": true
  },
  "src/RELATOS/js/relato.js": {
    "file": "assets/relato-Bl2ND086.js",
    "name": "relato",
    "src": "src/RELATOS/js/relato.js",
    "isDynamicEntry": true
  },
  "src/main.js": {
    "file": "assets/main-Bf2LDCjT.js",
    "name": "main",
    "src": "src/main.js",
    "isEntry": true,
    "dynamicImports": [
      "src/CRISTAL/js/app.js",
      "node_modules/wavesurfer.js/dist/wavesurfer.esm.js",
      "src/RELATOS/js/relato.js",
      "src/RELATOS/js/carrusel.js",
      "src/LIBROS/js/carruselLibros.js"
    ],
    "css": [
      "assets/main-DS78lYau.css"
    ]
  },
  "src/styles.css": {
    "file": "assets/main-DS78lYau.css",
    "src": "src/main.js",
    "isEntry": true
  }
}
````

## File: app/api/CRISTAL/includes/ballads.estructura-datos.php
````php
//ESTRUCTURA DE DATOS
//$ballads[0]['canciones'][args]
⋮----
] // cierra canciones ballads
````

## File: app/api/CRISTAL/includes/cinematics.estructura-datos.php
````php
//ESTRUCTURA DE DATOS
//$ballads[0]['canciones'][args]
⋮----
] // cierra canciones cinematics
````

## File: app/api/CRISTAL/includes/musica.estructura-datos.php
````php
//ESTRUCTURA DE DATOS
//Discos > [nombre, nombrejs, imagen, video, texto, canciones[]]
//Canciones > [nombre, nombrejs, texto]
⋮----
] // cierra canciones
], //Cierra Black & White
⋮----
], //Cierra Once Upon a Tale pt 2
⋮----
], //Cierra el disco Once upon a tale Pt.1
⋮----
], //Cierra el disco I just cant say Farewell
⋮----
], //Cierra el disco Feel, Believe, Live
⋮----
], //Cierra el disco 9
⋮----
], //Cierra el disco Experimenting on her own
⋮----
], //Cierra el disco The pathmaker
⋮----
], //Cierra el disco In love or versus
⋮----
], //Cierra el disco Dawn in Istoccar
⋮----
], //Cierra el disco Never without The Bards
⋮----
], //Cierra el disco Night clockwork
⋮----
], //Cierra el disco Reunion's tavern
⋮----
], //Cierra el disco New old world order
];//Cierra disco
````

## File: app/api/CRISTAL/includes/nombreCancion.php
````php

````

## File: app/api/CRISTAL/includes/nombreMp3Ballad.php
````php

````

## File: app/api/CRISTAL/includes/nombreMp3Cinematic.php
````php

````

## File: app/api/CRISTAL/includes/nombreMp3Role.php
````php

````

## File: app/api/CRISTAL/includes/nombreMp3Warlike.php
````php

````

## File: app/api/CRISTAL/includes/numeroAlbumPorNombreCancion.php
````php

````

## File: app/api/CRISTAL/includes/obtenerCaratula.php
````php

````

## File: app/api/CRISTAL/includes/roles.estructura-datos.php
````php
//ESTRUCTURA DE DATOS
//$roles[0]['canciones'][args]
⋮----
] // cierra canciones roles
````

## File: app/api/CRISTAL/includes/tiraCanciones.php
````php

````

## File: app/api/CRISTAL/includes/tiraCancionesBallad.php
````php

````

## File: app/api/CRISTAL/includes/tiraCancionesCinematic.php
````php

````

## File: app/api/CRISTAL/includes/tiraCancionesRole.php
````php

````

## File: app/api/CRISTAL/includes/tiraCancionesWarlike.php
````php

````

## File: app/api/CRISTAL/includes/warlikes.estructura-datos.php
````php
//ESTRUCTURA DE DATOS
//$ballads[0]['canciones'][args]
⋮----
] // cierra canciones ballads
````

## File: app/api/CRISTAL/index.php
````php

````

## File: app/api/LIBROS/includes/libros.estructura-datos.php
````php

````

## File: app/api/RELATOS/includes/relatos.estructura-datos.php
````php

````

## File: app/curriculum_en.html
````html
<!DOCTYPE html>
<html lang="en"> <!-- TRANSLATE lang attribute -->
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Resume - José Vila</title> <!-- TRANSLATE title -->
  <style>
    body {
      margin: 0;
      font-family: 'Fira Code', monospace;
      background-color: #1e1e1e;
      color: #d4d4d4;
      display: grid;
      grid-template-columns: 2.5rem auto;
    }
    .line-numbers {
      background-color: #2d2d2d;
      color: #858585;
      padding: 1rem 0;
      user-select: none;
      text-align: center;
    }
    .line-numbers div {
      line-height: 1.6rem;
    }
    .content {
      padding: 1rem;
      position: relative; /* For absolute positioning of language switcher */
      line-height: 1.6rem;
    }
    .section {
      margin-bottom: 2rem;
    }
    h1, .content h2 {
      color: #4fc3f7;
    }
    h1 {
      font-size: 2rem;
      margin: 0;
    }
    .content h2 {
      font-size: 1.6rem;
      margin-top: 0;
      margin-bottom: 1rem;
    }
    .subtitle {
      font-size: 1.2rem;
      color: #9cdcfe;
    }
    .photo-qr {
      display: flex;
      gap: 0.5rem;
      align-items: center;
      margin-top: 1rem;
    }
    .photo-qr img {
      border-radius: 0.5rem;
      max-width: 150px;
      height: auto;
    }
    .contact p {
      margin: 0.3rem 0;
    }
    .content a {
      color: #dcdcaa;
      text-decoration: none;
    }
    .content a:hover {
      text-decoration: underline;
    }
    .experience-entry {
      margin-bottom: 1rem;
    }
    .experience-entry span:first-child { /* Date/Company line */
      display: block;
      color: #c586c0;
      margin-bottom: 0.25rem;
    }

    /* Language Switcher Styles */
    .language-switcher {
      position: absolute;
      top: 1rem;
      right: 1rem;
      z-index: 10;
    }
    .language-switcher a img, .language-switcher span img {
      width: 28px;
      height: 20px;
      vertical-align: middle;
      border: 1px solid #3f3f3f;
      border-radius: 3px;
    }
    .language-switcher a {
      margin-left: 0.5rem;
      display: inline-block;
    }
    .language-switcher span.current-lang {
      margin-left: 0.5rem;
      display: inline-block;
    }
    .language-switcher .current-lang img {
      border: 1px solid #4fc3f7;
    }

    /* Intro Paragraph */
    .intro-paragraph {
      margin-top: 1rem;
      color: #ce9178;
      max-width: 700px;
    }

    /* Skills and Languages Section */
    .skills-languages-container {
      display: flex;
      gap: 1rem; /* Spacing between columns and separator */
      align-items: flex-start;
      margin-bottom: 2rem; /* Consistent with .section */
    }
    .skills-column, .languages-column {
      flex: 1;
    }
    .skill-item {
      display: flex;
      align-items: center;
      margin-bottom: 0.5rem;
    }
    .skill-icon {
      width: 20px;
      height: 20px;
      margin-right: 0.5rem;
      flex-shrink: 0;
    }
    .skill-name {
      width: 80px;
      margin-right: 0.5rem;
      flex-shrink: 0;
    }
    .skill-bar-container {
      background-color: #444;
      flex-grow: 1;
      height: 10px;
      border-radius: 5px;
      overflow: hidden;
    }
    .skill-bar-value {
      height: 100%;
      background-color: #4fc3f7;
    }
    .vertical-separator {
      width: 1px;
      background-color: #555;
      align-self: stretch;
    }

    /* Media Query Adjustments */
    @media (max-width: 768px) {
      .skills-languages-container {
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
      }
      .skills-column, .languages-column {
        width: 90%;
        max-width: 500px;
      }
      .vertical-separator {
        display: none;
      }
      .photo-qr {
        flex-direction: column;
        align-items: center;
      }
      .photo-qr img {
        max-width: 70%; /* Adjust as needed */
      }
    }
  </style>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code&display=swap" rel="stylesheet">
</head>
<body>
  <div class="line-numbers">
    <div>01</div><div>02</div><div>03</div><div>04</div><div>05</div>
    <div>06</div><div>07</div><div>08</div><div>09</div><div>10</div>
    <div>11</div><div>12</div><div>13</div><div>14</div><div>15</div>
    <div>16</div><div>17</div><div>18</div><div>19</div><div>20</div>
    <div>21</div><div>22</div><div>23</div><div>24</div><div>25</div>
    <div>26</div><div>27</div><div>28</div><div>29</div><div>30</div>
    <div>31</div><div>32</div><div>33</div><div>34</div><div>35</div>
    <div>36</div><div>37</div><div>38</div><div>39</div><div>40</div>
    <div>41</div><div>42</div><div>43</div><div>44</div><div>45</div>
    <div>46</div><div>47</div><div>48</div><div>49</div><div>50</div>
    <div>51</div><div>52</div><div>53</div><div>54</div><div>55</div>
    <div>56</div><div>57</div><div>58</div><div>59</div><div>60</div>
    <div>61</div><div>62</div><div>63</div><div>64</div><div>65</div>
  </div>
  <div class="content">
    <div class="language-switcher">
      <a href="/curriculum/es/"><img src="/curri/es.png" alt="Español"></a>
      <span class="current-lang"><img src="/curri/gb.png" alt="English"></span>
    </div>

    <div class="section">
      <h1>José Vila</h1> <!-- TRANSLATE Name if needed, usually not -->
      <p class="intro-paragraph">
        <!-- TRANSLATE -->
        Full Stack Web Developer with experience in creating modern web applications and designing intuitive interfaces. Ability to work in both frontend and backend, with special attention to user experience and performance. Versatile, self-taught, and with solid knowledge in JavaScript, PHP, and 3D web technologies.
      </p>
      <div class="photo-qr">
        <img src="/curri/foto.jpg" alt="Photo of José Vila"> <!-- TRANSLATE alt text -->
        <img src="/curri/qr-josicovila.png" alt="QR to José Vila's Resume"> <!-- TRANSLATE alt text -->
      </div>
    </div>

    <div class="section contact">
      <h2>Contact</h2> <!-- TRANSLATE -->
      <p><strong>📞 Phone:</strong> 615382789</p> <!-- TRANSLATE "Teléfono" -->
      <p><strong>📧 Email:</strong> <a href="mailto:info@josicovila.es">info@josicovila.es</a></p>
      <p><strong>🌐 Web:</strong> <a href="https://josicovila.es">https://josicovila.es</a></p>
      <p><strong>🔗 LinkedIn:</strong> <a href="https://linkedin.com/in/josico-vila/">linkedin.com/in/josico-vila</a></p>
    </div>

    <div class="section">
      <h2>Experience</h2> <!-- TRANSLATE -->
      <div class="experience-entry">
        <span>2024 – Visual Technologies</span>
        <!-- TRANSLATE -->
        Development and design of the Inspector application and corporate web pages.<br>
        <a href="https://visualtechnologies.eu">visualtechnologies.eu</a><br>
        <a href="https://appinspector.es">appinspector.es</a><br>
        <a href="https://demo.appinspector.es">demo.appinspector.es</a>
      </div>
      <div class="experience-entry">
        <span>2023 – Camping La Estanca</span>
        <!-- TRANSLATE -->
        Receptionist (Spanish and English).
      </div>
      <div class="experience-entry">
        <span>2015–2022 – ASAPME Bajo Aragón</span>
        <!-- TRANSLATE -->
        Receptionist at the Day Center.
      </div>
      <div class="experience-entry">
        <span>2003–2008 – GNA Serveis Telematics</span>
        <!-- TRANSLATE -->
        Website programmer and SEO.
      </div>
    </div>

    <div class="section">
      <h2>Academic Background</h2> <!-- TRANSLATE -->
      <div class="experience-entry">
        <span>University of Girona and UNED Girona (unfinished course)</span> <!-- TRANSLATE -->
        <!-- TRANSLATE -->
        Technical Engineering in Management Computing – Studies initiated and partially completed<br>
        before starting my professional career.
      </div>
    </div>

    <div class="skills-languages-container section">
      <div class="skills-column">
        <h2>Programming Languages</h2> <!-- TRANSLATE -->
        <div class="skill-item">
          <img src="/curri/html.png" alt="HTML" class="skill-icon">
          <span class="skill-name">HTML</span>
          <div class="skill-bar-container">
            <div class="skill-bar-value" style="width: 100%;"></div>
          </div>
        </div>
        <div class="skill-item">
          <img src="/curri/css.png" alt="CSS" class="skill-icon">
          <span class="skill-name">CSS</span>
          <div class="skill-bar-container">
            <div class="skill-bar-value" style="width: 100%;"></div>
          </div>
        </div>
        <div class="skill-item">
          <img src="/curri/js.png" alt="JavaScript" class="skill-icon">
          <span class="skill-name">JS</span>
          <div class="skill-bar-container">
            <div class="skill-bar-value" style="width: 95%;"></div>
          </div>
        </div>
        <div class="skill-item">
          <img src="/curri/php.png" alt="PHP" class="skill-icon">
          <span class="skill-name">PHP</span>
          <div class="skill-bar-container">
            <div class="skill-bar-value" style="width: 80%;"></div>
          </div>
        </div>
      </div>
      <div class="vertical-separator"></div>
      <div class="languages-column">
        <h2>Languages</h2> <!-- TRANSLATE -->
        <p><strong>Spanish:</strong> Native (100%)</p> <!-- TRANSLATE -->
        <p><strong>English:</strong> Upper-intermediate (80%)</p> <!-- TRANSLATE -->
      </div>
    </div>

    <div class="section">
      <h2>Personal Projects</h2> <!-- TRANSLATE -->
      <p style="max-width: 800px;">
        <!-- TRANSLATE -->
        While I have been unemployed, I have continued my training through short courses or self-study. In addition, I have developed personal projects:
        <a href="https://josicovila.es">josicovila.es</a> and <a href="https://josicovila.com">josicovila.com</a>.
        I believe that every good project needs good motivation, and for these, I have followed the principle of "Everything for and by my nephews and nieces."
        In them, they have discovered my creative projects that I started in 2018: instrumental music composed with a computer (video games and cinema, 15 published albums),
        short stories (15), and published books (4).
      </p>
    </div>
  </div>
</body>
</html>
````

## File: app/curriculum_es.html
````html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CV - José Vila</title>
  <style>
    body {
      margin: 0;
      font-family: 'Fira Code', monospace;
      background-color: #1e1e1e;
      color: #d4d4d4;
      display: grid;
      grid-template-columns: 2.5rem auto;
    }
    .line-numbers {
      background-color: #2d2d2d;
      color: #858585;
      padding: 1rem 0;
      user-select: none;
      text-align: center;
    }
    .line-numbers div {
      line-height: 1.6rem;
    }
    .content {
      padding: 1rem;
      position: relative; /* For absolute positioning of language switcher */
      line-height: 1.6rem;
    }
    .section {
      margin-bottom: 2rem;
    }
    h1, .content h2 {
      color: #4fc3f7;
    }
    h1 {
      font-size: 2rem;
      margin: 0;
    }
    .content h2 {
      font-size: 1.6rem;
      margin-top: 0;
      margin-bottom: 1rem;
    }
    .subtitle {
      font-size: 1.2rem;
      color: #9cdcfe;
    }
    .photo-qr {
      display: flex;
      gap: 0.5rem;
      align-items: center;
      margin-top: 1rem;
    }
    .photo-qr img {
      border-radius: 0.5rem;
      max-width: 150px;
      height: auto;
    }
    .contact p {
      margin: 0.3rem 0;
    }
    .content a {
      color: #dcdcaa;
      text-decoration: none;
    }
    .content a:hover {
      text-decoration: underline;
    }
    .experience-entry {
      margin-bottom: 1rem;
    }
    .experience-entry span:first-child { /* Date/Company line */
      display: block;
      color: #c586c0;
      margin-bottom: 0.25rem;
    }

    /* Language Switcher Styles */
    .language-switcher {
      position: absolute;
      top: 1rem;
      right: 1rem;
      z-index: 10;
    }
    .language-switcher a img, .language-switcher span img {
      width: 28px;
      height: 20px;
      vertical-align: middle;
      border: 1px solid #3f3f3f;
      border-radius: 3px;
    }
    .language-switcher a {
      margin-left: 0.5rem;
      display: inline-block;
    }
    .language-switcher span.current-lang {
      margin-left: 0.5rem;
      display: inline-block;
    }
    .language-switcher .current-lang img {
      border: 1px solid #4fc3f7;
    }

    /* Intro Paragraph */
    .intro-paragraph {
      margin-top: 1rem;
      color: #ce9178;
      max-width: 700px;
    }

    /* Skills and Languages Section */
    .skills-languages-container {
      display: flex;
      gap: 1rem; /* Spacing between columns and separator */
      align-items: flex-start;
      margin-bottom: 2rem; /* Consistent with .section */
    }
    .skills-column, .languages-column {
      flex: 1;
    }
    .skill-item {
      display: flex;
      align-items: center;
      margin-bottom: 0.5rem;
    }
    .skill-icon {
      width: 20px;
      height: 20px;
      margin-right: 0.5rem;
      flex-shrink: 0;
    }
    .skill-name {
      width: 80px;
      margin-right: 0.5rem;
      flex-shrink: 0;
    }
    .skill-bar-container {
      background-color: #444;
      flex-grow: 1;
      height: 10px;
      border-radius: 5px;
      overflow: hidden;
    }
    .skill-bar-value {
      height: 100%;
      background-color: #4fc3f7;
    }
    .vertical-separator {
      width: 1px;
      background-color: #555;
      align-self: stretch;
    }

    /* Media Query Adjustments */
    @media (max-width: 768px) {
      .skills-languages-container {
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
      }
      .skills-column, .languages-column {
        width: 90%;
        max-width: 500px;
      }
      .vertical-separator {
        display: none;
      }
      .photo-qr {
        flex-direction: column;
        align-items: center;
      }
      .photo-qr img {
        max-width: 70%; /* Adjust as needed */
      }
    }
  </style>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code&display=swap" rel="stylesheet">
</head>
<body>
  <div class="line-numbers">
    <div>01</div><div>02</div><div>03</div><div>04</div><div>05</div>
    <div>06</div><div>07</div><div>08</div><div>09</div><div>10</div>
    <div>11</div><div>12</div><div>13</div><div>14</div><div>15</div>
    <div>16</div><div>17</div><div>18</div><div>19</div><div>20</div>
    <div>21</div><div>22</div><div>23</div><div>24</div><div>25</div>
    <div>26</div><div>27</div><div>28</div><div>29</div><div>30</div>
    <div>31</div><div>32</div><div>33</div><div>34</div><div>35</div>
    <div>36</div><div>37</div><div>38</div><div>39</div><div>40</div>
    <div>41</div><div>42</div><div>43</div><div>44</div><div>45</div>
    <div>46</div><div>47</div><div>48</div><div>49</div><div>50</div>
    <div>51</div><div>52</div><div>53</div><div>54</div><div>55</div>
    <div>56</div><div>57</div><div>58</div><div>59</div><div>60</div>
    <div>61</div><div>62</div><div>63</div><div>64</div><div>65</div>
  </div>
  <div class="content">
    <div class="language-switcher">
      <span class="current-lang"><img src="/curri/es.png" alt="Español"></span>
      <a href="/resume/en/"><img src="/curri/gb.png" alt="English"></a>
    </div>

    <div class="section">
      <h1>José Vila</h1>
      <p class="intro-paragraph">
        Desarrollador Web Full Stack con experiencia en creación de aplicaciones web modernas y diseño de interfaces intuitivas. Capacidad para trabajar tanto en frontend como backend, con especial atención a la experiencia de usuario y el rendimiento. Versátil, autodidacta y con sólidos conocimientos en JavaScript, PHP y tecnologías 3D para la web.
      </p>
      <div class="photo-qr">
        <img src="/curri/foto.jpg" alt="Foto de José Vila">
        <img src="/curri/qr-josicovila.png" alt="QR a Currículum de José Vila">
      </div>
    </div>

    <div class="section contact">
      <h2>Contacto</h2>
      <p><strong>📞 Teléfono:</strong> 615382789</p>
      <p><strong>📧 Email:</strong> <a href="mailto:info@josicovila.es">info@josicovila.es</a></p>
      <p><strong>🌐 Web:</strong> <a href="https://josicovila.es">https://josicovila.es</a></p>
      <p><strong>🔗 LinkedIn:</strong> <a href="https://linkedin.com/in/josico-vila/">linkedin.com/in/josico-vila</a></p>
    </div>

    <div class="section">
      <h2>Experiencia</h2>
      <div class="experience-entry">
        <span>2024 – Visual Technologies</span>
        Desarrollo y diseño de la aplicación Inspector y las páginas web corporativas.<br>
        <a href="https://visualtechnologies.eu">visualtechnologies.eu</a><br>
        <a href="https://appinspector.es">appinspector.es</a><br>
        <a href="https://demo.appinspector.es">demo.appinspector.es</a>
      </div>
      <div class="experience-entry">
        <span>2023 – Camping La Estanca</span>
        Recepcionista (Español e Inglés).
      </div>
      <div class="experience-entry">
        <span>2015–2022 – ASAPME Bajo Aragón</span>
        Recepcionista en el Centro de Día.
      </div>
      <div class="experience-entry">
        <span>2003–2008 – GNA Serveis Telematics</span>
        Programador de sitios web y SEO.
      </div>
    </div>

    <div class="section">
      <h2>Formación Académica</h2>
      <div class="experience-entry">
        <span>Universidad de Gerona y UNED Gerona (en curso inconcluso)</span>
        Ingeniería Técnica en Informática de Gestión – Estudios iniciados y parcialmente completados<br>
        antes de comenzar mi carrera profesional.
      </div>
    </div>

    <div class="skills-languages-container section">
      <div class="skills-column">
        <h2>Lenguajes de Programación</h2>
        <div class="skill-item">
          <img src="/curri/html.png" alt="HTML" class="skill-icon">
          <span class="skill-name">HTML</span>
          <div class="skill-bar-container">
            <div class="skill-bar-value" style="width: 100%;"></div>
          </div>
        </div>
        <div class="skill-item">
          <img src="/curri/css.png" alt="CSS" class="skill-icon">
          <span class="skill-name">CSS</span>
          <div class="skill-bar-container">
            <div class="skill-bar-value" style="width: 100%;"></div>
          </div>
        </div>
        <div class="skill-item">
          <img src="/curri/js.png" alt="JavaScript" class="skill-icon">
          <span class="skill-name">JS</span>
          <div class="skill-bar-container">
            <div class="skill-bar-value" style="width: 95%;"></div>
          </div>
        </div>
        <div class="skill-item">
          <img src="/curri/php.png" alt="PHP" class="skill-icon">
          <span class="skill-name">PHP</span>
          <div class="skill-bar-container">
            <div class="skill-bar-value" style="width: 80%;"></div>
          </div>
        </div>
      </div>
      <div class="vertical-separator"></div>
      <div class="languages-column">
        <h2>Idiomas</h2>
        <p><strong>Español:</strong> Nativo (100%)</p>
        <p><strong>Inglés:</strong> Nivel intermedio alto (80%)</p>
      </div>
    </div>

    <div class="section">
      <h2>Proyectos Personales</h2>
      <p style="max-width: 800px;">
        Mientras he estado desocupado he seguido formándome a través de cursillos o de forma autodidacta. Además, he desarrollado los proyectos personales:
        <a href="https://josicovila.es">josicovila.es</a> y <a href="https://josicovila.com">josicovila.com</a>.
        Creo que todo buen proyecto necesita una buena motivación, y para estos he seguido el principio de "Todo por y para mis sobrinos".
        En ellos han descubierto mis proyectos creativos que empecé en 2018: música instrumental compuesta con ordenador (videojuegos y cine, 15 discos publicados),
        relatos cortos (15) y libros publicados (4).
      </p>
    </div>
  </div>
</body>
</html>
````

## File: app/google008ad7e3ad497ffb.html
````html
google-site-verification: google008ad7e3ad497ffb.html
````

## File: app/politica-de-privacidad.html
````html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad y Cookies - JosicoVila.es</title>
    <link rel="icon" type="image/png" href="/media/img/logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 30px;
            border-radius: 8px;
        }
        .header-inner-container { /* Nueva clase para el contenido del header */
            width: 80%;
            margin: 0 auto; /* Centra el contenedor */
            padding: 0; /* El header ya tiene su propio padding vertical */
            /* No se define background-color aquí, para que use el del header */
        }
        header {
            background: #333;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
            border-bottom: #14a7d0 3px solid;
        }
        header h1 {
            margin: 0;
            padding: 0;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
        }
        nav a:hover {
            background-color: #14a7d0;
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        p {
            margin-bottom: 1em;
        }
        a {
            color: #14a7d0;
        }
        a:hover {
            text-decoration: underline;
        }
        .footer {
            text-align: center;
            padding: 20px;
            margin-top: 20px;
            color: #777;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-inner-container">
            <h1>Política de Privacidad y Uso de Cookies de JosicoVila.es</h1>
            <nav>
                <a href="/">Volver al Blog</a>
                <a href="/mundo3D/">Ir al Mundo 3D</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <p><strong>Última actualización:</strong> [08 de Mayo de 2025]</p>

        <h2>1. Introducción</h2>
        <p>Bienvenido a JosicoVila.es (en adelante, "el Sitio Web"). Tu privacidad es muy importante para nosotros. Esta política de privacidad explica cómo recopilamos, usamos, compartimos y protegemos tu información personal cuando visitas nuestro sitio web, incluyendo el blog y el juego 3D.</p>

        <h2>2. ¿Qué son las cookies?</h2>
        <p>Las cookies son pequeños archivos de texto que los sitios web colocan en tu dispositivo (ordenador, tableta, móvil) mientras navegas por ellos. Se utilizan ampliamente para que los sitios web funcionen, o funcionen de manera más eficiente, así como para proporcionar información a los propietarios del sitio.</p>

        <h2>3. ¿Cómo utilizamos las cookies?</h2>
        <p>En JosicoVila.es utilizamos cookies para los siguientes propósitos:</p>
        <ul>
            <li><strong>Cookies Analíticas (Google Analytics):</strong> Utilizamos Google Analytics para recopilar información sobre cómo los visitantes usan nuestro Sitio Web. Esta información nos ayuda a entender el tráfico del sitio, las páginas más visitadas, el tiempo de permanencia, y otros datos estadísticos que nos permiten mejorar la experiencia del usuario y el contenido del sitio. Google Analytics recopila información de forma anónima, incluyendo el número de visitantes al sitio, de dónde han llegado los visitantes y las páginas que visitaron. Para más información sobre las cookies de Google Analytics, visita: <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Política de Privacidad de Google</a> y <a href="https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage" target="_blank" rel="noopener noreferrer">Uso de cookies por Google Analytics</a>.</li>
            <li><strong>Cookies de Consentimiento:</strong> Utilizamos una cookie (a través de la herramienta CookieConsent by Osano) para recordar tus preferencias de consentimiento de cookies. Esto asegura que no te preguntemos repetidamente sobre tus preferencias en cada visita una vez que las hayas establecido.</li>
        </ul>
        <p>No utilizamos cookies para recopilar información personal identificable sin tu consentimiento explícito.</p>

        <h2>4. Tu consentimiento</h2>
        <p>Al visitar nuestro Sitio Web por primera vez, se te presentará un banner de cookies solicitando tu consentimiento para el uso de cookies analíticas. Puedes aceptar o rechazar el uso de estas cookies. Si aceptas, Google Analytics se activará. Si rechazas, o si no interactúas con el banner y lo cierras, las cookies analíticas no se cargarán.</p>
        <p>Puedes cambiar tus preferencias de cookies en cualquier momento. La mayoría de los navegadores web permiten cierto control de la mayoría de las cookies a través de la configuración del navegador. Para obtener más información sobre las cookies, incluido cómo ver qué cookies se han configurado y cómo administrarlas y eliminarlas, visita <a href="https://www.aboutcookies.org" target="_blank" rel="noopener noreferrer">www.aboutcookies.org</a> o <a href="https://www.allaboutcookies.org" target="_blank" rel="noopener noreferrer">www.allaboutcookies.org</a>.</p>
        <p>Para optar por no ser rastreado por Google Analytics en todos los sitios web, visita <a href="http://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">http://tools.google.com/dlpage/gaoptout</a>.</p>

        <h2>5. Cookies de Terceros</h2>
        <p>Además de nuestras propias cookies, también podemos utilizar varias cookies de terceros (como las de Google Analytics mencionadas anteriormente) para informar estadísticas de uso del Sitio Web.</p>

        <h2>6. Tus Derechos</h2>
        <p>Como usuario, tienes ciertos derechos con respecto a tus datos personales, especialmente si te encuentras en la Unión Europea (bajo el GDPR). Estos pueden incluir el derecho a acceder, rectificar, borrar, restringir el procesamiento, oponerse al procesamiento, así como el derecho a la portabilidad de los datos. Si deseas ejercer alguno de estos derechos, por favor contáctanos.</p>

        <h2>7. Cambios en nuestra Política de Privacidad</h2>
        <p>Podemos actualizar nuestra Política de Privacidad de vez en cuando. Te notificaremos cualquier cambio publicando la nueva Política de Privacidad en esta página. Se te aconseja revisar esta Política de Privacidad periódicamente para cualquier cambio. Los cambios a esta Política de Privacidad son efectivos cuando se publican en esta página.</p>

        <h2>8. Contacto</h2>
        <p>Si tienes alguna pregunta sobre esta Política de Privacidad, por favor contáctanos en:</p>
        <p>[info@josivovila.es] <!-- ¡¡¡REEMPLAZA ESTO!!! --></p>
    </div>

    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> JosicoVila.es - Todos los derechos reservados.</p>
    </div>

</body>
</html>
````

## File: app/robots.txt
````
Sitemap: https://josicovila.es/sitemap.xml
````

## File: app/vite-helpers.php
````php
// Define si estás en modo desarrollo (ej. basado en una variable de entorno o un archivo)
// Usaremos la existencia del archivo 'hot' como indicador principal.
⋮----
// --- Configuración ---
// Cambia estas rutas si tu estructura es diferente
⋮----
// Ruta absoluta a la carpeta 'public' donde Vite podría colocar el archivo 'hot'.
// Esta carpeta (ej. 'public') suele estar en la raíz de tu proyecto Vite.
⋮----
// Ruta absoluta al archivo 'hot' generado por Vite en desarrollo
⋮----
// Ruta absoluta al directorio de build de Vite (donde Vite genera los archivos para producción).
// Usualmente es una carpeta 'dist' en la raíz de tu proyecto Vite.
⋮----
// Ruta web relativa al directorio de build (para las URLs en HTML)
// Si tu proyecto está en la raíz del servidor web (ej. http://localhost/), y 'dist' está en 'josicodist/dist',
// entonces '/dist/' es correcto si 'josicodist' es la raíz del documento.
// Si accedes a tu proyecto como http://localhost/josicodist/, entonces BUILD_URI debería ser '/josicodist/dist/' o simplemente '/dist/' si el servidor está configurado adecuadamente.
// Dado que tus otros assets en index-juego.php usan rutas como '/media/img/logo.png', '/dist/' es probablemente correcto.
⋮----
// Ruta absoluta al manifest generado por Vite en producción.
// Vite >= 3.0.0 por defecto guarda el manifest en '.vite/manifest.json' dentro del directorio de build.
⋮----
// --- Fin Configuración ---
⋮----
$_manifestData = null; // Cache para el manifest decodificado
⋮----
/**
 * Obtiene la URL base del servidor de desarrollo Vite desde el archivo 'hot'.
 *
 * @return string|null La URL base o null si el archivo no existe/está vacío.
 */
function getViteDevServerBaseUrl(): ?string {
⋮----
// Asegúrate de que la URL tenga un esquema (http/https)
⋮----
// Asegúrate de que la URL termine con una barra
⋮----
/**
 * Lee y decodifica el manifest.json de Vite.
 * Cachea el resultado para evitar lecturas repetidas.
 *
 * @return array|null El array del manifest o null si no se encuentra/decodifica.
 */
function getManifest(): ?array {
⋮----
error_log('Error decoding Vite manifest: ' . $e->getMessage());
⋮----
/**
 * Genera las etiquetas HTML <script> y <link> para un punto de entrada de Vite.
 *
 * @param string $entryPoint El punto de entrada relativo al root del proyecto (ej: 'resources/js/app.js').
 * @return string Las etiquetas HTML generadas.
 */
function vite(string $entryPoint): string {
⋮----
// --- Modo Desarrollo ---
// Incluye el cliente Vite para HMR y conexión WebSocket
⋮----
// Incluye el punto de entrada directamente desde el servidor de desarrollo
⋮----
// --- Modo Producción ---
⋮----
// Error: Manifest no encontrado o inválido
// Podrías lanzar una excepción o mostrar un mensaje de error más visible
⋮----
// Incluir CSS asociado al punto de entrada
⋮----
// Incluir archivo JS principal del punto de entrada
⋮----
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
````

## File: docker-compose.yml
````yaml
services:
  web:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: josicovila-es-web
    ports:
      - "8081:80"
    volumes:
      - ./app:/var/www/html
      - ./data/cristal-musica:/var/www/html/CRISTAL/musica
      - ./data/relatos-audios:/var/www/html/RELATOS/relatos/audios
      - ./data/relatos-videos:/var/www/html/RELATOS/relatos/videos
      - ./data/relatos-pdf:/var/www/html/RELATOS/relatos/pdf
      - ./data/blog-media:/var/www/html/BLOG_media
      - ./data/media-videos:/var/www/html/media/videos
      - ./data/media-sounds:/var/www/html/media/sounds
      - ./data/intro-video:/var/www/html/intro/video
      - ./data/intro-mp3:/var/www/html/intro/mp3
      - ./data/js-model:/var/www/html/js/model
    restart: unless-stopped
````

## File: docker/apache-vhost.conf
````ini
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html

    <Directory /var/www/html>
        AllowOverride All
        Require all granted
        Options FollowSymLinks
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
````

## File: Dockerfile
````dockerfile
FROM php:8.2-apache

RUN a2enmod rewrite headers expires

COPY docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
COPY app/ /var/www/html/

WORKDIR /var/www/html
````

## File: README.md
````markdown
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
````

## File: .github/workflows/deploy.yml
````yaml
name: Deploy josicovila.es

on:
  push:
    branches:
      - main
      - master
  workflow_dispatch:

jobs:
  deploy:
    runs-on: ubuntu-latest

    steps:
      - name: Deploy to VPS over SSH
        uses: appleboy/ssh-action@v1.2.0
        with:
          host: ${{ secrets.VPS_HOST }}
          username: ${{ secrets.VPS_USER }}
          key: ${{ secrets.VPS_SSH_KEY }}
          port: ${{ secrets.VPS_PORT || '22' }}
          script: |
            set -e
            cd /opt/containers/josicovila-es/repo
            git fetch origin
            git checkout ${{ github.ref_name }}
            git pull --ff-only origin ${{ github.ref_name }}
            cd /opt/containers/josicovila-es
            DOCKER_BUILDKIT=0 docker compose up -d --build
````

## File: app/api/BLOG_inc/includes/ajax.random-posts.php
````php
// Función para generar un extracto
function generar_extracto_ajax($htmlContent, $maxLength = 155) {
⋮----
// Función para extraer la primera imagen URL del contenido HTML
function extraer_primera_imagen_ajax($htmlContent) {
⋮----
$doc->loadHTML('<?xml encoding="utf-8" ?>' . $htmlContent);
⋮----
$imgTags = $doc->getElementsByTagName('img');
⋮----
return $imgTags->item(0)->getAttribute('src');
⋮----
shuffle($blogPosts); // Aleatorizar el array de posts
⋮----
'excerpt_featured' => generar_extracto_ajax($post['content'], 100), // Para los 2 destacados
'excerpt_secondary' => generar_extracto_ajax($post['content'], 70), // Para los 4 secundarios
````

## File: app/api/BLOG_inc/includes/ajax.search.php
````php
// Establecer cabecera JSON
⋮----
// Obtener término de búsqueda (usamos GET para simplicidad AJAX)
⋮----
// Si el término está vacío, devolver un array vacío
⋮----
// Incluir la estructura de datos
⋮----
// Filtrar los posts (búsqueda simple insensible a mayúsculas en título y contenido)
⋮----
// stripos busca la primera ocurrencia insensible a mayúsculas
⋮----
// Devolver los resultados encontrados (solo título y slug para el enlace)
⋮----
}, array_values($results))); // array_values para reindexar el array
````

## File: app/api/BLOG_inc/includes/posts.estructura-datos.php
````php
'slug' => 'bienvenida-blog', // Identificador único (para URLs o JS)
⋮----
'date' => '2025-05-04', // Fecha de publicación (opcional)
⋮----
'slug' => 'guia-nuevos-jugadores', // Identificador único (para URLs o JS)
⋮----
'slug' => 'JosicoVila-buscadores-SEO', // Identificador único (para URLs o JS)
⋮----
'date' => '2025-05-05', // Fecha de publicación (opcional)
⋮----
'slug' => 'bienvenida-pueblo-dragones', // Identificador único (para URLs o JS)
⋮----
'date' => '2025-05-06', // Fecha de publicación (opcional)
⋮----
'slug' => 'cuatro-dragones-leyenda', // Identificador único (para URLs o JS)
⋮----
'slug' => 'musica-instrumental-pueblo-dragones', // Identificador único (para URLs o JS)
⋮----
'slug' => 'relatos-cortos-vivos', // Identificador único (para URLs o JS)
⋮----
'slug' => 'libros-escondidos-encontrados', // Identificador único (para URLs o JS)
⋮----
'slug' => 'multijugador-tiempo-real', // Identificador único (para URLs o JS)
⋮----
'slug' => 'multijugador-chat-firebase', // Identificador único (para URLs o JS)
⋮----
'slug' => 'sonido-posicional-pueblo-dragones', // Identificador único (para URLs o JS)
⋮----
'slug' => 'nivel-progreso-experiencia-dragones', // Identificador único (para URLs o JS)
⋮----
'slug' => 'mundo3D-como-construye-enable3d-threejs', // Identificador único (para URLs o JS)
⋮----
'slug' => 'npm-Vite-XAMPP', // Identificador único (para URLs o JS)
⋮----
'slug' => 'anecdotas-desarrollo-mundo3D', // Identificador único (para URLs o JS)
⋮----
'slug' => 'preguntas-frecuentes-FAQ', // Identificador único (para URLs o JS)
⋮----
'slug' => 'creditos-agradecimientos', // Identificador único (para URLs o JS)
⋮----
'date' => '2025-05-16', // Un día después del último post para mantener cronología
⋮----
'date' => '2025-05-17', // Fecha posterior al último post
⋮----
'date' => '2025-05-18', // Fecha posterior a los últimos posts
⋮----
'date' => '2025-05-18', // Fecha posterior al último post
⋮----
'date' => '2025-05-19', // Fecha correlativa
⋮----
// Añade más entradas aquí en el futuro
````

## File: app/api/LIBROS/index.php
````php

````

## File: app/api/RELATOS/index.php
````php

````

## File: app/js/blog-sidebar.js
````javascript
const searchInput = document.getElementById('blog-search-input'); // Nuevo
const searchResultsContainer = document.getElementById('search-results'); // Nuevo
⋮----
// const sidebar = document.getElementById('blog-sidebar'); // No se usa directamente aquí
⋮----
// Comprobar si todos los elementos necesarios existen
⋮----
// Podrías querer deshabilitar la funcionalidad si falta algo,
// pero por ahora solo mostramos el error.
⋮----
// Función para actualizar el botón
function updateToggleButton()
⋮----
updateToggleButton(); // Actualizar texto/icono del botón
// Guardar estado en localStorage
⋮----
// Estado inicial al cargar la página
⋮----
// Actualizar el botón al cargar la página
⋮----
// --- NUEVO: Lógica del Buscador AJAX ---
⋮----
if (searchTerm.length < 2) { // Buscar solo si hay al menos 2 caracteres
searchResultsContainer.innerHTML = ''; // Limpiar resultados si es muy corto
searchResultsContainer.style.display = 'none'; // Ocultar contenedor
⋮----
// Hacer la petición AJAX
⋮----
searchResultsContainer.innerHTML = ''; // Limpiar resultados anteriores
⋮----
a.href = `/blog/${post.slug}/`; // Usar URL amigable
⋮----
searchResultsContainer.style.display = 'block'; // Mostrar contenedor
⋮----
searchResultsContainer.style.display = 'block'; // Mostrar mensaje
⋮----
// --- FIN NUEVO: Lógica del Buscador AJAX ---
````

## File: .gitignore
````
# Persistent data
/data/cristal-musica/
/data/relatos-audios/
/data/relatos-videos/
/data/relatos-pdf/
/data/blog-media/
/data/media-videos/
/data/media-sounds/
/data/intro-video/
/data/intro-mp3/
/data/js-model/

# OS / editor noise
.DS_Store
Thumbs.db
desktop.ini
.idea/
.vscode/
*.log


/CLAUDE_DESIGN/
````

## File: app/.htaccess
````
<IfModule mod_rewrite.c>
    RewriteEngine On
    Options -MultiViews
    RewriteBase /

    # Serve real files and directories as-is (assets, uploads, etc.)
    RewriteCond %{REQUEST_FILENAME} -f [OR]
    RewriteCond %{REQUEST_FILENAME} -d
    RewriteRule ^ - [L]

    # Redirect direct PHP file access to friendly URLs
    RewriteCond %{THE_REQUEST} \s/index-juego\.php[\s?] [NC]
    RewriteRule ^index-juego\.php$ /mundo3D/ [R=301,L]

    RewriteCond %{THE_REQUEST} \s/index\.php[\s?] [NC]
    RewriteRule ^index\.php$ /blog/ [R=301,L]

    # Mundo 3D
    RewriteRule ^mundo3D/?$ index-juego.php [L,QSA]

    # Blog — tag must come before post (tag has two segments: tag/nombre)
    RewriteRule ^blog/tag/([^/]+)/?$ index.php?tag=$1 [L,QSA]
    RewriteRule ^blog/([^/]+)/?$    index.php?post=$1 [L,QSA]
    RewriteRule ^blog/?$            index.php         [L,QSA]

    # Laboratorio de Apps
    RewriteRule ^laboratorio-de-apps/?$ laboratorio-de-apps.php [L,QSA]

    # CV pages
    RewriteRule ^curriculum/es/?$ curriculum_es.html [L,NC]
    RewriteRule ^resume/en/?$     curriculum_en.html [L,NC]

</IfModule>
````

## File: app/api/RELATOS/includes/ajax.relato.php
````php

````

## File: app/laboratorio-apps.json
````json
{
  "apps": [
    {
      "id": "001",
      "badge": "Espécimen áureo",
      "name": "JosicoVila.es",
      "subtitle": "Blog y Mundo 3D",
      "stage": "free",
      "layout": "featured",
      "glow": "rgba(212,180,101,.18)",
      "icon": "globe",
      "description": "Mi proyecto web principal en el que llevo trabajando desde 2018 y siempre con la consigna en mente «Todo por y para mis sobrinos».",
      "tags": ["PHP", "Three.js", "Web", "Multijugador"],
      "meta": "Lanzado <b>2018</b> · v <b>9</b>",
      "buttons": [
        { "label": "Visitar", "url": "https://josicovila.es", "style": "gold" },
        { "label": "GitHub", "url": "https://github.com/JosicoV/josicovila.es", "style": "github" }
      ]
    }
    ,
    {
      "id": "003",
      "name": "Control de Horas",
      "subtitle": "Registro de horas laborales",
      "stage": "free",
      "layout": "normal",
      "glow": "rgba(79,70,229,.15)",
      "icon": "timer",
      "description": "Aplicación local para registrar y consultar horas de trabajo. Resumen diario, semanal y mensual, vista de impresión y exportación a CSV.",
      "tags": ["Python", "Flask", "SQLite"],
      "meta": "Lanzado <b>2026</b> · v <b>1</b>",
      "buttons": [
        { "label": "GitHub", "url": "https://github.com/JosicoV/control-de-horas", "style": "github" }
      ]
    }
    ,
    {
      "id": "002",
      "name": "JosicoVila.com",
      "subtitle": "Reproductor 3D (inglés)",
      "stage": "free",
      "layout": "normal",
      "glow": "rgba(212,180,101,.14)",
      "icon": "drop",
      "description": "Reproductor con toda mi discografía en inglés con una esfera 3D que se deforma con el ritmo de la música.",
      "tags": ["PHP", "Three.js", "Javascript Vanilla"],
      "meta": "Lanzado <b>2020</b> · v <b>7</b>",
      "buttons": [
        { "label": "Visitar", "url": "https://josicovila.com", "style": "gold" },
        { "label": "GitHub", "url": "https://github.com/JosicoV/josicovila.com", "style": "github" }
      ]
    }
    ,
    {
      "id": "004",
      "name": "SEO Desktop Manager",
      "subtitle": "Análisis SEO de escritorio",
      "stage": "hatch",
      "layout": "normal",
      "glow": "rgba(16,185,129,.15)",
      "icon": "compass",
      "description": "Herramienta de escritorio para auditar el SEO de tus sitios. Rastrea páginas, puntúa su SEO y se integra con Google Search Console y PageSpeed Insights.",
      "tags": ["Electron", "React", "SQLite", "Node.js"],
      "meta": "v <b>0.1</b> · <b>2026</b>",
      "buttons": [
        { "label": "GitHub", "url": "https://github.com/JosicoV/SEO-desktop-manager", "style": "github" }
      ]
    }
    ,
    {
      "id": "005",
      "name": "Route Partner",
      "subtitle": "Tu compañero de rutas andando, corriendo…",
      "stage": "hatch",
      "layout": "normal",
      "glow": "rgba(34,197,94,.14)",
      "icon": "compass",
      "description": "App móvil + web para control de rutas. Con la parte móvil grabas y tomas fotos de la ruta que luego se presentan en la web con visor 2D/3D y KPIs obtenidos.",
      "tags": ["PHP", "Node.js", "MariaDB", "GPS", "3D"],
      "meta": "Alfa · <b>2026</b>",
      "buttons": [
        { "label": "Visitar", "url": "https://routepartner.josicovila.com", "style": "gold" }
      ]
    }
  ]
}
````

## File: app/laboratorio-de-apps.php
````php
/* ── Load apps data ── */
⋮----
/* ── Stage metadata ── */
⋮----
/* ── Stage counts for filter chips ── */
⋮----
/* ── Icon SVG paths (inner content only, wrapper added in render) ── */
⋮----
/* ── Render a single specimen card ── */
function render_specimen(array $app, array $stage_meta, array $icons, string $github_svg, string $external_svg): string {
⋮----
/* Tags */
⋮----
/* Buttons */
````

## File: app/css/blog-styles.css
````css
/* ══════════════════════════════════════════════════════
   JosicoVila.es — Blog & Post Styles
   Design: oklch dark medieval-fantasy theme
   ══════════════════════════════════════════════════════ */
⋮----
:root {
⋮----
/* ── RESET ── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
⋮----
body {
⋮----
/* undo old styles */
⋮----
/* ── NOISE OVERLAY ── */
body::before {
⋮----
/* ══════════════════════════════════════════════════════
   NAV
   ══════════════════════════════════════════════════════ */
nav.site-nav {
.nav-logo img { height: 36px; width: auto; display: block; object-fit: contain; }
.nav-links { display: flex; gap: 2rem; list-style: none; }
.nav-links a {
.nav-links a:hover { color: var(--gold); }
.nav-cta {
.nav-cta:hover { opacity: 0.85; }
⋮----
/* ── Hamburger button (hidden on desktop) ── */
.nav-hamburger {
.nav-hamburger:hover { background: rgba(255,255,255,.07); }
.nav-hamburger span {
.nav-hamburger[aria-expanded="true"] span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.nav-hamburger[aria-expanded="true"] span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.nav-hamburger[aria-expanded="true"] span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
⋮----
/* ══════════════════════════════════════════════════════
   READING PROGRESS BAR (post view)
   ══════════════════════════════════════════════════════ */
#progress-bar {
⋮----
/* ══════════════════════════════════════════════════════
   BLOG HOME HERO
   ══════════════════════════════════════════════════════ */
.blog-hero {
.blog-hero-bg {
.blog-hero-bg::after {
.blog-hero-content {
.hero-tag {
.blog-hero-title {
.blog-hero-excerpt {
.blog-hero-meta {
.blog-hero-meta time { color: var(--text); }
.blog-hero-meta .sep { opacity: 0.4; }
.hero-read-link {
.hero-read-link:hover { border-color: var(--gold); }
⋮----
/* ══════════════════════════════════════════════════════
   FILTER BAR
   ══════════════════════════════════════════════════════ */
.filter-bar {
.filter-inner {
.filter-inner::-webkit-scrollbar { display: none; }
.filter-btn {
.filter-btn::after {
.filter-btn:hover { color: var(--text); }
.filter-btn.active { color: var(--gold); }
.filter-btn.active::after { transform: scaleX(1); }
⋮----
/* ══════════════════════════════════════════════════════
   MAIN GRID (blog home)
   ══════════════════════════════════════════════════════ */
.blog-main {
.section-label {
.section-label::before {
⋮----
.grid-wrap {
.grid-row {
.grid-row.r-7-5   { grid-template-columns: 7fr 5fr; }
.grid-row.r-4-4-4 { grid-template-columns: 1fr 1fr 1fr; }
.grid-row.r-12    { grid-template-columns: 1fr; }
.grid-row.r-5-7   { grid-template-columns: 5fr 7fr; }
.grid-row.r-6-3-3 { grid-template-columns: 6fr 3fr 3fr; }
⋮----
/* ── CARD ── */
.card-wrap { animation: cardEnter 0.55s cubic-bezier(0.22,1,0.36,1) both; }
.card-wrap.hidden { display: none; }
⋮----
article.card {
article.card:hover { background: var(--card-hover); }
article.card a { text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%; }
⋮----
.card-img {
.card-img img {
article.card:hover .card-img img {
⋮----
article.card.large .card-img { aspect-ratio: 16/10; }
article.card.wide { flex-direction: row; }
article.card.wide .card-img { width: 45%; aspect-ratio: unset; min-height: 280px; }
article.card.wide .card-body { flex: 1; }
⋮----
article.card.overlay { min-height: 420px; }
article.card.overlay a { position: relative; }
article.card.overlay .card-img {
article.card.overlay .card-img img { height: 100%; filter: saturate(0.6) brightness(0.55); }
article.card.overlay .card-body {
⋮----
.card-body { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }
.card.large .card-body { padding: 2rem; }
⋮----
.card-category {
.cat-dragones    { color: var(--rose); }
.cat-mundo3d     { color: var(--teal); }
.cat-desarrollo  { color: var(--violet); }
.cat-musica      { color: var(--green); }
.cat-multijugador{ color: var(--gold); }
.cat-relatos     { color: var(--amber); }
.cat-meta        { color: var(--muted); }
⋮----
.card-title {
article.card.large   .card-title { font-size: 1.6rem; }
article.card.overlay .card-title { font-size: 1.9rem; font-weight: 900; }
article.card:not(.large):not(.overlay) .card-title { font-size: 1.05rem; }
⋮----
.card-excerpt {
article.card.large .card-excerpt { -webkit-line-clamp: 4; font-size: 0.95rem; }
⋮----
.card-footer {
.reading-time { display: flex; align-items: center; gap: 0.35rem; }
⋮----
/* ══════════════════════════════════════════════════════
   SINGLE POST — HERO
   ══════════════════════════════════════════════════════ */
.post-hero {
.post-hero-img {
.post-hero-inner {
.breadcrumb {
.breadcrumb a { color: var(--muted); text-decoration: none; transition: color 0.2s; }
.breadcrumb a:hover { color: var(--gold); }
.breadcrumb .sep { opacity: 0.4; }
.breadcrumb .current { color: var(--gold); }
⋮----
.post-category-label {
h1.post-title {
.post-meta {
.post-meta time { color: var(--text); font-weight: 500; }
.post-meta .dot { opacity: 0.35; }
.post-read-time { display: flex; align-items: center; gap: 0.35rem; }
⋮----
/* ══════════════════════════════════════════════════════
   SINGLE POST — BODY LAYOUT
   ══════════════════════════════════════════════════════ */
.post-layout {
⋮----
.post-body  { grid-column: 1; }
.post-aside { grid-column: 2; position: sticky; top: 96px; }
⋮----
/* ── BODY TYPOGRAPHY ── */
.post-body p {
.post-body p strong { color: var(--text); font-weight: 600; }
⋮----
.post-body h2, .post-body h3 {
.post-body h2 {
.post-body h3 {
.post-body h3::before {
.post-body h2.is-current-section,
⋮----
.post-body ul, .post-body ol {
.post-body li { margin-bottom: 0.4rem; line-height: 1.7; font-size: 1.05rem; }
⋮----
.post-body blockquote {
.post-body blockquote::before {
.post-body blockquote p {
⋮----
.post-body figure { margin: 3rem -1rem; }
.post-body figure img {
.post-body figure img:hover { filter: saturate(1); }
.post-body figcaption {
⋮----
/* images inside post content */
.post-body img {
.post-body img:hover { filter: saturate(1); }
⋮----
/* videos */
.post-body .video-responsive, .video-responsive {
.post-body .video-responsive iframe, .video-responsive iframe {
⋮----
.post-body code {
⋮----
/* pull quote accent */
.pull-quote {
.pull-quote p {
⋮----
/* ── TAGS ── */
.post-tags {
.post-tags a {
.post-tags a:hover { border-color: var(--gold); color: var(--gold); }
⋮----
/* ── SOCIAL ── */
.post-social {
.post-social span { font-size: 0.75rem; color: var(--muted); font-weight: 600; letter-spacing: 0.06em; text-transform: uppercase; }
.social-link {
.social-link:hover { color: var(--gold); border-color: var(--gold); }
⋮----
/* ── AUTHOR BOX ── */
.author-box {
.author-box img { width: 56px; height: 56px; object-fit: contain; flex-shrink: 0; }
.author-name { font-family: var(--ff-display); font-weight: 700; font-size: 1.1rem; margin-bottom: 0.3rem; }
.author-bio { color: var(--muted); font-size: 0.88rem; line-height: 1.6; }
⋮----
/* ── COMMENTS ── */
.comments-section { margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--border); }
.comments-section h2 {
⋮----
/* ── SIDEBAR TOC ── */
.post-aside .toc-label {
.post-aside .toc-label::before { content: ''; width: 20px; height: 1px; background: var(--border); }
.toc-list { list-style: none; }
.toc-list li { border-left: 1px solid var(--border); }
.toc-list .toc-item--h3 a {
.toc-list a {
.toc-list a:hover, .toc-list a.active { color: var(--gold); border-color: var(--gold); }
.toc-empty {
⋮----
/* ══════════════════════════════════════════════════════
   RELATED ARTICLES
   ══════════════════════════════════════════════════════ */
.related-section {
.related-inner { max-width: 1100px; margin: 0 auto; }
.related-label {
.related-label::before { content: ''; width: 28px; height: 1px; background: var(--border); }
.related-grid {
.rel-card {
.rel-card:hover { background: var(--card-hover); }
.rel-card img {
.rel-card:hover img { filter: saturate(1); }
.rel-card-body { padding: 1.2rem; flex: 1; }
.rel-cat { font-family: var(--ff-medieval); font-size: 0.7rem; color: var(--rose); margin-bottom: 0.4rem; }
.rel-title {
.rel-excerpt {
⋮----
/* tag view heading */
.tag-filter-heading {
.tag-filter-heading em { font-style: italic; color: var(--gold); }
.tag-view-header {
⋮----
/* ══════════════════════════════════════════════════════
   FOOTER
   ══════════════════════════════════════════════════════ */
.site-footer {
.site-footer .footer-logo img { height: 32px; margin-bottom: 1rem; opacity: 0.7; }
.site-footer p { color: var(--muted); font-size: 0.82rem; }
.site-footer a { color: var(--gold); text-decoration: none; }
⋮----
/* ══════════════════════════════════════════════════════
   ANIMATIONS
   ══════════════════════════════════════════════════════ */
⋮----
/* ══════════════════════════════════════════════════════
   RESPONSIVE
   ══════════════════════════════════════════════════════ */
⋮----
.grid-row.r-7-5, .grid-row.r-5-7, .grid-row.r-6-3-3 { grid-template-columns: 1fr; }
.grid-row.r-4-4-4 { grid-template-columns: 1fr 1fr; }
article.card.wide { flex-direction: column; }
article.card.wide .card-img { width: 100%; min-height: 220px; aspect-ratio: 16/9; }
⋮----
.nav-hamburger { display: flex; }
.nav-links {
.nav-links.is-open { display: flex; }
.nav-links li { width: 100%; }
⋮----
.nav-links li:last-child a { border-bottom: none; }
.blog-hero-content { padding: 0 1.2rem; }
.filter-inner { padding: 0 1.2rem; }
.blog-main { padding: 2.5rem 0 4rem; }
.grid-row.r-4-4-4 { grid-template-columns: 1fr; }
.section-label { padding: 0 1.2rem; }
.post-layout { padding: 2.5rem 1.2rem 4rem; }
.post-hero-inner { padding: 0 1.2rem; }
.related-section { padding: 3rem 1.2rem; }
.site-footer { padding: 2rem 1.2rem; }
.tag-view-header { padding: 2rem 1.2rem 0; }
.author-box { flex-direction: column; }
````

## File: app/index-juego.php
````php
$viteAssets = vite('src/main.js'); // Llama a la función vite() pasando tu punto de entrada JS
⋮----
// Para depurar el contenido de $viteAssets:
// echo "<!-- DEBUG VITE ASSETS:\n";
// var_dump($viteAssets);
// echo "\n-->\n";
// exit; // Descomenta para ver solo esto y el HTML anterior
````

## File: app/index.php
````php
// ══════════════════════════════════════════════════════
// JosicoVila.es — Blog (listing + single post)
⋮----
/* ── Helper: short excerpt from HTML content ── */
function generar_extracto($htmlContent, $maxLength = 155) {
⋮----
/* ── Helper: first <img> src from HTML ── */
function extraer_primera_imagen($htmlContent) {
⋮----
$doc->loadHTML('<?xml encoding="utf-8" ?>' . $htmlContent);
⋮----
$imgs = $doc->getElementsByTagName('img');
if ($imgs->length > 0) return $imgs->item(0)->getAttribute('src');
⋮----
/* ── Helper: card image (from content or fallback) ── */
function get_card_img($post) {
⋮----
/* ── Helper: excerpt for card ── */
function get_excerpt($post) {
⋮----
/* ── Helper: estimated reading time in minutes ── */
function estimate_read($post) {
⋮----
/* ── Helper: derive category from tags and slug ── */
function derive_cat($post) {
⋮----
/* ── Helper: category display label ── */
function cat_label($cat) {
⋮----
/* ── Helper: format date ── */
function fmt_date($iso) {
$d = DateTime::createFromFormat('Y-m-d', $iso);
⋮----
return $d->format('j') . ' ' . $months[(int)$d->format('n')] . ' ' . $d->format('Y');
⋮----
/* ── Helper: related posts by shared tags ── */
function get_related_posts($currentPostSlug, $allPosts, $maxRelated = 4) {
⋮----
/* ── Helper: build one editorial grid row ── */
function build_card($post, $variant = '') {
⋮----
function build_grid($posts) {
⋮----
// ── Load post data ──
⋮----
// Attach stable sort index
⋮----
// Sort newest first
⋮----
// ── URL & routing ──
````
