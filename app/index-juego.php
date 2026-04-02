<!DOCTYPE html>
<?php
// Habilitar temporalmente la visualización de errores para depuración en producción
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vite-helpers.php';
$viteAssets = vite('src/main.js'); // Llama a la función vite() pasando tu punto de entrada JS
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" 
      type="image/png" 
      href="/media/img/logo.png">
    <title>Mundo 3D de Josico Vila - Explora el Pueblo de los Dragones</title>
    <meta name="description" content="Sumérgete en el Mundo 3D de Josico Vila. Explora el Pueblo de los Dragones, viaja por portales a islas de música y relatos, y elige tu avatar para una aventura interactiva.">
    <style>
      body {
            margin: 0;
            overflow: hidden;
            background-color: black; /* <-- Forzar fondo negro */
        }
        canvas { display: block; }
      #container { z-index: 2000000000; position: fixed; bottom: 20px; left: 30px; width: 220px; height: 200px; display: none}
      #info { position: relative; top: 10px; left: 10px; color: black; font-size: 15px; display: flex; flex-direction: row; align-items: center; justify-content: space-between; border: 1px black solid; border-radius: 20px; background-color: rgba(255,255,255, 0.5); padding: 20px;}
      #players { color: black; font-size: 30px; font-weight: bold; }
      #time-arc-container{
        top: 10px;
        left: 50%;
        position: absolute;
        transform: translateX(-50%);
        width: 150px;
        height: 75px;
        z-index: 10;
        border: 1px solid black;
        border-radius: 20px;
        background: url('/media/img/ui/cottage.png') no-repeat center center;
        background-size: cover;
      }
      #time-arc-icon {
        position: absolute;
        width: 30px;
        height: 30px;
      }
      /* Estilos Barra de Progreso en Botones */
      
      .progress-container {
          position: absolute;
          top: 0; left: 0;
          width: 100%; height: 100%;
          background-color: #555; /* Color de fondo de la barra */
          display: flex; /* Para centrar el texto */
          align-items: center;
          justify-content: center;
          border-radius: inherit; /* Hereda el borde redondeado del botón */
      }
      .progress-bar {
          position: absolute;
          top: 0; left: 0;
          height: 100%; width: 0%; /* Empieza en 0% */
          background-color: #4CAF50; /* Color de la barra de progreso */
          transition: width 0.1s linear; /* Transición suave */
          border-radius: inherit;
          z-index: 0; /* Asegura que la barra esté detrás del texto */
      }
      /* Estilos Advertencia Múltiples Conexiones */
      #multiple-connections-warning {
            display: none; /* Oculto por defecto, JS lo mostrará */
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0; /* Ocupar toda la pantalla */
            background-color: rgba(0, 0, 0, 0.85); /* Fondo oscuro semitransparente */
            color: #ffcc00; /* Color de texto */
            z-index: -1; /* <<-- INICIALMENTE DETRÁS DE TODO */
            /* display: flex; <-- ELIMINAR DE AQUÍ, JS lo añadirá */
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: clamp(18px, 4vw, 28px); /* Tamaño de fuente adaptable */
            padding: 30px;
            box-sizing: border-box;
         }
        .progress-text {
            position: relative; /* Para que esté sobre la barra */
            z-index: 15000; /* Asegura que el texto esté sobre la barra */
            color: white; /* Asegura que el color contraste */
            font-size: 14px; /* O el tamaño que prefieras */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); /* Sombra más definida para legibilidad */
            pointer-events: none; /* Evita que el texto bloquee clics al botón */
        }
        .button-text {
            display: none; /* Oculto por defecto */
            position: relative;
            z-index: 15000;
            color: white;
            pointer-events: none; /* Evita que el texto bloquee clics al botón */
            font-size: 18px;
        }
    </style>
    <!-- Carga Ammo.js explícitamente ANTES de tu bundle
    <script src="/js/ammo/ammo.wasm.js"></script>   -->
    <?php
    // Para depurar el contenido de $viteAssets:
    // echo "<!-- DEBUG VITE ASSETS:\n";
    // var_dump($viteAssets);
    // echo "\n-->\n";
    // exit; // Descomenta para ver solo esto y el HTML anterior

    echo $viteAssets;
    ?>


