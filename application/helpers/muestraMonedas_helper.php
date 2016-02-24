<?php

function MuestraMonedas() {
    $fecha = date('d-m-Y');

    $nombreFichero = "././assets/monedas/" . $fecha . "monedas.xml";

    if (file_exists($nombreFichero)) {
        $XML = simplexml_load_file($nombreFichero);
    } else {
        $contenido = file_get_contents("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");

        file_put_contents($nombreFichero, $contenido); //Guarda el fichero xml en el equipo

        $XML = simplexml_load_file($nombreFichero);
    }

    $html= '<li class = "dropdown">';
    $html.= '<div class = "footer-about-us" style="float: rigth;">';
    $html.= '<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" title = "Cambiar moneda"><span class = "glyphicon glyphicon-euro"></span> <b class = "caret"></b></a>';
    $html.= '<ul class = "dropdown-menu">';
    
    foreach ($XML->Cube->Cube->Cube as $rate) {
        $html.='<li><a href = "#">'.$rate['currency'].'</a></li>';
    }   
    
    $html.='</ul>';
    $html.='</div>';
    $html.='</li>';
    
    return $html;
}
