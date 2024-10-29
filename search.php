<?php
include 'database.php';

$searchResults = [];
$searchTerm = '';

if (isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ?");
    $stmt->execute(["%$searchTerm%"]);
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Поиск</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Поиск</h1>
    <form action="search.php" method="get">
        <input type="text" name="searchTerm" value="<?= htmlspecialchars($searchTerm) ?>" required>
        <input type="submit" value="Поиск">
    </form>
    <?php if (empty($searchResults)): ?>
        <p>Таких товаров нет</p>
    <?php else: ?>
        <ul>
            <?php foreach ($searchResults as $product): ?>
                <li>
                    Название: <?= htmlspecialchars($product['name']) ?>, 
                    Категория: <?= htmlspecialchars($product['category']) ?>, 
                    Цена: <?= htmlspecialchars($product['price']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <br>
    <a href="catalog.php" class="aa">Назад </a>
</body>
</html>