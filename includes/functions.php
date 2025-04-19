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
function isStartedSession() : void {
    if(!isset($_SESSION)) {
        session_start();
    }
}
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function currentPage($path) : bool {
    return str_contains($_SERVER['PATH_INFO'], $path) ? true : false;
}