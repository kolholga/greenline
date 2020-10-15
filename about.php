<?php

require_once 'core/init.php'; //подключаем файл init.php

/* $arCategory - список категорий для Layout */

$title = 'О нас';

$page_content = renderTemplate("about");

$result = renderTemplate('layout', [
    'content' => $page_content,
    'title' => $title,
    'arCategory' => $arCategory
]);

echo $result;