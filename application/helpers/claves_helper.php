<?php

function claves_check($clave, $clave_rep) {
        
       if($clave == $clave_rep)
       {
           return TRUE;
       }
       else{
           return FALSE;
       }
    }