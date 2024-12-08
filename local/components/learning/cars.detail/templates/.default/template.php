<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
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


if (!isset($arResult['car'])) {
    echo 'Нет элемента';
    return;
}
?>

<div>
    <img src="<?= $arResult['car']['DETAIL_PICTURE'] ?>" class="card-img-top"
         alt="<?= $arResult['car']['DETAIL_PICTURE'] ?>">
    <h2>Название: <?= $arResult['car']['NAME'] ?></h2>
    <p>Описание: <?= $arResult['car']['DETAIL_TEXT'] ?></p>
    <P>Цвет: <?= $arResult['car']['COLOR'] ?></P>
    <p>Трансмиссия: <?= $arResult['car']['TRANSMISSION'] ?></p>
    <p>Мощность: <?= $arResult['car']['POWER'] . ' (л.с)' ?></p>
    <P>Цена: <?= $arResult['car']['PRICE'] . ' ₽' ?></P>
</div>











