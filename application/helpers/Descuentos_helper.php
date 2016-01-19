<?php

function MostrarDescuento($precio, $descuento) {
    if ($descuento != '0.00') {
        echo "<ins>". $precio *(1 - ($descuento/100)) ." €</ins>";
        echo "<del>$precio €</del>";
    } else { //No tiene descuento, solo se meustra el precio
        echo "<ins>$precio €</ins>";
    }
}
