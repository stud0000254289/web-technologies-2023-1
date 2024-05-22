<?php
include './db/ConnectDB.php';

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="list-items" id="list-items">
        <?php
        function renderMenu($items) {
            foreach ($items as $item) {
                if ($item['has_children']) {
                    echo '<div class="list-item" data-parent>';
                    echo '<div class="list-item__inner">';
                    echo '<img class="list-item__arrow" src="/img/chevron-down.png" alt="chevron-down" data-open>';
                    echo '<img class="list-item__folder" src="/img/folder.png" alt="folder">';
                    echo '<span>' . $item['name'] . '</span>';
                    echo '</div>';
                    echo '<div class="list-item__items">';
                    renderMenu($item['items']);
                    echo '</div></div>';
                } else {
                    echo '<div class="list-item">';
                    echo '<div class="list-item__inner">';
                    echo '<img class="list-item__folder" src="/img/folder.png" alt="folder">';
                    echo '<span>' . $item['name'] . '</span>';
                    echo '</div></div>';
                }
            }
        }

        renderMenu($menuItems);
        ?>
    </div>
    <script type="module" src="script.js"></script>
</body>
</html>