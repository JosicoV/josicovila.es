    <div class="relatos">
        <div class="wrapperCarrusel jv-stories-shell">
            <div class="jv-stories-header">
                <div class="jv-stories-header__eyebrow">Portal de los Relatos Cortos</div>
                <h1>Relatos</h1>
                <p>
                    Un santuario de historias breves para escuchar, leer y guardar. Cada portal mantiene su
                    video de presentacion, su experiencia online completa y un acceso destacado a la version PDF.
                </p>
            </div>
            <div class="carrusel backdrop-blur jv-stories-carousel">
                <div class="grande">
                    <?php
                    include_once __DIR__ . '/includes/relatos.estructura-datos.php';

                    for($i=0;$i<count($relatos);$i++){
                    ?>

                    <article class="item jv-story-card">
                        <div class="info1 jv-story-card__copy">
                            <div class="jv-story-card__cover-wrap">
                                <img src="/RELATOS/relatos/portadas/<?php echo $relatos[$i]['imagen'];?>" alt="Relato Corto <?php echo $relatos[$i]['nombre'];?>" class="img jv-story-card__cover" />
                            </div>
                            <div class="jv-story-card__meta">
                                <div class="jv-story-card__eyebrow">Relato corto <?php echo str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT); ?></div>
                                <h2><?php echo $relatos[$i]['nombre'];?></h2>
                                <p><?php echo $relatos[$i]['descripcion'];?></p>

                                <div class="jv-story-card__actions">
                                    <a class="jv-story-card__action jv-story-card__action--online" onclick="abreRelato('<?php echo $relatos[$i]['nombrejs'];?>')">Escuchar y leer</a>
                                    <a class="jv-story-card__action jv-story-card__action--pdf" href="/RELATOS/relatos/pdf/<?php echo $relatos[$i]['pdf'];?>" target="_blank" rel="noopener">Version PDF</a>
                                </div>
                            </div>
                        </div>
                        <div class="info2 jv-story-card__media">
                            <div class="jv-story-card__video-shell">
                                <div class="jv-story-card__video-label">Presentacion</div>
                            <video src="/RELATOS/relatos/videos/<?php echo $relatos[$i]['video'];?>" playsinline preload controls></video>
                            </div>
                        </div>
                    </article>
                    
                    <?php
                    }
                    ?>

                </div>
                <div class="control jv-stories-control">
                    <div class="jv-stories-control__hint">Desliza entre historias y abre la que te llame.</div>
                    <div class="controlesRelatos">
                        <img class="playRelatos" src="/RELATOS/img/play.png">&nbsp;&nbsp;
                        <img class="pauseRelatos" src="/RELATOS/img/pause.png">
                    </div>
                    <ul class="puntos">
                        <li class="punto activo"></li>
                        <?php
                        for($j=0;$j<count($relatos)-1;$j++){
                        ?>
                        <li class="punto"></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
 
    <div class="wrapperRelato" id="wrapperRelato"></div>

