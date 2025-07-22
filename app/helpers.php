<?php

if (!function_exists('csrf_token')) {
    function csrf_token()
    {
        $session = app('session');

        if (!$session->has('_token')) {
            $session->put('_token', bin2hex(random_bytes(32)));
        }
        return $session->get('_token');
    }
}

