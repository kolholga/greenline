<?php

require_once 'core/init.php'; //подключаем файл init.php

/* $arCategory - список категорий для Layout */

$title = 'Контакты';

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['message'])){
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone= htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    $to = 'kolholga@yahoo.com';
    $subject = 'Письмо из формы обратной связи';
    $text = '';
    $text .= 'Имя: ' . $name . PHP_EOL;
    $text .= 'Email: ' . $email . PHP_EOL;
    $text .= 'Телефон: ' . $phone . PHP_EOL;
    $text .= 'Сообщение: ' . $message . PHP_EOL;
}

$page_content = renderTemplate("contact");

$result = renderTemplate('layout', [
    'content' => $page_content,
    'title' => $title,
    'arCategory' => $arCategory,
    'menuActive' => 'contact'
]);

echo $result;