</head>
<body>
    <div class="extras">
        <audio class="intro" src="/media/sounds/intro.mp3"></audio>
        <audio class="birds" src="/media/sounds/birds.mp3"></audio>
        <video class="particulas" src="/media/videos/particulas.mp4" autoplay muted loop></video>
        <video class="abstract" src="/media/videos/resumen.mp4" autoplay muted loop></video>
    </div>

    <div class="logos">
        <div class="logos1">
            <img src="/media/img/logos/Unreal-Engine.jpg" class="unreal">
            <img src="/media/img/logos/docs-icon-TweenJS.png" class="tween">
        </div>
        <div class="logos2">
            <img src="/media/img/logos/threejs.png" class="three">
            <img src="/media/img/logos/Stack_Overflow-Logo.wine.png" class="stackoverflow">
        </div>
        <div class="logos3">
            <img src="/media/img/logos/logo-firebase.png" class="firebase">
        </div>
        <div class="logos4">
            <img class="gemini" src="/media/img/logos/logo-gemini.jpeg">
        </div>
        <div class="dedicatoria"><img src="/media/img/logos/dedicatoria.png"></div>
    </div>

    <div class="wrapperLogros">
        <div class="avisoLogro">
            <img src="/media/img/fa2.gif"><img src="/media/img/fa1.gif"><br>LOGRO DESBLOQUEADO
        </div>
    </div>

    <!--
        EMPIEZA MUSICA
-->
    <div class="musica">
        <div class="salirMusica">
            <img src="/media/img/salirPiedraRunica.png">
        </div>
        <?php
        include_once __DIR__ . '/api/CRISTAL/index.php';
        ?>
    </div>
<!--    
        FIN MUSICA
    -->
    <!--
        RELATOS
-->
    <div class="todoRelatos">
        <div class="salirRelatos">
            <img src="/media/img/salirPiedraRunica.png">
        </div>
        <?php
        include_once __DIR__ . '/api/RELATOS/index.php';
        ?>
    </div>
<!--    
        FIN RELATOS
    -->
    <!--
       LIBROS
-->   
    <div class="todoLibros">
        <div class="salirLibros">
            <img src="/media/img/salirPiedraRunica.png">
        </div>
        <?php
        include_once __DIR__ . '/api/LIBROS/index.php';
        ?>
    </div>
