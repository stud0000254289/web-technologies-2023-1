<?php
echo "задание1: " ."<br>"."<br>";
function printNumbers() {
    $number = 0;
    do {
        if ($number === 0) {
            echo $number . " – это ноль.<br>";
        } elseif ($number % 2 === 0) {
            echo $number . " – чётное число.<br>";
        } else {
            echo $number . " – нечётное число.<br>";
        }
        $number++;
    } while ($number <= 10);
}

// Вызов функции для вывода чисел от 0 до 10 с указанием их чётности или нечётности
printNumbers();
echo "<br>"."<br>";

echo "задание2: " ."<br>"."<br>";

// Создание массива с областями и городами
$regions = array(
    "Московская область" => array("Москва", "Зеленоград", "Клин"),
    "Ленинградская область" => array("Санкт-Петербург", "Всеволожск", "Павловск", "Кронштадт"),
    "Рязанская область" => array("Рязань", "	Ряжск", "Рыбное", "Кораблино"),
);

// Вывод значений массива в указанном формате
foreach ($regions as $region => $cities) {
    echo $region . ":\n .<br>";
    echo implode(", ", $cities) . ".\n\n" ."<br>"."<br>";
}

echo "задание6: вывести на экран только города, начинающиеся с буквы “К”" ."<br>"."<br>";


$regions = array(
    "Московская область" => array("Москва", "Зеленоград", "Клин"),
    "Ленинградская область" => array("Санкт-Петербург", "Всеволожск", "Павловск", "Кронштадт"),
    "Рязанская область" => array("Рязань", "Ряжск", "Рыбное", "Кораблино"),
);

// Вывод только городов, начинающихся с буквы "К"
foreach ($regions as $region => $cities) {
    echo $region . ":\n .<br>";
    foreach ($cities as $city) {
        if (mb_substr($city, 0, 1, 'UTF-8') === 'К') {
            echo $city . ", ";
        }
    }
    echo "\n\n" ."<br>"."<br>";
}

echo "задание3 : " ."<br>"."<br>";

// Массив для транслитерации русских букв на латиницу
$translitArray = array(
    'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
    'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
    'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
    'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
    'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts', 'ч' => 'ch',
    'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '',
    'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
);


function transliterate($string, $translitArray) {
    $result = '';
    $string = mb_strtolower($string, 'UTF-8'); 

    
    for ($i = 0; $i < mb_strlen($string, 'UTF-8'); $i++) {
        $char = mb_substr($string, $i, 1, 'UTF-8');
        
        if (array_key_exists($char, $translitArray)) {
            $result .= $translitArray[$char];
        } else {
            $result .= $char; 
        }
    }
    return $result;
}

// Пример использования функции
$string = "Привет, мир!";
echo "Транслитерация строки \"$string\": " . transliterate($string, $translitArray) ."<br>"."<br>";





echo "задание4: " ."<br>";
$menuItems = array(
    array(
        'title' => 'Главная',
        'link' => 'index.php'
    ),
    array(
        'title' => 'О нас',
        'link' => 'about.php'
    ),
    array(
        'title' => 'Услуги',
        'link' => 'services.php',
        'submenu' => array(
            array(
                'title' => 'Веб-разработка',
                'link' => 'web-development.php'
            ),
            array(
                'title' => 'Дизайн',
                'link' => 'design.php'
            ),
            array(
                'title' => 'Маркетинг',
                'link' => 'marketing.php'
            ),
            array(
                'title' => 'Хостинг',
                'link' => 'hosting.php'
            ),
            
        )
    ),
   
);



?>

<ul>
    <?php foreach ($menuItems as $menuItem): ?>
        <li>
            <a href="<?php echo $menuItem['link']; ?>"><?php echo $menuItem['title']; ?></a>
            <?php if (isset($menuItem['submenu'])): ?>
                <ul>
                    <?php foreach ($menuItem['submenu'] as $submenuItem): ?>
                        <li><a href="<?php echo $submenuItem['link']; ?>"><?php echo $submenuItem['title']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой сайт</title>
    
</head>
<body>
    <header>
        <h1>задание5</h1>
        <nav>
            <ul>
                <?php foreach ($menuItems as $menuItem): ?>
                    <li>
                        <a href="<?php echo $menuItem['link']; ?>"><?php echo $menuItem['title']; ?></a>
                        <?php if (isset($menuItem['submenu'])): ?>
                            <ul>
                                <?php foreach ($menuItem['submenu'] as $submenuItem): ?>
                                    <li><a href="<?php echo $submenuItem['link']; ?>"><?php echo $submenuItem['title']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Содержимое страницы -->
    </main>
    <footer>
        <!-- Футер сайта -->
    </footer>
</body>
</html>
