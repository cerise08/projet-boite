<?php
Session_start();
require_once 'header.php';
require_once 'db/mariadb.php';
?>
<?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 'home';
    }
    if (file_exists($page . '.php')) {
        require_once $page . '.php';
    } else {
        require_once 'error404.php';
    }
?>
<?php
require_once 'footer.php';
?>