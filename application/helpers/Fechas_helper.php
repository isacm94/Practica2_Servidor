<?php

/**
 * Cambia el formato de una fecha
 * @param Date $fecha Fecha a cambiar
 * @return Date Fecha cambiada
 */
function cambiaFormatoFecha($fecha){
    $date = date_create($fecha);
    
    return date_format($date, 'd/m/Y');
}

