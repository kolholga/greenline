<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php'; //подключаем настройки
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php'; //подключаем соединение с базой
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/function.php'; //подключение функции


$res = mysqli_query($link, "SELECT * FROM `category` ORDER BY `title` ASC"); // ORDER BY `title` ASC - сортировать в прямом порядке
$arCategory = mysqli_fetch_all($res, MYSQLI_ASSOC);