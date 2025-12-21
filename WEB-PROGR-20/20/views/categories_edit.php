<h1>Редагувати категорію</h1>

<form method="post" action="/categories/<?= $category->columns->id ?>/update">
    Назва: 
    <input type="text" name="title" value="<?= htmlspecialchars($category->columns->title) ?>" required>
    <button type="submit">Зберегти</button>
</form>

<a href="/categories">← Назад до списку</a>
