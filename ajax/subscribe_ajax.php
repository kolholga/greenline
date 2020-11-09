<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php'; //подключаем файл init.php

//pr($_POST);// возвращает данные (data) в ajax-запрос в файле script.js

if (isset($_POST['email_subscribe']) && $_POST['email_subscribe'] != '') {
    $email = $_POST['email_subscribe'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // ПОЧИТАТЬ -
        $resEmail = getStmtResult($link, "SELECT * FROM `subscribe` WHERE `email` = ?", [$email]);
        if (mysqli_num_rows($resEmail) > 0) {
            echo '<span style="color: red">Такой email уже есть в базе</span>';
        } else {
            getStmtResult($link, "INSERT INTO `subscribe` SET `email` = ?", [$email]);
            echo '<span style="color: green">email добавлен</span>';
        }

    } else {
        echo '<span style="color: red">Заполните правильно email</span>';
    }

} else {
    echo '<span style="color: red">Заполните поле email</span>';
}

/*
$resE = getStmtResult($link, "SELECT `email` FROM `subscribe` WHERE `email` = ?", [$_POST['email_subscribe']]);
$arEmail = mysqli_fetch_all($resE, MYSQLI_ASSOC);

if(!empty($arEmail)){
    echo 'Такой email уже зарегистрирован';
}else{
    $resIe = getStmtResult($link, "INSERT INTO `subscribe` SET `email` = ?", [$_POST['email_subscribe']]);
    echo 'Поздравляем, Вы подписаны';
}
*/