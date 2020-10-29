<?php

require_once 'core/init.php'; //подключаем файл init.php
//echo $_SERVER['DOCUMENT_ROOT']; // вывнедет путь E:/OpenServer/domains/greenline


/* $arCategory - список категорий для Layout */

$title = 'Главная страница';
$num = 3; // Количество новостей на странице

/**
 * Фильтрация по категориям
 */
$where = '';
if(isset($_GET['category'])){
    $category = intval($_GET['category']); //эта переменная либо 0, либо число (привели к числу с помощью intval)
    if($category > 0){ //если пользователь ничего не менял, то есть число > 0
        $where = 'WHERE `category_id` = ?'; //
    }
}

// Если есть WHERE условие и выбрана категория
if($where != '' && isset($category)){
    $resTotal = getStmtResult($link, "SELECT * FROM `news` $where", [$category]);
}else{
    $resTotal = getStmtResult($link, "SELECT * FROM `news`");
}

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



$arPage = range(1, $totalStr); //Массив со страницами [1,2,3,4,...]
          //range — Создает массив, содержащий диапазон элементов

$prevPage = ''; //создали пустую переменную
if($page > 1){ //если находимся не на первой странице
    $prevPage = $page - 1; // то получаем предыдущую страницу
}

// $prevPage = ($page > 1) ? ($page - 1) : '' ; // короткая запись

$nextPage = '';
if($page < $totalStr){ //если мы не находимся на последней странице
    $nextPage = $page + 1;
}

// $nextPage = ($page < $totalStr) ? ($page + 1) : '' ; // короткая запись

$is_nav = ($totalStr > 1) ? true : false; //если количество страниц > 1, то true, иначе false (короткая запись)

$query = "SELECT n.`id`, n.`title`, n.`preview_text`, n.`date`, n.`image`, n.`comments_cnt`, c.`title` AS news_cat " .
    " FROM `news` n JOIN `category` c ON c.`id` = n.`category_id` $where ORDER BY n.`id` LIMIT ?, ?";

// В зависимости от наличия условий (3 или 2 условия) подготавливаем параметры
if($where != '' && isset($category)){
    $param = [$category, $offset, $num];
}else{
    $param = [$offset, $num];
}

$res = getStmtResult($link, $query, $param);
$arNews = mysqli_fetch_all($res, MYSQLI_ASSOC);

/////////////////////////////////////////////////////
//сборка страниц:

$pageNavigation = renderTemplate('navigation', [ //Получаем html-код шаблона навигации
                                // уже не нужен - 'arPage' => $arPage, //Передаем массив со страницами
                                'totalPage' => $totalStr, //передаем количество страниц
                                'curPage' => $page, //передаем текущую страницу
                                'nextP' => $nextPage, //передаем номер следующей страницы
                                'prevP' => $prevPage, //передаем номер предыдущей страницы
                                'show' => $is_nav //передаем параметр для показа навигации
                                 ]);

//require_once 'templates/layout.php'; //подключаем файл layout.php

$page_content = renderTemplate("main", [ // Получаем html-код блока(шаблона) main
                      'arNews' => $arNews, // передаем массив с новостями, полученными из базы данных
                        'navigation' => $pageNavigation //передаем полученный html-код навигации
                    ]);


$result = renderTemplate('layout', [ // Получаем главный layout (главный шаблон страницы)
                      'content' => $page_content, // передаем html-код шаблона main
                      'title' => $title, //передаем title (заголовок окна)
                      'arCategory' => $arCategory, //передаем массив, полученный из базы данных
                      'menuActive' => 'main'
                      ]);

echo $result; //Выводим на экрн окончательный html страницы



