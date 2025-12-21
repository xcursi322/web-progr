<h1>Будівельні матеріали</h1>

<table border="1">
<tr>
    <th>ID</th>
    <th>Назва</th>
    <th>Категорія</th>
    <th>Постачальник</th>
    <th>Ціна</th>
    <th>Одиниця</th>
    <th>Дія</th>
</tr>

<?php foreach ($materials as $material): ?>
<tr>
    <td><?= $material->columns->id ?></td>
    <td><?= htmlspecialchars($material->columns->name) ?></td>
    <td><?= htmlspecialchars($material->category()->columns->title ?? '') ?></td>
    <td><?= htmlspecialchars($material->belongsTo('Supplier', 'supplier_id')->columns->name ?? '') ?></td>
    <td><?= htmlspecialchars($material->columns->price ?? '') ?></td>
    <td><?= htmlspecialchars($material->columns->unit ?? '') ?></td>
    <td>
        <a href="/materials/<?= $material->columns->id ?>/show">Переглянути</a>
        <a href="/materials/<?= $material->columns->id ?>/edit">Редагувати</a>
        <a href="/materials/<?= $material->columns->id ?>/delete" onclick="return confirm('Видалити матеріал?')">Видалити</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<a href="/materials/create">Додати матеріал</a>
