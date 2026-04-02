<?php
include_once "ballads.estructura-datos.php";

if($_POST['disco'] < count($ballads)){
for($x = 0; $x<count($ballads['canciones']); $x++){
?>
<div class="itemCancion">
    <div class="loaded"></div><h2><?php echo $ballads['canciones'][$x]['nombre'] ?><div class="tiempoCancion"><div class="tiempos"></div></div></h2>
    <div class="progresoCancion">
        <div class="progress">&nbsp;</div>
    </div>
    <?php echo $ballads['canciones'][$x]['texto'] ?>
</div>
<?php
}
}
?>