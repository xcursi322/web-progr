<h1>Категорія: <?= $category->columns->title ?></h1>

<h2>Матеріали категорії</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Назва</th>
</tr>

<?php foreach ($category->materials() as $material): ?>
<tr>
    <td><?= $material->columns->id ?></td>
    <td><?= $material->columns->title ?></td>
</tr>
<?php endforeach; ?>
</table>
