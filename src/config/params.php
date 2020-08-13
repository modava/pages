<?php
use modava\pages\PagesModule;

return [
    'pagesName' => 'Pages',
    'pagesVersion' => '1.0',
    'status' => [
        '0' => PagesModule::t('pages', 'Tạm ngưng'),
        '1' => PagesModule::t('pages', 'Hiển thị'),
    ]
];
