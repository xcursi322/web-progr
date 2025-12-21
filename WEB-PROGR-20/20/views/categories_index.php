<h1>Категорії матеріалів</h1>

<a href="/categories/create">Додати категорію</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Назва</th>
        <th>Дія</th>
    </tr>

    <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= $category->columns->id ?></td>
            <td><?= htmlspecialchars($category->columns->title) ?></td>
            <td>
                <a href="/categories/<?= $category->columns->id ?>/edit">Редагувати</a>
                <a href="/categories/<?= $category->columns->id ?>/delete"
                   onclick="return confirm('Видалити категорію?')">Видалити</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
