<?php
include 'database.php';

$filteredResults = [];
$category = '';

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->execute([$category]);
    $filteredResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Фильтрация</title>
</head>
<body>
    <h1>Фильтрация</h1>
    <form action="filter.php" method="get">
        <input type="text" name="category" value="<?= htmlspecialchars($category) ?>" required>
        <input type="submit" value="Фильтровать">
    </form>

    <?php if (empty($filteredResults)): ?>
        <p>Таких товаров нет</p>
    <?php else: ?>
        <ul>
            <?php foreach ($filteredResults as $product): ?>
                <li>
                    Название: <?= htmlspecialchars($product['name']) ?>, 
                    Цена: <?= htmlspecialchars($product['price']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <br>
    <a href="catalog.php" class="aa">Назад</a>
</body>
</html>