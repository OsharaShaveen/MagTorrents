<?php
session_start();
require_once("application/functions/config.php");
if (!isset($_SESSION['passwordPanel']) OR $_SESSION['passwordPanel'] != PASSWORDPANEL OR $_SESSION['IPOrigin'] != $_SERVER['REMOTE_ADDR']):
    header("Location: administration");
endif;
?>
<!DOCTYPE html>
<html>
<head>
    <?= \gabrielcarvalhogama\MagTorrents\Inclusions\Head::get() ?>
    <title>MagTorrents - Dashboard</title>
</head>
<body>
<?= \gabrielcarvalhogama\MagTorrents\Inclusions\Navbar::get() ?>
<main>
    Estatísticas ou sla
</main>
</body>
</html>
