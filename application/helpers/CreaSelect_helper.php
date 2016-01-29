<?php

function CreaSelect($datos, $name) {

    $datos = CreaArrayParaSelect($datos);
    $html = '<select class="country_to_state country_select" id="billing_country" name="' . $name . '">';

    foreach ($datos as $idx => $texto) {
        $html.= "<option value='$idx' " . set_select($name, $idx) . " >$texto</option>";
    }

    $html.= '</select>';

    return $html;
}

function CreaSelectMod($datos, $name, $opcSelected) {

    $datos = CreaArrayParaSelect($datos);
    $html = '<select class="country_to_state country_select" id="billing_country" name="' . $name . '">';

    foreach ($datos as $idx => $texto) {
        $html.= "<option value=$idx ";

        if ($idx == $opcSelected)//Si es igual a la provincia que tiene guardada, la seleccionamos
            $html.= "selected = selected";

        $html.= " >$texto</option>";
    }

    $html.= '</select>';

    return $html;
}

function CreaArrayParaSelect($array) {
    $nuevoArray = array();

    foreach ($array as $key => $value) {
        $nuevoArray[$value['cod']] = $value['nombre'];
    }

    return $nuevoArray;
}
