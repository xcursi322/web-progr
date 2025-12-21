<h1>Редагувати постачальника</h1>

<form method="post" action="/suppliers/<?= $supplier->columns->id ?>/update">
    <div>
        Назва:<br>
        <input type="text" name="name" value="<?= htmlspecialchars($supplier->columns->name) ?>" required>
    </div>

    <div>
        Телефон:<br>
        <input type="text" name="phone" value="<?= htmlspecialchars($supplier->columns->phone) ?>">
    </div>

    <div>
        Email:<br>
        <input type="email" name="email" value="<?= htmlspecialchars($supplier->columns->email) ?>">
    </div>

    <button type="submit">Зберегти</button>
    <a href="/suppliers">← Назад</a> <!-- кнопка назад -->
</form>
