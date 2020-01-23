<?php 
    define('DB_NAME', 'crud_php'); //Nome do banco de dados
    define('DB_USER', 'root'); //Usuario do banco MySQL
    define('DB_PASSWORD', ''); //Senha do banco:
    define('DB_HOST', 'localhost'); //Nome do host:

    if(!defined('ABSPATH')) //caminho absoluto para a pasta do sistema
        define('ABSPATH', dirname(__FILE__) . '/');

    if(!defined('BASEURL')) //caminho no server para o sistema
        define('BASEURL', '/crud-php/');
    
    if(!defined('DBAPI')) //caminho da conexao com o banco
        define('DBAPI', ABSPATH . 'inc/database.php');
    
    // caminhos dos templates de header e footer
    define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
    define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');
?>