<?php

require_once 'core/init.php'; //подключаем файл init.php
//echo $_SERVER['DOCUMENT_ROOT']; // вывнедет путь E:/OpenServer/domains/greenline

$title = 'Главная страница';

$res = mysqli_query($link, "SELECT * FROM `category` ORDER BY `title` ASC"); // ORDER BY `title` ASC - сортировать в прямом порядке
$arCategory = mysqli_fetch_all($res, MYSQLI_ASSOC); 

/* echo '<pre>';
print_r($arCategory);
echo '</pre>'; */


//equire_once 'templates/layout.php'; //подключаем файл layout.php

$page_content = renderTemplate("main");
$res = renderTemplate('layout', [
                      'content' => $page_content, 
                      'title' => 'Главная страница',
                      'arCategory' => $arCategory
                      ]);

echo $res
?>


