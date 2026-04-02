    <div class="libros">
        <div class="wrapperCarrusel">
        <h1>Libros</h1>
            <div class="carrusel backdrop-blur">
                <div class="grandeLibros">
                    <?php
                    include_once __DIR__ . '/includes/libros.estructura-datos.php';

                    for($i=0;$i<count($libros);$i++){
                    ?>

                    <div class="itemLibros">
                        <div class="info1" style="background: url('/LIBROS/img/<?php echo $libros[$i]['fondo'] ?>') center center no-repeat; background-size: contain">
                            <img src="/LIBROS/libros/<?php echo $libros[$i]['imagen'];?>" alt="Libro: <?php echo $libros[$i]['nombre'];?>" class="img" />
                            <div class="info1Texto">
                                <h2><?php echo $libros[$i]['nombre'];?></h2>
                                <p><?php echo $libros[$i]['descripcion'];?></p>
                            
                            </div>
                        </div>
                        <div class="info2">
                        <iframe class="video" width="560" height="315" src="<?php echo $libros[$i]['video']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <img src="">
                        </div>
                    </div>
                    
                    <?php
                    }
                    ?>

                </div>
                <div class="control">    
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

