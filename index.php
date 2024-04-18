<?php
// Task 1
$a = 5;  
$b = -3; 

if ($a >= 0 && $b >= 0) {
    echo "задание 1 - Difference: " . ($a - $b) . "<br>";
} elseif ($a < 0 && $b < 0) {
    echo "задание 1 - Product: " . ($a * $b) . "<br>";
} else {
    echo "задание 1 - Sum: " . ($a + $b) . "<br>";
}

// Task 2
$a = 4;
echo " Задание 2 Вывод чисел от переменной $a до 15 с использованием switch: ";
switch ($a) {
    case 0: echo "0 ";
    case 1: echo "1 ";
    case 2: echo "2 ";
    case 3: echo "3 ";
    case 4: echo "4 ";
    case 5: echo "5 ";
    case 6: echo "6 ";
    case 7: echo "7 ";
    case 8: echo "8 ";
    case 9: echo "9 ";
    case 10: echo "10 ";
    case 11: echo "11 ";
    case 12: echo "12 ";
    case 13: echo "13 ";
    case 14: echo "14 ";
    case 15: echo "15 ";
    break;
}
echo "<br>";

// Task 3 - Arithmetic Functions
function add($x, $y) {
    return $x + $y;
}

function subtract($x, $y) {
    return $x - $y;
}

function multiply($x, $y) {
    return $x * $y;
}

function divide($x, $y) {
    if ($y != 0) {
        return $x / $y;
    } else {
        return "Division by zero error";
    }
}
echo "Задание 3 : " ."<br>";
$result5 = divide(10, 5);  
echo "divide 10/5: " . $result5 . "<br>";

// Task 4 - Operation Function
function mathOperation($arg1, $arg2, $operation) {
    switch ($operation) {
        case 'add':      return add($arg1, $arg2);
        case 'subtract': return subtract($arg1, $arg2);
        case 'multiply': return multiply($arg1, $arg2);
        case 'divide':   return divide($arg1, $arg2);
        default:         return "Invalid operation";
    }
}
echo "Задание 4 result:  "  . "<br>";
$result1 = mathOperation(10, 5, 'add');
echo "Addition of 10 and 5 is " . $result1 . "<br>";

$result2 = mathOperation(10, 5, 'subtract');
echo "Subtraction of 10 from 5 is " . $result2 . "<br>";

$result3 = mathOperation(10, 5, 'multiply');
echo "Multiplication of 10 and 5 is " . $result3 . "<br>";

$result4 = mathOperation(10, 5, 'divide');
echo "Division of 10 by 5 is " . $result4 . "<br>";


// Task 6 - Recursive Power Function
function power($val, $pow) {
    if ($pow == 0) {
        return 1;
    } elseif ($pow > 0) {
        return $val * power($val, $pow - 1);
    } else {
        return 1 / power($val, -$pow);
    }
}

echo "Задание 6 - 2^3 = " . power(2, 3) . "<br>";
?>
<!DOCTYPE html>
<html>
<body>
    <h4> Задание 5</h4>
    <p>текущий год: <?php echo date("Y"); ?></p> <!-- Метод 1 -->
    <p>текущий год: <?= date("Y") ?></p>         <!-- Метод 2 -->
    <p>текущий год: <?php print date("Y"); ?></p> <!-- Метод 3 --> 
    
    
</body>
</html>

