<?php

require_once 'core/init.php'; //подключаем файл init.php

/* $arCategory - список категорий для Layout */

$title = 'Контакты';

$page_content = renderTemplate("contact");

$result = renderTemplate('layout', [
    'content' => $page_content,
    'title' => $title,
    'arCategory' => $arCategory
]);

echo $result;