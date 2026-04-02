    <div class="relatos">
        <div class="wrapperCarrusel">
        <h1>Relatos</h1>
            <div class="carrusel backdrop-blur">
                <div class="grande">
                    <?php
                    include_once __DIR__ . '/includes/relatos.estructura-datos.php';

                    for($i=0;$i<count($relatos);$i++){
                    ?>

                    <div class="item">
                        <div class="info1">
                            <img src="/RELATOS/relatos/portadas/<?php echo $relatos[$i]['imagen'];?>" alt="Relato Corto <?php echo $relatos[$i]['nombre'];?>" class="img" />
                            <div>
                                <h2><?php echo $relatos[$i]['nombre'];?></h2>
                                <p><?php echo $relatos[$i]['descripcion'];?></p>
                            
                                <h2><a onclick="abreRelato('<?php echo $relatos[$i]['nombrejs'];?>')">ONLINE</a> / <a href="/RELATOS/relatos/pdf/<?php echo $relatos[$i]['pdf'];?>" target="_blank">PDF</a></h2>
                            </div>
                        </div>
                        <div class="info2">
                            <video src="/RELATOS/relatos/videos/<?php echo $relatos[$i]['video'];?>" playsinline preload controls></video>
                            <img src="">
                        </div>
                    </div>
                    
                    <?php
                    }
                    ?>

                </div>
                <div class="control">    
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

