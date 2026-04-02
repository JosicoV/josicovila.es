<?php
include_once "cinematics.estructura-datos.php";

if($_POST['disco'] < count($cinematics)){
for($x = 0; $x<count($cinematics['canciones']); $x++){
?>
<div class="itemCancion">
    <div class="loaded"></div><h2><?php echo $cinematics['canciones'][$x]['nombre'] ?><div class="tiempoCancion"><div class="tiempos"></div></div></h2>
    <div class="progresoCancion">
        <div class="progress">&nbsp;</div>
    </div>
    <?php echo $cinematics['canciones'][$x]['texto'] ?>
</div>
<?php
}
}
?>