<?php

function autoload($className) {
    // Define os diretórios onde as classes podem estar
    $directories = [
        '../app/controllers/',  // Controllers
        '../app/models/',       // Models
        '../core/',             // Core (ex: Router)
    ];

    foreach ($directories as $directory) {
        // Verifica se o arquivo existe no diretório
        $file = $directory . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
}

// Registra o autoload
spl_autoload_register('autoload');
