<?php



spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/src/';

    // Vérifie si la classe commence par "App\"
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    // Supprime "App\" du nom de la classe
    $relativeClass = substr($class, strlen($prefix));

    // Convertit le namespace en chemin
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