<!--   
        FIN LIBROS
    -->


    <div class="wrapperSenal">
        <div class="senalIdaIM">
            <h1>¿Quieres viajar<br><br>a la isla de la Música?</h1>
            <div class="botones">
                <div class="siIdaIM">SI</div>
                <div class="noIdaIM">NO</div>
            </div>
        </div>
        <div class="senalVueltaIM">
            <h1>¿Quieres viajar<br><br>de vuelta al pueblo?</h1>
            <div class="botones">
                <div class="siVueltaIM">SI</div>
                <div class="noVueltaIM">NO</div>
            </div>
        </div>
        <div class="senalMusica">
            <h1>¿Quieres activar el<br><br>portal de la Música?</h1>
            <div class="botones">
                <div class="simusica">SI</div>
                <div class="nomusica">NO</div>
            </div>
        </div>

        <div class="senalIdaIR">
            <h1>¿Quieres viajar<br><br>a la isla de los Relatos?</h1>
            <div class="botones">
                <div class="siIdaIR">SI</div>
                <div class="noIdaIR">NO</div>
            </div>
        </div>
        <div class="senalVueltaIR">
            <h1>¿Quieres viajar<br><br>de vuelta al pueblo?</h1>
            <div class="botones">
                <div class="siVueltaIR">SI</div>
                <div class="noVueltaIR">NO</div>
            </div>
        </div>
        <div class="senalRelatos">
            <h1>¿Quieres activar el<br><br>portal de los Relatos Cortos?</h1>
            <div class="botones">
                <div class="sirelatos">SI</div>
                <div class="norelatos">NO</div>
            </div>
        </div>

        <div class="senalIdaIL">
            <h1>¿Quieres viajar<br><br>a la isla de los Libros?</h1>
            <div class="botones">
                <div class="siIdaIL">SI</div>
                <div class="noIdaIL">NO</div>
            </div>
        </div>
        <div class="senalVueltaIL">
            <h1>¿Quieres viajar<br><br>de vuelta al pueblo?</h1>
            <div class="botones">
                <div class="siVueltaIL">SI</div>
                <div class="noVueltaIL">NO</div>
            </div>
        </div>
        <div class="senalLibros">
            <h1>¿Quieres activar el<br><br>portal de los Libros?</h1>
            <div class="botones">
                <div class="silibros">SI</div>
                <div class="nolibros">NO</div>
            </div>
        </div>

    </div>


    <div class="saltarIntro">
        <img src="/media/img/saltarIntro.png">
    </div>

    <!-- Intro -->
    <div class="wrapperPergamino" style="background: url('/intro/images/fondo-josico.png') repeat center center">
        
    <!--<video class="videoFondoIntro" src="/intro/video/fondo-blancoynegro.mp4" poster="/intro/video/poster.png" autoplay loop muted></video>-->
        <div class="logoIntro">
            <img src="/intro/images/Josico-Vila-letras.png">
        </div>
        
        <div class="wrapperExplicaciones">
            <div class="explicaciones">
                <h1 style="color: lime">Bienvenid@,</h1>
                <p>Me hace mucha ilusión presentarte este mini mundo en tres dimensiones en el que, con ayuda de tu Avatar,
                deberás adentrarte en una serie de portales repartidos por el pueblo protagonista. Cuando estés list@, continúa.
                </p>
            </div>
            <div class="explicaciones-movile">
                <h1 style="color: lime">Fase Beta para móviles</h1>
                <p>Estás probando una fase no terminada del juego en su versión para móviles. Algunas cosas como las
                    islas flotantes no están terminadas, disculpa las molestias. Estamos trabajando para cambiarlo.
                    Tienes la versión final en su versión para ordenadores de sobremesa. Disfruta.
                </p>
            </div>
            <div class="videosExplicaciones">
                <div class="video1 nomovil">
                    <img src="/intro/images/movimiento.png" style="width: 100%; height: auto" />
                </div>
                <div class="video2 nomovil">
                    <h2 style="color: lime">¡Atención!</h2>
                    - Este juego utiliza diferentes sonidos, ajusta tu volumen.<br>
                    - Prueba el multijugador online en un mismo PC en diferentes navegadores.<br>
                    - El movimiento del personaje es el típico 'WASD' + botón izquierdo del ratón.<br>
                    <br>
                    <span style="color: lime">¡Diviértete! ¡Descúbreme!</span>
                </div>
            </div>
            <div class="wrapperSenalIntro">
                <img src="/intro/images/senal-continua.png" class="elegirAvatar">
            </div>
        </div>


        <div class="carousel">
            <div class="list">
                <div class="item">
                    <img class="avatarIntro" src="/intro/images/Dragon_Evolved.gif">
                    <div class="introduce">
                        <div class="title">AVATAR</div>
                        <div class="topic">Dragoon</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Cazador de tesoros nato. Lleva poco tiempo en el pueblo, pero ya se ha hecho un hueco entre los habitantes.
                        </div>
                        <button class="seeMore">Más Información &#8599;</button>
                    </div>
                    <div class="detail">
                        <div class="title">Dragoon</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Disfruta resolviendo puzzles y acertijos que le lleven al encuentro de tesoros. Te será de gran ayuda en la búsqueda de los portales.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Tamaño</p>
                                <p>1.5m</p>
                            </div>
                            <div>
                                <p>Peso</p>
                                <p>60Kg</p>
                            </div>
                            <div>
                                <p>Familia</p>
                                <p>Dragones</p>
                            </div>
                            <div>
                                <p>Velocidad</p>
                                <p>Normal</p>
                            </div>
                            <div>
                                <p>Edad</p>
                                <p>252 años</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button class="login" style="border: 1px solid white" data-avatar="Dragon_Evolved" data-nombre="Dragoon">
                                <div class="progress-container">
                                    <div class="progress-bar"></div>
                                    <span class="progress-text">Cargando... 0%</span>
                                </div>
                                <span class="button-text" style="display: none;">Entrar al Juego</span>
                            </button>
                            <div class="loading-messages" style="display: none; font-style: italic; color: #ccc;">
                                <span>Dándole de comer a los dragones...</span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="item">
                    <img class="avatarIntro" src="/intro/images/Goleling.gif">
                    <div class="introduce">
                        <div class="title">AVATAR</div>
                        <div class="topic">Goleling</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Máscota del jefe del pueblo. Lleva con él desde que este paso su rito de iniciación a la caza a los 18 años.
                        </div>
                        <button class="seeMore">Más Información &#8599;</button>
                    </div>
                    <div class="detail">
                        <div class="title">Goleling</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Siendo la mascota del cabecilla del pueblo tiene que estar siempre dispuesto para ayudarlo en todas sus tareas que incluye la de guardar los portales.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Tamaño</p>
                                <p>1.0m</p>
                            </div>
                            <div>
                                <p>Peso</p>
                                <p>35Kg</p>
                            </div>
                            <div>
                                <p>Familia</p>
                                <p>Murciélagos</p>
                            </div>
                            <div>
                                <p>Velocidad</p>
                                <p>Normal</p>
                            </div>
                            <div>
                                <p>Edad</p>
                                <p>???</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button class="login" style="border: 1px solid white" data-avatar="Goleling" data-nombre="Goleling">
                                <div class="progress-container">
                                    <div class="progress-bar"></div>
                                    <span class="progress-text">Cargando... 0%</span>
                                </div>
                                <span class="button-text" style="display: none;">Entrar al Juego</span>
                            </button>
                            <div class="loading-messages" style="display: none; font-style: italic; color: white;">
                                <span>Dándole de comer a los dragones...</span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="item">
                    <img class="avatarIntro" src="/intro/images/Pigeon.gif">
                    <div class="introduce">
                        <div class="title">AVATAR</div>
                        <div class="topic">Pigeon</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Lo encontraron cuando era un cachorro, abandonado en la puerta principal del pueblo.
                        </div>
                        <button class="seeMore">Más Información &#8599;</button>
                    </div>
                    <div class="detail">
                        <div class="title">Pigeon</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Con el paso del tiempo y como agradecimiento por cuidar de él, se ha convertido en una de las mascotas cazadoras más importantes del pueblo.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Tamaño</p>
                                <p>1.1m</p>
                            </div>
                            <div>
                                <p>Peso</p>
                                <p>40Kg</p>
                            </div>
                            <div>
                                <p>Familia</p>
                                <p>Aves</p>
                            </div>
                            <div>
                                <p>Velocidad</p>
                                <p>Normal</p>
                            </div>
                            <div>
                                <p>Edad</p>
                                <p>177 años</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button class="login" style="border: 1px solid white" data-avatar="Pigeon" data-nombre="Pigeon">
                                <div class="progress-container">
                                    <div class="progress-bar"></div>
                                    <span class="progress-text">Cargando... 0%</span>
                                </div>
                                <span class="button-text" style="display: none;">Entrar al Juego</span>
                            </button>
                            <div class="loading-messages" style="display: none; font-style: italic; color: #ccc;">
                                <span>Dándole de comer a los dragones...</span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="item">
                    <img class="avatarIntro" src="/intro/images/Demon.gif">
                    <div class="introduce">
                        <div class="title">AVATAR</div>
                        <div class="topic">Fera</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            La más revoltosa de los cuatro. Aprovecha cualquier ocasión para gastar bromas a sus compañeros.
                        </div>
                        <button class="seeMore">Más Información &#8599;</button>
                    </div>
                    <div class="detail">
                        <div class="title">Fera</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Su actitud le ha traido problemas alguna vez, pero no deja de ser trabajadora y seguro que te acompañará con gusto a buscar los portales.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Tamaño</p>
                                <p>0.9m</p>
                            </div>
                            <div>
                                <p>Peso</p>
                                <p>28Kg</p>
                            </div>
                            <div>
                                <p>Familia</p>
                                <p>Dragones</p>
                            </div>
                            <div>
                                <p>Velocidad</p>
                                <p>Normal</p>
                            </div>
                            <div>
                                <p>Edad</p>
                                <p>98 años</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button class="login" style="border: 1px solid white" data-avatar="Demon" data-nombre="Fera">
                                <div class="progress-container">
                                    <div class="progress-bar"></div>
                                    <span class="progress-text">Cargando... 0%</span>
                                </div>
                                <span class="button-text" style="display: none;">Entrar al Juego</span>                            
                            </button>
                            <div class="loading-messages" style="display: none; font-style: italic; color: #ccc;">
                                <span>Dándole de comer a los dragones...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="arrows">
                <button id="prev">&lt;</button>
                <button id="next">&gt;</button>
                <button id="back">Volver a todos&#8599;</button>
            </div>
        </div>
        
       
    </div> <!-- intro -->

