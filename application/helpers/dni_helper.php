<?php
/*
 * HELPER que contiene una función para validar el DNI.
 */

/**
 * Devuelve la letra que le corresponde a un DNI.
 * @param string $dni Números del DNI.
 */
function dni_LetraNIF($dni)
{
	return mb_substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($dni, 0, 8) % 23, 1);
}

