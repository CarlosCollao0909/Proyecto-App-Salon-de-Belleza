<?php

function connectDB() {
    $db = new mysqli('localhost', 'root', 'root', 'appsalon_mvc');
    if (!$db) {
        echo "Error no se pudo conectar";
        exit;
    }
    return $db;
}
