<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title><?= $title ?></title>
</head>
<header>
    <?php !isset($_SESSION['currentUser']) ? include '../templates/nav/nav.php' : include '../templates/nav/nav_connected.php' ?>
</header>
<?= $body ?>
    <script src="/js/script.js"></script>    
</html>