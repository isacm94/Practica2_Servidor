<?php

function CreaSelect($datos, $name){
    
    $CI = get_instance();
    $CI->load->library('cart');
    
    $datos = CreaArrayParaSelect($datos);
    $html = '<select class="country_to_state country_select" id="billing_country" name="'.$name.'">';
    
    foreach ($datos as $idx => $texto) {
        $html.= "<option value='$idx' ".  set_select($name, $idx)." >$texto</option>";
    }
        
    $html.= '</select>';
    
    return $html;
}

function CreaArrayParaSelect($array){
    $nuevoArray = array();
    
    foreach ($array as $key => $value) {
        $nuevoArray[$value['cod']] = $value['nombre'];
    }
    
    return $nuevoArray;
}
