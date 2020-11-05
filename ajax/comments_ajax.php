<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php'; //подключаем файл init.php

// pr($_POST);// возвращает данные (data) в ajax-запрос в файле script.js

mysqli_begin_transaction($link); // запускаем транзакцию (данные далее держит в уме) / работает только для таблиц типа InnoDB

    $resC = getStmtResult($link, "INSERT INTO `comments` SET `text` = ?, `author` = ?, `news_id` = ?, `date` = NOW()", [
        $_POST['message'],
        $_POST['name'],
        $_POST['news_id']
    ]);
    $id = mysqli_insert_id($link); // получает id только что вставленной записи

    $resN = getStmtResult($link, "SELECT `comments_cnt` FROM `news` WHERE `id` = ?", [$_POST['news_id']]);
    $cnt = mysqli_fetch_assoc($resN)['comments_cnt'];
    $cnt++;

    $resNews = getStmtResult($link, "UPDATE `news` SET `comments_cnt` = ? WHERE `id` = ?", [$cnt, $_POST['news_id']]);

if($id > 0){
    mysqli_commit($link); // Фиксирует транзакцию (применит запросы)
    //echo 'Ok';

    // *** чтобы комментарий добавлялся на страницу без ее обновления/ методом ajax
    $resComment = getStmtResult($link, "SELECT * FROM `comments` WHERE `news_id` = ?", [$_POST['news_id']]);
    $arComments = mysqli_fetch_all($resComment, MYSQLI_ASSOC); // Получаем комментарии текущей новости

    $comments = renderTemplate('comments', [ // Получаем шаблон комментариев
        'arComments' => $arComments // Передаем массив в шаблон комментариев
    ]);
    //echo $comments;
    // ***

    $arResult = [];
    $arResult['comments'] = $comments;
    $arResult['cc'] = count($arComments);

    echo json_encode($arResult); //Превращаем массив в json / делаем массив строкой (т.к. передать можно только строку)
}else{
    mysqli_rollback($link); //Откат текущей транзакции (не применит запросы)
    echo 'error';
}