<?php

function SesionIniciadaCheck() {

    $CI = get_instance();
    if ($CI->session->userdata('logged_in')) {
        return TRUE;
    } else {
        return FALSE;
    }
}
