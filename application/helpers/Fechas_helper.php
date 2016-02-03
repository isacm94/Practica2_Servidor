<?php

function cambiaFormatoFecha($fecha){
    $date = date_create($fecha);
    
    return date_format($date, 'd/m/Y');
}

