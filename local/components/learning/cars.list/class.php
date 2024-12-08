<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class CarsList extends CBitrixComponent
{
    public function onIncludeComponentLang(): void
    {
        Loc::loadMessages(__FILE__);
    }

    public function executeComponent(): void
    {
        try {
            $this->checkModules();
            $this->getResult();
            $this->includeComponentTemplate();
        } catch (SystemException $e) {
            ShowError($e->getMessage());
        }
    }

    /**
     * @return void
     * @throws SystemException
     * @throws \Bitrix\Main\LoaderException
     */
    protected function checkModules(): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new SystemException(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
        }
    }

    private function getResult(): void
    {
        $cars = \Bitrix\Iblock\Elements\ElementCarsPriceListTable::getList([
            'select' => ['CODE', 'ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'PRICE', 'COLOR.ITEM'],
        ])->fetchCollection();

        $result = [];
        foreach ($cars as $car) {
            $imgPath['PREVIEW_PICTURE'] = CFile::GetFileArray($car->getPreviewPicture());
            $path = $imgPath['PREVIEW_PICTURE']['SRC'];

            $result[] = [
                'CODE' => $car->getCode() . '/',
                'ID' => $car->getId(),
                'NAME' => $car->getName(),
                'PREVIEW_TEXT' => $car->getPreviewText(),
                'PREVIEW_PICTURE' => $path,
                'PRICE' => $car->getPrice()->getValue(),
                'COLOR' => $car->getColor()->getItem()->getValue()
            ];
        }
        $this->arResult['cars'] = $result;
    }


    public function onPrepareComponentParams($arParams): array
    {
        return $arParams;
    }

}