<!-- Partes de la interfaz -->
    <div class="marcoAvatar" style="right: -390px;">
        <div class="jugador">
            <img src="/media/img/avatar/conMarco/Demon.gif">
        </div>
        <div class="nombreUsuario">
            <span class="player-name-display">Hansik</span>, niv. <span class="nivel-actual">1</span>
        </div>
    </div>
    
    <div class="marcoMinimapa" style="transform: translateX(-440px);"></div>
    <canvas class="minimap nomovil" style="transform: translateX(-425px);"></canvas>
    <div class="logros" style="transform: translateX(-1000px);">
        <div class="tituloLogros">LOGROS</div>
        <h1 class="logroAndar">Aprendiendo a moverse</h1>
        <h1 class="logroMusica">Abre el Portal de la Música</h1>
        <h1 class="logroRelatos">Abre el Portal de los Relatos Cortos</h1>
        <h1 class="logroLibros">Abre el Portal de los Libros</h1>
    </div>

    <div class="wrapperHabilidades" style="transform: translateY(500px);">
        <div class="listonhabilidades nomovil">
            <img src="/media/img/iconoshabilidades/maderahabilidades.png">
        </div>
        <div class="habilidades">
            <div class="habilidad habilidadteletransporte">
                <img src="/media/img/iconoshabilidades/teletransporte.png" title="Teletransporte al centro del pueblo">
                <div class="numerohabilidad">1</div>
            </div>
            <div class="habilidad habilidadcorrer">
                <div class="tiempocorrer"></div>
                <img src="/media/img/iconoshabilidades/run.png" title="Aumentar la velocidad durante 3 segundos">
                <div class="numerohabilidad">2</div>
            </div>
            <div class="habilidad habilidadlibros" style="display: none;" title="Teletransporte a la isla de los libros">
                <img src="/media/img/iconoshabilidades/libros.png">
                <div class="numerohabilidad">3</div>
            </div>
            <div class="habilidad habilidadrelatos" style="display: none;" title="Teletransporte a la isla de los relatos cortos">
                <img src="/media/img/iconoshabilidades/relatos.png">
                <div class="numerohabilidad">4</div>
            </div>
            <div class="habilidad habilidadmusica" style="display: none;" title="Teletransporte a la isla de la música">
                <img src="/media/img/iconoshabilidades/musica.png">
                <div class="numerohabilidad">5</div>
            </div>
        </div>
    </div>

