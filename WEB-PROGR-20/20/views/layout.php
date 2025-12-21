<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Головна' ?></title>
    <style>
        body { font-family: Arial; margin: 20px; }
        nav a { margin-right: 10px; }
        hr { margin: 15px 0; }
    </style>
</head>
<body>

<nav>
    <a href="/">Головна</a>

    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/categories">Категорії</a>
        <a href="/materials">Матеріали</a>
        <a href="/suppliers">Постачальники</a>
        <a href="/logout">Вийти</a>
    <?php else: ?>
        <a href="/login">Вхід</a>
        <a href="/register">Реєстрація</a>
    <?php endif; ?>
</nav>

<hr>

<?php
if (isset($template)) {
    include 'views/' . $template;
}
?>

</body>
</html>
