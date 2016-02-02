<?php
/**
 * HELPER que contiene una función que evalua si dos claves son iguales
 */

/**
 * Función que devuelve si dos claves son iguales.
 * @param string $clave Primera clave.
 * @param string $clave_rep Segunda clave.
 * @return boolean
 */
function claves_check($clave, $clave_rep) {
        
       if($clave == $clave_rep)
       {
           return TRUE;
       }
       else{
           return FALSE;
       }
    }