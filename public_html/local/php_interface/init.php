<?php

use Bitrix\Main\Loader;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Page\Asset;
use \Bitrix\Crm\Service\Container;
use Bitrix\Crm\DealTable;

if (file_exists(__DIR__ . '/../../vendor/autoload.php')) {
    require_once __DIR__ . '/../../vendor/autoload.php';
}

if (file_exists(__DIR__ . '/../app/autoloader.php')) {
    require_once __DIR__ . '/../app/autoloader.php';
}


$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandlerCompatible(
    'crm',
    'OnBeforeCrmDealAdd',
    function (&$arFields) {
        $vinFieldCode = 'C1:'.$arFields['UF_CRM_DEAL_VIN'];

        $existingDeal = DealTable::getList([
            'select' => ['ID', 'TITLE', 'STAGE_ID'],
            'filter' => [
                'UF_CRM_DEAL_VIN' => $arFields['UF_CRM_DEAL_VIN'],
                '!=STAGE_ID' => ['C1:WON']
            ],
           // 'limit' => 1
        ])->fetchAll();


        $log = date('Y-m-d H:i:s') . ' ' . print_r( $existingDeal, true);
        file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);

        if (!empty($existingDeal)) {
            $arFields['RESULT_MESSAGE'] = 'Невозможно создать новую заказ-сделку. Есть не закрытая заказ-сделка авто с таким же VIN кодом  '.$arFields['UF_CRM_DEAL_VIN'].' Необходимо ее закрыть';
            return false;
        }

    }
);



//$eventManager = \Bitrix\Main\EventManager::getInstance();*/

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
