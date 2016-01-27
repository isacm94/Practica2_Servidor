<?php
/**
 * Devuelve la letra que le corresponde al NIF a un DNI
 * @param string $dni
 */
function dni_LetraNIF($dni)
{
	return mb_substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($dni, 0, 8) % 23, 1);
}

function claves_check($clave, $clave_rep) {
        
       if($clave == $clave_rep)
       {
           return TRUE;
       }
       else{
           return FALSE;
       }
    }