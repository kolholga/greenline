<?php

require_once 'core/init.php'; //подключаем файл init.php

/* $arCategory - список категорий для Layout */

$title = 'Поддержка';

$res = mysqli_query($link, "SELECT `title`, `text` FROM `support` LIMIT 0, 3");
$arSupport = mysqli_fetch_all($res, MYSQLI_ASSOC);


$page_content = renderTemplate("support", [
                             'arSupport' => $arSupport
                            ]);

$result = renderTemplate('layout', [
                        'content' => $page_content,
                         'title' => $title,
                         'arCategory' => $arCategory
                        ]);

echo $result;