<? if (!empty($arPage)): ?> <?//если массив, содержащий диапазон страниц, не пустой?>

    <p class="pages">
        <small>Страница <?= $curPage; ?> из <?= $totalPage; ?> </small> <?//выводим текущую страницу $curPage из общено количества страниц $totalPage?>

        <? foreach ($arPage as $nPage): ?>
            <? if ($curPage == $nPage): ?>  <?//если эта страница текущая?>
                <span><?= $nPage; ?></span> <? //Текущая страница?>
            <? else: ?>
                <a href="?page=<?= $nPage; ?>"><?= $nPage; ?></a>   <?//Формируем ссылки на другие страницы?>
            <? endif; ?>
        <? endforeach; ?>

        <a href="?page=<?= $totalPage; ?>">&raquo;</a>
    </p>

<? endif; ?>