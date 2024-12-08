<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "show cars");
$APPLICATION->SetTitle("show");
?><?$APPLICATION->IncludeComponent(
	"learning:cars",
	"",
    [
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/cars/",
    ],
    false
);?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>