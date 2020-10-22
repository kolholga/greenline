<?php

require_once 'core/init.php'; //подключаем файл init.php
//echo $_SERVER['DOCUMENT_ROOT']; // вывнедет путь E:/OpenServer/domains/greenline


/* $arCategory - список категорий для Layout */

$title = 'Главная страница';
$num = 3; // оличество новостей на странице

$resTotal = mysqli_query($link, "SELECT * FROM `news`"); //
$total = mysqli_num_rows($resTotal); //Количество записей в запросе

$totalStr = ceil($total/$num); // Общее число страниц
//ceil - функция округляет в большую сторону

$page = intval($_GET['page']); // Получение номера страницы из адресной строки (из массива GET)
                                // intval - переводит в число (приводит к числу)
if($page <= 0){
    $page = 1; //сли номер страницы не существует или отрицательный
}elseif ($page > $totalStr){
    $page = $totalStr; //если номер страницы больше чем их количество
}

$offset = $page * $num - $num; //смещение - определяем с какой новости начинать

$res = mysqli_query($link, "SELECT n.`id`, n.`title`, n.`preview_text`, n.`date`, n.`image`, n.`comments_cnt`, c.`title` AS news_cat " .
                                " FROM `news` n JOIN `category` c ON c.`id` = n.`category_id` ORDER BY n.`id` LIMIT $offset, $num");
$arNews = mysqli_fetch_all($res, MYSQLI_ASSOC);

$arPage = range(1, $totalStr); //Массив со страницами [1,2,3,4,...]
          //range — Создает массив, содержащий диапазон элементов
          
/////////////////////////////////////////////////////
//сборка страниц:

$pageNavigation = renderTemplate('navigation', [ //Получаем html-код шаблона навигации
                                'arPage' => $arPage, //Передаем массив со страницами
                                'totalPage' => $totalStr, //передаем количество страниц
                                'curPage' => $page //передаем текущую страницу
                                 ]);

//require_once 'templates/layout.php'; //подключаем файл layout.php

$page_content = renderTemplate("main", [ // Получаем html-код блока(шаблона) main
                      'arNews' => $arNews, // передаем массив с новостями, полученными из базы данных
                        'navigation' => $pageNavigation //передаем полученный html-код навигации
                    ]);

$result = renderTemplate('layout', [ // Получаем главный layout (главный шаблон страницы)
                      'content' => $page_content, // передаем html-код шаблона main
                      'title' => $title, //передаем title (заголовок окна)
                      'arCategory' => $arCategory //передаем массив, полученный из базы данных
                      ]);

echo $result; //Выводим на экрн окончательный html страницы



