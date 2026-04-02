<?php
include_once "musica.estructura-datos.php";

if($_POST['disco'] < count($disco)){
for($x = 0; $x<count($disco[$_POST['disco']]['canciones']); $x++){
?>
<div class="itemCancion">
    <div class="loaded"></div><h2><?php echo $disco[$_POST['disco']]['canciones'][$x]['nombre'] ?><div class="tiempoCancion"><div class="tiempos"></div></div></h2>
    <div class="progresoCancion">
        <div class="progress">&nbsp;</div>
    </div>
    <?php echo $disco[$_POST['disco']]['canciones'][$x]['texto'] ?>
</div>
<?php
}
}
?>