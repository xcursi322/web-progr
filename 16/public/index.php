<?php
session_start();
require_once "../core/connection.php";
require_once "../models/Material.php";

$userId = $_SESSION["user_id"] ?? null;
$username = $_SESSION["user"] ?? null;
?>

<?php if ($userId && $username): ?>

    <h2>Привіт, <?= htmlspecialchars($username) ?></h2>
    <a href="logout.php">Вийти</a> | 
    <a href="create.php">Додати матеріал</a>

    <h3>Ваші матеріали</h3>

    <?php
    $materials = Material::all(
        $pdo,
        "materials",
        "WHERE user_id = ?",
        [$userId]
    );
    ?>

    <?php if (count($materials) > 0): ?>
        <table border="1">
            <tr>
                <th>Назва</th>
                <th>Категорія</th>
                <th>Ціна</th>
                <th>Кількість</th>
                <th>Дії</th>
            </tr>

            <?php foreach ($materials as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m->columns->name) ?></td>
                <td><?= htmlspecialchars($m->columns->category) ?></td>
                <td><?= htmlspecialchars($m->columns->price) ?></td>
                <td><?= htmlspecialchars($m->columns->quantity) ?></td>
                <td>
                    <a href="edit.php?id=<?= $m->columns->id ?>">Редагувати</a> |
                    <a href="delete.php?id=<?= $m->columns->id ?>">Видалити</a>
                </td>
            </tr>
            <?php endforeach; ?>

        </table>
    <?php else: ?>
        <p>У вас ще немає доданих матеріалів.</p>
    <?php endif; ?>

<?php else: ?>

    <h2>Ви не авторизовані</h2>
    <a href="login.php">Увійти</a> |
    <a href="register.php">Реєстрація</a>

<?php endif; ?>
