    <div class="libros">
        <div class="wrapperCarrusel jv-books-shell">
            <div class="jv-books-header">
                <div class="jv-books-header__eyebrow">Portal de los Libros</div>
                <h1>Libros</h1>
                <p>
                    Una biblioteca suspendida entre portales. Cada libro conserva su video de presentacion,
                    una portada protagonista y una atmosfera propia para invitar a entrar en su mundo.
                </p>
            </div>
            <div class="carrusel backdrop-blur jv-books-carousel">
                <div class="grandeLibros">
                    <?php
                    include_once __DIR__ . '/includes/libros.estructura-datos.php';

                    for($i=0;$i<count($libros);$i++){
                    ?>

                    <article class="itemLibros jv-book-card">
                        <div class="info1 jv-book-card__copy" style="background: url('/LIBROS/img/<?php echo $libros[$i]['fondo'] ?>') center center no-repeat; background-size: contain">
                            <div class="jv-book-card__cover-wrap">
                                <img src="/LIBROS/libros/<?php echo $libros[$i]['imagen'];?>" alt="Libro: <?php echo $libros[$i]['nombre'];?>" class="img jv-book-card__cover" />
                            </div>
                            <div class="info1Texto jv-book-card__meta">
                                <div class="jv-book-card__eyebrow">Libro <?php echo str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT); ?></div>
                                <h2><?php echo $libros[$i]['nombre'];?></h2>
                                <p><?php echo $libros[$i]['descripcion'];?></p>

                                <div class="jv-book-card__badge">Edicion destacada</div>
                            </div>
                        </div>
                        <div class="info2 jv-book-card__media">
                            <div class="jv-book-card__video-shell">
                                <div class="jv-book-card__video-label">Book trailer</div>
                                <iframe class="video" width="560" height="315" src="<?php echo $libros[$i]['video']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </article>
                    
                    <?php
                    }
                    ?>

                </div>
                <div class="control jv-books-control">
                    <div class="jv-books-control__hint">Explora cada universo y deja que la portada te guie.</div>
                    <div class="controlesLibros">
                        <img class="playLibros" src="/RELATOS/img/play.png">&nbsp;&nbsp;
                        <img class="pauseLibros" src="/RELATOS/img/pause.png">
                    </div>
                    <ul class="puntos">
                        <li class="puntoLibros activo"></li>
                        <?php
                        for($j=0;$j<count($libros)-1;$j++){
                        ?>
                        <li class="puntoLibros"></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
 
    <div class="wrapperRelato" id="wrapperRelato"></div>

