<?php

function debug($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// comprobar si se ha iniciado sesion
function isStartSession() : void {
    if(!isset($_SESSION)) {
        session_start();
    }
}