<?php
include_once "warlikes.estructura-datos.php";

if($_POST['disco'] < count($warlikes)){
for($x = 0; $x<count($warlikes['canciones']); $x++){
?>
<div class="itemCancion">
    <div class="loaded"></div><h2><?php echo $warlikes['canciones'][$x]['nombre'] ?><div class="tiempoCancion"><div class="tiempos"></div></div></h2>
    <div class="progresoCancion">
        <div class="progress">&nbsp;</div>
    </div>
    <?php echo $warlikes['canciones'][$x]['texto'] ?>
</div>
<?php
}
}
?>