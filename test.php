<?php

пагинация - постраничный вывод данных
1. сколько записей/новостей выводить на страницу
2. сколько всего записей в базе
3. сколько будет всего страницу
4. определить текущую страницу (на какой странице сейчас находится пользователь)
   ($_GET['page'])
   ____________________________________________
   LIMIT - ограничение выборки

   LIMIT n- ограничение выборки
   n - количество строк

   LIMIT n, m - 
   n- с какой записи начинать
   m - сколько выводить

OFFSET m -
m- симещение (с какой начинать)


....... LIMIT n OFFSET m

__________________________________________
ob_start(); //включаем буферизацию

echo 'Hello';

//$str = ob_get_contents(); //возвращает данные из буфера 
//(данные будут дописываться, поэтому нужно вызывать функцию очистки)
//ob_end_clean(); //очищает буфер
$str = ob_get_clean(); //выполняет эти 2 операции вместе:возвращает данные из буфера , очищает буфер



//echo $str;