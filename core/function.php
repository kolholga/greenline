<?php

/**
 * Подключает шаблон с параметрами
 */
function renderTemplate($name, $data = []) //всегда возвращает html-код
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


/**
 * функция для форматированного вывода массива
 */
function pr($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

/**
* Функция добавления параметра в адресную строку
 */
function setPageParam($param, $value)
{
    $qParam = $_SERVER['QUERY_STRING']; // получаем строку с параметрами
    parse_str($qParam, $arr); // (парсим) генерируем массив из этой строки
                                    //parse_str - разбирает строку в переменные => возвращает массив во второй свой параметр
   if(!empty($param) && !empty($value)) { //если переданы параметры
        if(array_key_exists($param, $arr)){ //если есть такой ключ в массиве
                                            //array_key_exists - проверяет наличие того или иного ключа
            $arr[$param] = $value; // меняем значение в полученном массиве, если ключ найден
        }else{
            $arr[$param] = $value;
        }
   }
   return http_build_query($arr); //вернет сгенерированную строку
                                 // http_build_query - генерирует строку с GET-параметрами
}