<!-- Fin Partes de la interfaz -->

<!-- Botón y ventana de CHAT -->

<div id="chat-container">
    <p style="color: white"><b>Chatea con otros jugadores de JosicoVila.es</b></p>
    <div id="chat-box"></div>
    <input type="text" id="chat-input" placeholder="Escribe tu mensaje...">
    <button id="send-btn">Enviar</button>
</div>
<div id="chat-button">
    <div class="nomovil" style="color: white">CHAT </div>
    <img src="/media/img/chat.png" id="toggle-chat" style="width: 50px; height: auto; cursor: pointer;" alt="chat de JosicoVila.es" title="chat de JosicoVila.es">
    
    <!-- Enlace al Blog -->
    <a href="/" title="Ir al Blog y página principal" style="margin-left: 15px; display: inline-flex; align-items: center; text-decoration: none; color: white;">
        <div class="nomovil" style="margin-right: 5px;">BLOG</div>
        <img src="/media/img/home-icon.png" alt="Ir al Blog" style="width: 45px; height: auto; cursor: pointer;"> <?php // Cambia '/media/img/home-icon.png' y el tamaño si es necesario ?>
    </a>
</div>

<!-- FIN CHAT -->

<!-- MÓDULO EXPERIENCE-->
<div id="level-info">
    <!-- <div><span style="font-size: 20px;">Niv.</span id="level-number">0</div> -->
    <div id="level-xp">
        <div id="xp-bar"></div>
    </div>
    <div id="level-envelope">
    <img src="/media/img/envelope.png" id="envelope" class="jello-horizontal">
    </div>        
