<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
\Bitrix\Main\UI\Extension::load("ui.bootstrap4");
/** @var array $arParams */
/** @var array $arResult */
/** @var CMain $APPLICATION */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

if (!isset($arResult['cars'])) {
    echo 'Нет элементов';
    return;
}
?>

<?php foreach ($arResult['cars'] as $car): ?>
    <div class="card mb-3">
        <img src="<?= $car['PREVIEW_PICTURE'] ?>" class="card-img-top" alt="<?= $car['PREVIEW_PICTURE'] ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $car['NAME'] ?></h5>
            <p class="text"><?= substr($car['PREVIEW_TEXT'], 0, 150) . '...' ?></p>
            <P>Цвет: <?= $car['COLOR'] ?></P>
            <P>Цена: <?= $car['PRICE'] . ' ₽' ?></P>
            <a href="<?= $car['CODE'] ?>" class="link">Подробнее</a>
        </div>
    </div>
<?php endforeach; ?>

