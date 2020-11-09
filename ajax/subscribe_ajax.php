<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php'; //подключаем файл init.php

//pr($_POST);// возвращает данные (data) в ajax-запрос в файле script.js

$resE = getStmtResult($link, "SELECT `email` FROM `subscribe` WHERE `email` = ?", [$_POST['email_subscribe']]);
$arEmail = mysqli_fetch_all($resE, MYSQLI_ASSOC);

if(!empty($arEmail)){
    echo 'Такой email уже зарегистрирован';
}else{
    $resIe = getStmtResult($link, "INSERT INTO `subscribe` SET `email` = ?", [$_POST['email_subscribe']]);
    echo 'Поздравляем, Вы подписаны';
}
