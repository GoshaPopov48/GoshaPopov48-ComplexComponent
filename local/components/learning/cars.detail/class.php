<?php


use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class CarsDetail extends CBitrixComponent
{
    public function onIncludeComponentLang(): void
    {
        Loc::loadMessages(__FILE__);
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     */
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
        $car = \Bitrix\Iblock\Elements\ElementCarsPriceListTable::getList([
            'select' => ['CODE', 'NAME', 'DETAIL_TEXT', 'DETAIL_PICTURE', 'POWER', 'TRANSMISSION.ITEM', 'PRICE', 'COLOR.ITEM'],
            'filter' => ['CODE' => $this->arParams['CODE']]
        ])->fetchObject();

        $imgPath['DETAIL_PICTURE'] = CFile::GetFileArray($car->getDetailPicture());
        $path = $imgPath['DETAIL_PICTURE']['SRC'];

        $this->arResult['car'] = [
            'NAME' => $car->getName(),
            'DETAIL_TEXT' => $car->getDetailText(),
            'DETAIL_PICTURE' => $path,
            'POWER' => $car->getPower()?->getValue(),
            'TRANSMISSION' => $car->getTransmission()->getItem()?->getValue(),
            'PRICE' => $car->getPrice()->getValue(),
            'COLOR' => $car->getColor()->getItem()?->getValue()
        ];
    }


    public function onPrepareComponentParams($arParams): array
    {
        return $arParams;
    }

}
