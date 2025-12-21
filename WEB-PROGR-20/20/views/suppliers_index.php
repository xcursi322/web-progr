<h1>Постачальники</h1>

<a href="/suppliers/create">Додати постачальника</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Назва</th>
        <th>Телефон</th>
        <th>Email</th>
        <th>Дія</th>
    </tr>

    <?php foreach ($suppliers as $supplier): ?>
        <tr>
            <td><?= $supplier->columns->id ?></td>
            <td><?= htmlspecialchars($supplier->columns->name) ?></td>
            <td><?= htmlspecialchars($supplier->columns->phone) ?></td>
            <td><?= htmlspecialchars($supplier->columns->email) ?></td>
            <td>
                <a href="/suppliers/<?= $supplier->columns->id ?>/show">Переглянути</a>
                <a href="/suppliers/<?= $supplier->columns->id ?>/edit">Редагувати</a>
                <a href="/suppliers/<?= $supplier->columns->id ?>/delete"
                   onclick="return confirm('Видалити постачальника?')">Видалити</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
