<?php

function connectDB() {
    $db = new mysqli('localhost', 'root', 'root', 'appsalon_refactor');
    if (!$db) {
        echo "Error no se pudo conectar";
        exit;
    }
    return $db;
}
