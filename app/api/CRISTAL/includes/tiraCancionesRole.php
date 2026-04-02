<?php
include_once "roles.estructura-datos.php";

if($_POST['disco'] < count($roles)){
for($x = 0; $x<count($roles['canciones']); $x++){
?>
<div class="itemCancion">
    <div class="loaded"></div><h2><?php echo $roles['canciones'][$x]['nombre'] ?><div class="tiempoCancion"><div class="tiempos"></div></div></h2>
    <div class="progresoCancion">
        <div class="progress">&nbsp;</div>
    </div>
    <?php echo $roles['canciones'][$x]['texto'] ?>
</div>
<?php
}
}
?>