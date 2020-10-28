<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

//работа с дополненными запросами:
/*
1. Сформировать запрос с плейсхолдерами (?)
2. Отправить запрос в базу
3. Подставить значения в подготовленное выражение
4. Выполнить подготовленное выражение
5. Обработать результат выполнения

//табличка типов
i - integer (число)
s - string (строка)
d - double (число с плавающей точкой) 1.3
b - blob (бинарные данные)
*/

/*
$stmt = mysqli_prepare($link, "SELECT * FROM `news` WHERE `id` = ?"); // Подготавливает запрос. Возвращает указатель.
        //mysqli_prepare() - возвращает указатель
mysqli_stmt_bind_param($stmt, "i", $_GET['id']); // Привязывает переменные к параметрам запроса (i - тип $_GET['id'])
        //mysqli_stmt_bind_param() - привязывает переменные к параметрам запроса
*/

//$author = $_GET['author'];
$cat = $_GET['category'];
$title = 'Технологии';
/*
$stmt = mysqli_prepare($link, "SELECT * FROM `news` WHERE `author` = ? AND `id` = ? LIMIT ?, ?");
mysqli_stmt_bind_param($stmt, "siii", $author, $id, $offset, $num);
*/

/*
$stmt = mysqli_prepare($link, "SELECT * FROM `category` WHERE `title` = ?");// Подготавливает запрос. Возвращает указатель на запрос

mysqli_stmt_bind_param($stmt, "s", $title); // Привязывает переменные к параметрам запроса

mysqli_stmt_execute($stmt); //  Выполняет собранный(подготовленный) в кучу запрос/отправляет данные
        //mysqli_stmt_execute - Выполняет подготовленный запрос/отправляет данные

$res = mysqli_stmt_get_result($stmt); // Получает результат запроса
        // mysqli_stmt_get_result() - Получает результат запроса
*/

$nD = '1';
$stmt = mysqli_prepare($link, "SELECT `author`, `text` FROM `comments` WHERE `news_id` = ?");
mysqli_stmt_bind_param($stmt, "s", $nD);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);


while ($arRes = mysqli_fetch_assoc($res)){
    pr($arRes);
}

// 26/10/2020
// 1. Написать в функцию function getWeekDay(). принимает номер дня недели от 0 до 7, где 0-воскресенье, 7- суббота, а возвращает название этого дня недели на рус яз
// 2. в support все запросы mysqli_query перевести в mysqli_prepare

/*
function getWeekDay($numDay){
        if($numDay == 0){
                return 'Воскресенье';
        }
        elseif($numDay == 1){
                return 'Понедельник';
        }
        elseif($numDay == 2){
                return 'Вторник';
        }
        elseif($numDay == 3){
                return 'Среда';
        }
        elseif($numDay == 4){
                return 'Четверг';
        }
        elseif($numDay == 5){
                return 'Пятница';
        }
        elseif($numDay == 6){
                return 'Суббота';
        }else{
                return 'Нет такого дня недели'; 
        }
}

echo getWeekDay(1);
*/

/*
function getWeekDay($numDay){
        switch ($numDay){
                case 0:
                        echo "Воскресенье";
                        break;
                case 1:
                        echo "Понедельник";
                        break;   
                case 2:
                        echo "Вторник";
                        break;
                case 3:
                        echo "Среда";
                        break;
                case 4:
                        echo "Четверг";
                        break;
                case 5:
                        echo "Пятница";
                        break;
                case 6:
                        echo "Суббота";
                        break;
                default:
                        echo "Нет такого дня недели";
                    
        }
}

getWeekDay(5);
*/

/*
function ggggg($h){
        if($h >= 0 && $h <= 12){
                echo "Время до полудня";
        }elseif($h > 12 && $h <= 24){
                echo "Время после полудня";
        }else {
                echo "Не верное значение времени";  
        }
}

ggggg(42);
*/
?>





<?php
//
//пагинация - постраничный вывод данных
//1. сколько записей/новостей выводить на страницу
//2. сколько всего записей в базе данных
//3. сколько будет всего страницу
//4. определить текущую страницу (на какой странице сейчас находится пользователь)
//   ($_GET['page'])
//   ____________________________________________
//   LIMIT - ограничение выборки
//
//   LIMIT n- ограничение выборки
//   n - количество строк
//
//   LIMIT n, m -
//   n- с какой записи начинать
//   m - сколько выводить
//
//OFFSET m -
//m- симещение (с какой начинать)
//
//
//....... LIMIT n OFFSET m
//
//__________________________________________
//ob_start(); //включаем буферизацию
//
//echo 'Hello';
//
////$str = ob_get_contents(); //возвращает данные из буфера
////(данные будут дописываться, поэтому нужно вызывать функцию очистки)
////ob_end_clean(); //очищает буфер
//$str = ob_get_clean(); //выполняет эти 2 операции вместе:возвращает данные из буфера , очищает буфер
//
//
//
////echo $str;
//
//?>

<?php
/*
1. Получить текущую страницу
2. Получить последнюю страницу
3. Получить две предыдущие страницы
4. Получить две следующие страницы
*/
?>

<?php
// алгоритм создания получения категорий:
/*
1. массив с категориями уже есть
2. Сформировать ссылки с правильными параметрами (layout)
3. Проверяем наличие параметров в массиве $_GET
4. Добавляем фильтрацию  (условие) в запрос на выборку новостей
*/
?>
