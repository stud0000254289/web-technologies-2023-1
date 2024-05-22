<?php
include '../db/ConnectDB.php';

function fetchMenuItems($parent_id = NULL) {
    global $conn;
    $items = [];
    $sql = "SELECT * FROM menu_items WHERE parent_id " . ($parent_id === NULL ? "IS NULL" : "= $parent_id") . " ORDER BY id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['items'] = fetchMenuItems($row['id']);
            $items[] = $row;
        }
    }
    return $items;
}

$menuItems = fetchMenuItems();
$conn->close();

function renderMenu($items) {
    foreach ($items as $item) {
        if (!empty($item['items'])) {
            echo <<<HTML
            <div class="list-item" data-parent>
                <div class="list-item__inner">
                    <img class="list-item__arrow" src="img/chevron-down.png" alt="chevron-down" data-open>
                    <img class="list-item__folder" src="img/folder.png" alt="folder">
                    <span>{$item['name']}</span>
                </div>
                <div class="list-item__items">
HTML;
            renderMenu($item['items']);
            echo <<<HTML
                </div>
            </div>
HTML;
        } else {
            echo <<<HTML
            <div class="list-item">
                <div class="list-item__inner">
                    <img class="list-item__folder" src="img/folder.png" alt="folder">
                    <span>{$item['name']}</span>
                </div>
            </div>
HTML;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="list-items" id="list-items">
        <?php renderMenu($menuItems); ?>
    </div>
    <script type="module" src="script.js"></script>
</body>
</html>
