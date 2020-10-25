
<? if (!empty($show)): ?> <?//уже не нужен -  //если массив $arPage, содержащий диапазон страниц, не пустой?>
                            <?// empty - проверка на пустоту?>
    <p class="pages">
        <small>Страница <?= $curPage; ?> из <?= $totalPage; ?> </small> <?//выводим текущую страницу $curPage из общено количества страниц $totalPage?>


        <? /*foreach ($arPage as $nPage): ?>
            <? if ($curPage == $nPage): ?>  <?//если эта страница текущая?>
                <span><?= $nPage; ?></span> <? //Текущая страница?>
            <? else: ?>
                <a href="?page=<?= $nPage; ?>"><?= $nPage; ?></a>   <?//Формируем ссылки на другие страницы?>
            <? endif; ?>
        <? endforeach; */?>

        <?if($curPage >1):?> <?//выводим ссылку на первую страницу, если нужна?>
            <a href="?<?=setPageParam('page', 1);?>">&laquo;</a>
        <?endif;?>

        <?if($prevP != ''):?> <?//выводим ссылку на предыдущую страницу, если нужна?>
            <a href="?<?=setPageParam('page', $prevP);?>"><?= $prevP; ?></a>
        <?endif;?>

        <span><?= $curPage; ?></span> <?// Текущая страница?>

        <?if($nextP != ''):?> <?//выводим ссылку на следующую страницу, если нужна?>
            <a href="?<?=setPageParam('page', $nextP);?>"><?= $nextP; ?></a>
        <?endif;?>

        <?if($curPage < $totalPage):?> <?//выводим ссылку на последнюю страницу, если нужна?>
             <a href="?<?=setPageParam('page', $totalPage);?>">&raquo;</a>
        <?endif;?>

    </p>

<? endif; ?>


