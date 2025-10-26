<?php
use Bitrix\Main\Loader;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Page\Asset;
use \Bitrix\Crm\Service\Container;

$eventManager = \Bitrix\Main\EventManager::getInstance();

/*$eventManager->addEventHandlerCompatible(
    'crm',
    'OnBeforeCrmDealAdd',
    function(&$arFields)
    {
        $log = date('Y-m-d H:i:s') . ' ' . print_r($_REQUEST, true);
        file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);

        $arFields['RESULT_MESSAGE'] = 'Запрещено создавать компанию';
        return false;
    }
);*/

/*if (file_exists(__DIR__ . '/../../vendor/autoload.php')) {
    require_once __DIR__ . '/../../vendor/autoload.php';
    echo __DIR__ . '/../../vendor/autoload.php';
}

if (file_exists(__DIR__ . '/../app/autoloader.php')) {
    require_once __DIR__ . '/../app/autoloader.php';
}
if (file_exists(__DIR__ . '/includes/pretty_print.php')) {
    require_once __DIR__ . '/includes/pretty_print.php';
}

$eventManager = \Bitrix\Main\EventManager::getInstance();*/

//CUtil::InitJSCore(array('jquery3', 'popup', 'ajax', 'date'));
/*\Bitrix\Main\UI\Extension::load('labjsext.getDealsClickEvent');*/
//\Bitrix\Main\UI\Extension::load('labjsext.getDealsByVinInputEvent');

// Добавить таб в карточку контакта
//$eventManager->addEventHandler('crm', 'onEntityDetailsTabsInitialized',['EventsHandlers\onEntityDetailsTabsInitializedHandler','onEntityDetailsTabsInitializedHandler']);

//$eventManager->addEventHandlerCompatible("crm", "OnBeforeCrmDealAdd", ['EventsHandlers\OnBeforeCrmDealAddHandler', 'OnBeforeCrmDealAddHandler']);

// Регистрируем обработчик события изменения продукта товара
/*$eventManager->addEventHandler('catalog', 'OnProductUpdate', ['EventsHandlers\OnProductQuantityChange', 'OnProductQuantityChangeHandler']);
$eventManager->addEventHandler("iblock", "OnAfterIBlockElementUpdate", ['EventsHandlers\OnAfterIBlockElementUpdateHandler', 'OnAfterIBlockElementUpdateHandler']);*/

// Добавить проверку на дубликаты сделок по VIN и стадия выполнения
//$eventManager->addEventHandler('crm', 'OnBeforeCrmDealAdd', ['EventsHandlers\OnBeforeCrmDealAddHandler','checkDuplicateDealByVin']);

// Альтернативный вариант через D7 events
/*$eventManager->addEventHandler(
    'catalog',
    '\Bitrix\Catalog\Model\Product::OnAfterUpdate',
    ['EventsHandlers\QuantityChangeHandler', 'QuantityChangeHandler']
);*/
// Кастомный тип пользовательских полей
//$eventManager->addEventHandler('main', 'OnUserTypeBuildList', ['UserTypes\CUserTypeCustomLink', 'GetUserTypeDescription']);
//$eventManager->addEventHandler('main', 'OnUserTypeBuildList', ['UserTypes\CUserTypeUserId', 'GetUserTypeDescription']);
