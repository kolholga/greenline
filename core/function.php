<?php

/**
 * Подключает шаблон с параметрами
 */
function renderTemplate($name, $data = [])
{
    $result = ''; // Подготавлием результат. По умолчанию он пустой.

    $name = $_SERVER['DOCUMENT_ROOT'] . '/templates/' . $name . '.php'; // Создаем полный путь из параметра $name
    if(!file_exists($name)){ // проверяем, существует ли файл $name
        return $result; // Если такого файла нет, возвращаем результат
    }

    ob_start(); // начало буферизации

    extract($data); //н-р, $title = 'Главная' - функция создает переменные из массива, где ключи становятся именем переменной, а значение записывается... ['title']
    require_once $name; // Подключаем шаблон

    $result = ob_get_clean(); // Выводим данные из буфера

    return $result; // Возвращает результат
}


/* функция для форматированного вывода массива */
function pr($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}