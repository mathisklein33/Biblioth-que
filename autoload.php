<?php

declare(strict_types=1);

spl_autoload_register(function ($classe) {
    // Ex: App\Livre → src/App/Livre.php
    $path = __DIR__ . '/src/' . str_replace('\\', '/', $classe) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});


