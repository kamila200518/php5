<?php
include 'database.php';

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Каталог</title>
</head>
<body>
    <h1>Каталог</h1>
    <?php if (empty($products)): ?>
        <p>Нет товаров</p>
    <?php else: ?>
        <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    Название: <?= htmlspecialchars($product['name']) ?>, 
                    Категория: <?= htmlspecialchars($product['category']) ?>, 
                    Цена: <?= htmlspecialchars($product['price']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <a href="add.php" class="a">Добавить </a> 
    <a href="search.php" class="a">Поиск </a> 
    <a href="filter.php" class="a">Фильтрация</a>
</body>
</html>

<style>
    .a{
        color:black;
        text-decoration: none;
    }
</style>