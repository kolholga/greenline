<?php

require_once 'core/init.php'; //подключаем файл init.php
//echo $_SERVER['DOCUMENT_ROOT']; // вывнедет путь E:/OpenServer/domains/greenline

$id = intval($_GET['id']);
$title = 'Новость';

$query = "SELECT n.`id`, n.`title`, n.`detail_text`, DATE_FORMAT(n.`date`, '%d.%m.%Y %H:%i') AS date_detail, n.`image`, n.`comments_cnt`, c.`title` AS news_cat " .
    " FROM `news` n JOIN `category` c ON c.`id` = n.`category_id` WHERE n.`id` = ? LIMIT ?";

$res = getStmtResult($link, $query, [$id, 1]);

$arNewsDetail = mysqli_fetch_assoc($res);

$resComment = getStmtResult($link, "SELECT * FROM `comments` WHERE `news_id` = ?", [$id]);
$arComments = mysqli_fetch_all($resComment, MYSQLI_ASSOC); // Получаем комментарии текущей новости


/////////////////////////////////////////////////
//сборка страниц:

$comments = renderTemplate('comments', [ // Получаем шаблон комментариев
                            'arComments' => $arComments // Передаем массив в шаблон комментариев
]);

$page_content = renderTemplate("news_detail", [ // Получаем html-код блока(шаблона) news_detail
                                'arNews' => $arNewsDetail, // передаем массив с новостью, полученной из базы данных
                                'comments' => $comments // Передаем готовый html - код комментариев
]);


$result = renderTemplate('layout', [ // Получаем главный layout (главный шаблон страницы)
                        'content' => $page_content, // передаем html-код шаблона main
                        'title' => $title, //передаем title (заголовок окна)
                        'arCategory' => $arCategory, //передаем массив, полученный из базы данных
                        'menuActive' => 'main'
]);

echo $result; //Выводим на экрн окончательный html страницы