</div>

<div id="scroll">
    <div id="scroll-info">
        <div class="color-carmesi" style="font-size: 30px; text-align: center; margin-top: 20px;" id="scroll-title">¡¡¡Felicidades por llegar al nivel 1!!!</div>
        <div class="color-carmesi" style="font-size: 20px; text-align: left; margin-top: 20px;" id="scroll-text">Muchas gracias por jugar en JosicoVila.es, ánimo sigue descubriendo todo lo que ofrece este mini mundo.</div>
        <div id="scroll-close" style="text-align: center; margin-top: 20px;">
            <button id="scroll-button">Cerrar</button>
        </div>
    </div>
</div>
<!-- FIN MÓDULO EXPERIENCE-->
<!-- JUGADORES ONLINE -->
<div id="container">
    <div id="info">
    <div>Jugadores online </div><div id="players"></div>
    </div>
    
</div>
<!-- FIN JUGADORES ONLINE -->

<!-- INDICADOR DIA/NOCHE -->
<!-- Contenedor para el arco (opcional, ayuda a posicionar) -->
<div id="time-arc-container"> 
    <img id="time-arc-icon" src="/media/img/ui/sun-icon.png" alt="Time"> <!-- Icono que se moverá -->
    <!-- En algún lugar visible de tu body -->
    <div id="player-count" style="position: absolute; bottom: 0px; left: 50%;transform: translateX(-50%); color: black; font-size: 15px; font-weight: bold; z-index: 100; width: 100%; text-align: center; background-color: rgba(255,255,255, 0.5); border-radius: 20px;">Jugadores: 1</div>

</div>
<!-- FIN INDICADOR DIA/NOCHE -->

<!-- Mensaje de Advertencia para Múltiples Conexiones -->
<div id="multiple-connections-warning" style="z-index: -1;opacity: 0;display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); color: white; z-index: 99999; justify-content: center; align-items: center; text-align: center; font-size: 24px; padding: 20px;">
    Ya tienes una sesión activa de JosicoVila.es abierta en otra pestaña de este navegador.<br><br>
    Por favor, cierra esta pestaña y vuelve a la anterior. Utiliza otro navegador para tener multiples sesiones abiertas.<br><br><br>
    Muchas gracias,<br>
    JosicoVila.es<br>
</div>
<!-- FIN Mensaje de Advertencia para Múltiples Conexiones -->


    <script type="x-shader/x-vertex" id="vertexshader">

    
    </script>

    <script type="x-shader/x-fragment" id="fragmentshader">

    
    </script>    
    
    
</body>
</html>