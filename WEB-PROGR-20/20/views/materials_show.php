<h1>Матеріал: <?= htmlspecialchars($material->columns->name) ?></h1>

<p><b>Категорія:</b> <?= htmlspecialchars($material->category()->columns->title ?? '') ?></p>
<p><b>Постачальник:</b> <?= htmlspecialchars($material->belongsTo('Supplier', 'supplier_id')->columns->name ?? '') ?></p>
<p><b>Ціна:</b> <?= htmlspecialchars($material->columns->price ?? '') ?></p>
<p><b>Одиниця виміру:</b> <?= htmlspecialchars($material->columns->unit ?? '') ?></p>

<a href="/materials">← Назад до списку</a>
<a href="/materials/<?= $material->columns->id ?>/edit">Редагувати</a>
<a href="/materials/<?= $material->columns->id ?>/delete" onclick="return confirm('Видалити матеріал?')">Видалити</a>
