<?php
$arUrlRewrite = array(
    0 =>
        array(
            'CONDITION' => '#^/services/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/services/index.php',
            'SORT' => 100,
        ),
    1 =>
        array(
            'CONDITION' => '#^/products/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/products/index.php',
            'SORT' => 100,
        ),
    2 => array(
        'CONDITION' => '#^/cars/#',
        'RULE' => '',
        'ID' => 'learning:cars',
        'PATH' => '/cars/index.php',
        'SORT' => 100,
    )
);
