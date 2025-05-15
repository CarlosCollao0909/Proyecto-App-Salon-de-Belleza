<?php

define('CARPETA_IMAGENES_COMPROBANTES', $_SERVER['DOCUMENT_ROOT'] . '/images/comprobantes/');
define('CARPETA_IMAGENES_QR', $_SERVER['DOCUMENT_ROOT'] . '/images/QR/');

function debug($variable): string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html): string {
    $s = htmlspecialchars($html);
    return $s;
}

// comprobar si se ha iniciado la global SESSION
function isStartedSession(): void {
    if (!isset($_SESSION)) {
        session_start();
    }
}

// comprobar si el usuario esta autenticado
function isAuth(): void {
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

// comprobar si el usuario es admin
function isAdmin(): void {
    if (!isset($_SESSION['admin'])) {
        header('Location: /cita');
    }
}

//validar los datos de las queries o de los parametros enviados por get
function validarRedireccionar($variable, $url): void {
    if (!$variable) {
        header("Location: $url");
        exit;
    }
}

// comprobar si se esta en la pagina actual para resaltar el menu
function currentPage($path): bool {
    return str_contains($_SERVER['PATH_INFO'], $path) ? true : false;
}
