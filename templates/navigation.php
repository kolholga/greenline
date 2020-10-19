<? if (!empty($arPage)): ?>

    <p class="pages">
        <small>Страница <?= $curPage; ?> из <?= $totalPage; ?> </small>

        <? foreach ($arPage as $nPage): ?>
            <? if ($curPage == $nPage): ?>  <?//если эта страница текущая?>
                <span><?= $nPage; ?></span> <? //Текущая страница?>
            <? else: ?>
                <a href="?page=<?= $nPage; ?>"><?= $nPage; ?></a>   <?//Формируем ссылки на другие страницы?>
            <? endif; ?>
        <? endforeach; ?>

        <a href="#">&raquo;</a>
    </p>

<? endif; ?>