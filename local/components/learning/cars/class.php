<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */

/** @global CMain $APPLICATION */
class CarsComponent extends CBitrixComponent
{
    /** @var string $componentPage */
    private string $componentPage = '';

    private function getComponentPage(): void
    {
        $arDefaultUrlTemplates404 = [
            'list' => 'index.php',
            'detail' => '#CODE#/',
        ];

        $arDefaultVariableAliases404 = [];
        $arDefaultVariableAliases = [];
        $arComponentVariables = [
            'CODE'
        ];
        $arUrlTemplates = [];

        $arParams = $this->arParams;
        $arVariables = [];

        if ($arParams['SEF_MODE'] == 'Y') {
            $arUrlTemplates = CComponentEngine::makeComponentUrlTemplates(
                $arDefaultUrlTemplates404,
                $arParams["SEF_URL_TEMPLATES"]
            );

            $arVariableAliases = CComponentEngine::makeComponentVariableAliases(
                $arDefaultVariableAliases404,
                $arParams["VARIABLE_ALIASES"]
            );

            $this->componentPage = $componentPage = CComponentEngine::ParseComponentPath(
                $arParams["SEF_FOLDER"],
                $arUrlTemplates,
                $arVariables
            );

            CComponentEngine::InitComponentVariables(
                $componentPage,
                $arComponentVariables,
                $arVariableAliases,
                $arVariables
            );

            $arResult = [
                "FOLDER" => $arParams["SEF_FOLDER"],
                "URL_TEMPLATES" => $arUrlTemplates,
                "VARIABLES" => $arVariables,
                "ALIASES" => $arVariableAliases,
            ];
        } else {
            global $APPLICATION;
            $getCurPage = htmlspecialcharsbx($APPLICATION->GetCurPage());


            $arVariableAliases = CComponentEngine::MakeComponentVariableAliases(
                $arDefaultVariableAliases,
                $arParams["VARIABLE_ALIASES"]
            );
            CComponentEngine::InitComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

            if (isset($arVariables["id"]) && intval($arVariables["id"]) > 0) {
                $this->componentPage = "detail";
            } else {
                $this->componentPage = "list";
            }

            $arResult = [
                "FOLDER" => "",
                "URL_TEMPLATES" => array(
                    "list" => $getCurPage,
                    "detail" => $getCurPage . "?id=#id#",
                ),
                "VARIABLES" => $arVariables,
                "ALIASES" => $arVariableAliases
            ];
        }

        $this->arResult = $arResult;
    }

    /**
     * @return void
     */
    public function executeComponent(): void
    {
        // Определение страницы
        $this->getComponentPage();

        if ($this->componentPage) {
            // Если страница найдена
            $this->IncludeComponentTemplate($this->componentPage);
        } else {
            // Если страница НЕ найдена
            Bitrix\Iblock\Component\Tools::process404(
                'Ошибка 404 - Страница не найдена',
                true,
                true,
                true,
                false
            );
        }
    }

}
