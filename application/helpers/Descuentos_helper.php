<?php

/*
 * HELPER que contiene funciones relacionadas con el precio y el descuento
 */

/**
 * Función que muestra el precio y el descuento de una camiseta. 
 * Si tiene descuento aparece el precio tachado con la etiqueta <del> y el precio con el descuento sin tachar. 
 * @param float $precio
 * @param float $descuento
 */
function MostrarDescuento($precio, $descuento) {
    if ($descuento != '0.00') {
        echo "<ins>". $precio *(1 - ($descuento/100)) ." €</ins>";
        echo "<del>$precio €</del>";
    } else { //No tiene descuento, solo se meustra el precio
        echo "<ins>$precio €</ins>";
    }
}

/**
 * Función que te devuelve el precio final de una camiseta según su descuento.
 * @param float $precio Precio de la camiseta.
 * @param float $descuento Descuento que tiene la camiseta, sino tiene será 0.
 * @return float Precio final calculado.
 */
function getPrecioFinal($precio, $descuento){
    return $precio *(1 - ($descuento/100));
}
