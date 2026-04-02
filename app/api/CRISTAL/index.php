<?php
    include_once __DIR__ . '/includes/musica.estructura-datos.php';
?>
    
    <div class="sceneMusica">
        <canvas></canvas>
        <div class="audio">
        </div>
    </div>
    <section>
        <div class="wrapperFirma">
            <img class="firma" src="/CRISTAL/media/img/firma-transparente.png" alt="Josico Vila logo" title="Josico Vila logo">
        </div>
        <div class="loop">
            <img class="repeatIcon" src="/CRISTAL/media/img/repeat.png" alt="Repeat selection" title="Repeat selection">
            <div class="radio">
                <input type="radio" class="repeat" name="repeat" value="song"><label>Canción actual</label>
            </div>
            <div class="radio">
                <input type="radio" class="repeat" name="repeat" value="album"><label>Álbum actual</label>
            </div>
            <div class="radio">
                <input type="radio" class="repeat" name="repeat" value="all" checked><label>Todos los álbumes</label>
            </div>
        </div>

        <div class="randomize">
            <img src="/CRISTAL/media/img/random.png" class="randomIcon" alt="Random selection" title="Random selection">
            <div class="radio">
                <input type="radio" class="repeat" name="repeat" value="randAlbum"><label>Álbum actual</label>
            </div>
            <div class="radio">
                <input type="radio" class="repeat" name="repeat" value="randAll"><label>Todos los álbumes</label>
            </div>
        </div>

        <div class="volumeRange">
            <img src="/CRISTAL/media/img/volume.png" class="volumeIcon" alt="Volume range slider" title="Volume range slider">
            <div class="range">
                <input type="range" class="volume" name="volume" value="100" max="100" min="0">
            </div>
        </div>
        
        <div id="wrapperInfo">
            
            <div id="info">
                <div id="nombreInfo">
                    <h1>José "Josico" Vila Villa-Ceballos</h1>
                </div>
                <div class="textoInfo">
                Un compositor español que ha aprendido por su cuenta todo lo que sabe sobre música.<br><br>
                Ama los ordenadores por todo el potencial que tienen. Y le gusta, a parte de componer música con ellos, diseñar y programar sus propias páginas web y atender sus redes sociales.<br><br>
                Ha escrito cuatro libros y trece relatos cortos. Estos últimos pueden ser leidos en esta misma página web.<br><br>
                Empezó a escribir libros, relatos cortos y a componer música en 2018.
                </div>
            </div>

            <div id="fotoInfo">
                <img src="/CRISTAL/media/img/defrente.png" alt="Josico Vila" title="Josico Vila">
            </div>
        </div>

        <div class="controles">
            <div class="album">
                <div class="anteriorAlbum"><img src="/CRISTAL/media/img/rewind.png" class="anteriorDisco encendido" alt="Anterior álbum" title="Anterior álbum"></div>
                <div class="wrapperNombreAlbum">
                    <div class="nombreAlbum">
                        <?php
                        for($i = 0; $i<count($disco); $i++){
                        ?>
                        <div class="itemAlbum">
                            <h1><?php echo $disco[$i]['nombre'] ?></h1>
                            <?php echo $disco[$i]['texto'] ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="siguienteAlbum"><img src="/CRISTAL/media/img/forward.png" class="siguienteDisco" alt="Siguiente álbum" title="Siguiente álbum"></div>
            </div>
            <div class="cancion">
                <div class="anteriorCancion"><img src="/CRISTAL/media/img/rewind.png" class="anteriorTema encendido" alt="Anterior tema" title="Anterior tema"></div>
                <div class="wrapperNombreCancion">
                    <div class="nombreCancion">
                        <?php
                        for($x = 0; $x<count($disco[0]['canciones']); $x++){
                        ?>
                        <div class="itemCancion">
                            <div class="loaded"></div><h2><?php echo $disco[0]['canciones'][$x]['nombre'] ?><div class="tiempoCancion"><div class="tiempos"></div></div></h2>
                            <div class="progresoCancion">
                                <div class="progress">&nbsp;</div>
                            </div>
                            <?php echo $disco[0]['canciones'][$x]['texto'] ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="siguienteCancion"><img src="/CRISTAL/media/img/forward.png" class="siguienteTema" alt="Siguiente tema" title="Siguiente tema"></div>
            </div>
            <div class="plays">
                <div class="velocidad">
                    <img src="/CRISTAL/media/img/velocidadDoble.png" class="velocidadDoble" alt="Velocidad doble" title="Velocidad doble">
                    <img src="/CRISTAL/media/img/velocidadNormal.png" class="velocidadNormal" alt="Velocidad normal" title="Velocidad normal">
                    <img src="/CRISTAL/media/img/velocidadMitad.png" class="velocidadMitad" alt="Mitad de velocidad" title="Mitad de velocidad">
                </div>
                <div class="balladCinematic">
                    <img src="/CRISTAL/media/img/ballad.png" class="ballad" alt="Lista de baladas" title="Lista de baladas">
                    <img src="/CRISTAL/media/img/cinematic.png" class="cinematic" alt="Lista de temas cinematográficos" title="Lista de temas cinematográficos">
                </div>
                <div class="playPausa">
                    <img src="/CRISTAL/media/img/play.png" class="play" data-disco="0" data-cancion="0" alt="Botón de reproducción" title="Botón de reproducción">
                    <img src="/CRISTAL/media/img/pause.png" class="pause" alt="Botón de pausa" title="Botón de pausa">
                </div>
                <div class="roleWarlike">
                    <img src="/CRISTAL/media/img/role.png" class="role" alt="Lista de temas para escuchar junto a juegos de fantasía" title="Lista de temas para escuchar junto a juegos de fantasía">
                    <img src="/CRISTAL/media/img/warlike.png" class="warlike" alt="Lista de temas bélicos" title="Lista de temas bélicos">
                </div>
                <div class="estilo">
                    <img src="/CRISTAL/media/img/estiloSol.png" class="estiloSol" alt="Estilo sol" title="Estilo sol">
                    <img src="/CRISTAL/media/img/estiloDragon.png" class="estiloDragon" alt="Estilo dragón" title="Estilo dragon">
                    <img src="/CRISTAL/media/img/estiloLuna.png" class="estiloLuna" alt="Estilo luna" title="Estilo luna">
                </div>
            </div>
        </div>
    </section>
    

    
    
