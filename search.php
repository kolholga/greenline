<?

require_once 'core/init.php'; //подключаем файл init.php

$search = $_GET['search'];
if($search != ''){
    $arResult = [];
    $query = "SELECT n.`id`, n.`title`, n.`detail_text`, DATE_FORMAT(n.`date`, '%d.%m.%Y %H:%i') AS news_date, n.`image`, n.`comments_cnt`, c.`title` AS news_cat " .
         " FROM `news` n JOIN `category` c ON c.`id` = n.`category_id` WHERE MATCH(`detail_text`) AGAINST(?)";
    $res = getStmtResult($link, $query, [$search]);
    while ($arRes = mysqli_fetch_assoc($res)){
        $text = substr($arRes['detail_text'], 0, 200);
        $arRes['detail_text'] = $text;
        $arResult[] = $arRes;
        
    }

    
}else{

}

$result = renderTemplate('layout', [ // Получаем главный layout (главный шаблон страницы)
                      'content' => $page_content, // передаем html-код шаблона main
                      'title' => 'Поиск по сайту', //передаем title (заголовок окна)
                      'arCategory' => $arCategory, //передаем массив, полученный из базы данных
                      'menuActive' => ''
                      ]);

echo $result; //Выводим на экрн окончательный html страницы

