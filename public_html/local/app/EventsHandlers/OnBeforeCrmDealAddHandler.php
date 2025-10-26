<?php

namespace EventsHandlers;

use Bitrix\Main\EventManager;
use Bitrix\Crm\DealTable;
use Bitrix\Main\Entity;
use Bitrix\Main\Diag\Debug;

class OnBeforeCrmDealAddHandler
{
    public static function checkDuplicateDealByVin(&$arFields)
    {
        $vinFieldCode = 'UF_CRM_DEAL_VIN';


        Bitrix\Main\Diag\Debug::dumpToFile($arFields, '$arFields ' . date('d-m-Y; H:i:s'));

        if (empty($arFields[$vinFieldCode])) {
            return true;
        }

        $vin = trim($arFields[$vinFieldCode]);

        try {
            // Ищем сделки с таким же VIN, исключая завершенные
            $existingDeal = DealTable::getList([
                'select' => ['ID', 'TITLE', 'STAGE_ID'],
                'filter' => [
                    '='.$vinFieldCode => $vin,
                    '!=STAGE_ID' => [
                        'WON',    // Успешно завершена
                        'LOSE',   // Закрыта и не реализована
                        'CANCELED'// Отменена
                    ]
                ],
                'limit' => 1
            ])->fetchAll();

            if (!empty($existingDeal)) {
                // Формируем сообщение об ошибке
                $errorMessage = sprintf(
                    "Нельзя создать сделку. Сделка #%d '%s' с VIN '%s' уже существует и находится в активной стадии '%s'",
                    $existingDeal['ID'],
                    $existingDeal['TITLE'],
                    $vin,
                    $existingDeal['STAGE_ID']
                );

                $GLOBALS['APPLICATION']->ThrowException($errorMessage);
                $arFields['RESULT_MESSAGE'] = 'Есть заказ сделка по VIN этого авто не закрытая по ссылке';
                return false;
            }

        } catch (Exception $e) {
            // В случае ошибки пропускаем проверку
            AddMessage2Log("Ошибка при проверке дубликата сделки: " . $e->getMessage());
        }

        return true;
    }



}