<?php

/**
 * Fichier de configuration contenant les variables d'environnement à adapter lors de l'installation
 */

return array(
    'dev_env' => true,
    'database' => array(
        'dsn' => 'mysql',
        'host' => 'localhost',
        'port' => '3308',
        'name' => 'php_ecommerce',
        'user' => 'root',
        'pwd' => ''
    ),
    'defaultOrder' => 'nomArticle'
);

?>