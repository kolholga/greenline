<?php

require_once 'core/init.php'; //подключаем файл init.php

/* $arCategory - список категорий для Layout */

$title = 'Поддержка';


$num = 3; // оличество новостей на странице

$stmt = mysqli_prepare($link, "SELECT * FROM `support`"); //// Подготавливает запрос. Возвращает указатель на запрос
mysqli_stmt_execute($stmt);//Выполняет подготовленный запрос/отправляет данные
$resTotal = mysqli_stmt_get_result($stmt);// Получает результат запроса

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

// $arPage = range(1, $totalStr); //Массив со страницами [1,2,3,4,...]
          //range — Создает массив, содержащий диапазон элементов
       
$prevPage = ''; //создали пустую переменную
if($page > 1){ //если находимся не на первой странице
    $prevPage = $page - 1; // то получаем предыдущую страницу
}

$nextPage = '';
if($page < $totalStr){ //если мы не находимся на последней странице
    $nextPage = $page + 1;
}

$is_nav = ($totalStr > 1) ? true : false; //если количество страниц > 1, то true, иначе false (короткая запись)

$stmt = mysqli_prepare($link, "SELECT `title`, `text` FROM `support` LIMIT ?, ?");
mysqli_stmt_bind_param($stmt, "ii", $offset, $num);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);


$arSupport = mysqli_fetch_all($res, MYSQLI_ASSOC);

/////////////////////////////////////////////////////////////
//сборка страниц:

$pageNavigation = renderTemplate('navigation', [ //Получаем html-код шаблона навигации
                                // уже не нужен - 'arPage' => $arPage, //Передаем массив со страницами
                                'totalPage' => $totalStr, //передаем количество страниц
                                'curPage' => $page, //передаем текущую страницу
                                'nextP' => $nextPage, //передаем номер следующей страницы
                                'prevP' => $prevPage, //передаем номер предыдущей страницы
                                'show' => $is_nav //передаем параметр для показа навигации
                                ]);
            
$page_content = renderTemplate('support', [
                             'arSupport' => $arSupport,
                             'navigation' => $pageNavigation //передаем полученный html-код навигаци
                            ]);

$result = renderTemplate('layout', [
                        'content' => $page_content,
                         'title' => $title,
                         'arCategory' => $arCategory,
                         'menuActive' => 'support'
                        ]);

echo $result;