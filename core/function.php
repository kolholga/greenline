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
            $arr[$param] = $value; // меняем значение в полученном массиве, //если ключ найден
   }
   return http_build_query($arr); //вернет сгенерированную строку
                                 // http_build_query - генерирует строку с GET-параметрами
}

/**
 * Функция для подготовленного запроса
 * @param $link
 * @param $query
 * @param array $param
 * @return false|mysqli_result
 */

function getStmtResult($link, $query, $param = [])
                        //$link - указатель на БД, с кот. мы работаем, $query - сам запрос с ?, $param = [] - массив параметров
{
    if(!empty($param)){ // если $param не пустая (если есть массив с параметрами для запроса)
        $stmt = mysqli_prepare($link, $query); // Подготавливает запрос. Возвращает указатель на запрос
        $type = ''; // тип данных / подготавливаем аргумент с типами на основе типов в параметрах
        foreach ($param as $item){ // заполняем $type
            if(is_int($item)){ // is_int() - проверка на число
                $type .= 'i'; //.= - дописываем в конец строки
            }elseif (is_string($item)){ // is_string() - проверка на строку
                $type .= 's';
            }elseif (is_double($item)){ // is_double() - проверка на число с плавающей точкой
                $type .= 'd';
            }else{
                $type .= 's';
            }
        }

        $values = array_merge([$stmt, $type], $param); // Подготавливаем массив параметров для передачи в функцию mysqli_stmt_bind_param() /сливает в массив переданные массивы

        $func = 'mysqli_stmt_bind_param';
        $func(...$values); // ... - Указывает переменное количество аргументов / передать в функцию неопределенное число параметров

        mysqli_stmt_execute($stmt); // Выполняет подготовленный запрос

        $result = mysqli_stmt_get_result($stmt); // Получает результат запроса
        return $result; // Возвращаем результат запроса
    }else{
        $result = mysqli_query($link, $query); // выполнит обычный запрос к БД
        return $result;
    }
}

//https://www.php.net/manual/ru/functions.arguments.php - Списки аргументов переменной длины

///////////////////////////////////////////////////////////////////

//parse_str() - разбирает строку в переменные => возвращает массив во второй свой параметр
//array_key_exists() - проверяет наличие того или иного ключа
//http_build_query() - генерирует строку с GET-параметрами

