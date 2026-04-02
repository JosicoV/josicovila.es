<?php
include_once 'musica.estructura-datos.php';

$nombreCancion = $_POST['nombreCancion'];

$encontrado = false;

for($i=0; $i<count($disco); $i++) {
    for($j=0; $j<count($disco[$i]['canciones']); $j++){
        if($disco[$i]['canciones'][$j]['nombre'] == $nombreCancion) echo $i;
    }
}
?>