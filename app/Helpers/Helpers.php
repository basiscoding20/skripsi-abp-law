<?php

if (! function_exists('moneyFormat')) {    
    function moneyFormat($str) {
        return 'Rp' . number_format($str, '0', '', '.');
    }
}

if (! function_exists('setShow')) {         
    function setShow($path, $active = 'active pcoded-trigger') {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }
}

if (! function_exists('setActive')) {         
    function setActive($path, $active = 'active') {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }
}

