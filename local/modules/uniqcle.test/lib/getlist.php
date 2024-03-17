<?php
namespace Uniqcle\IBlock;


class TestGetlistFactory {

	function oldGetlist(){

		$iblock_id = \Bitrix\Main\Config\Configuration::getInstance()->get('uniqcle_iblock');
		$arResult = [];

		if(\CModule::IncludeModule("iblock")){

			$arSelect = ["ID", "NAME",  "PROPERTY_TEST_PROPERTY"];

			$arFilter = ["IBLOCK_ID" =>$iblock_id['id'] ];


			$result = \CIBlockElement::GetList(
				["DATE_ACTIVE_FROM" => "ASC", "SORT" => "DESC"],
				$arFilter,
				false,
				["nPageSize" => false],
				$arSelect
			);

			while($obj = $result->GetNextElement()){

				$arItem = $obj->GetFields();

				$arTempResult['ID'] = $arItem['ID'];
				$arTempResult['NAME'] = $arItem['NAME'];
				$arTempResult['VALUE'] = $arItem['PROPERTY_TEST_PROPERTY_VALUE'];
                $arResult['GETLIST'][] = $arTempResult;
			}

		}

        return $arResult;

	}

	function d7GetList(){
//		\Bitrix\Main\Loader::includeModule('iblock');
//		\Bitrix\Iblock\IblockTable::compileEntity('catalog');
//
//
//		while ($arItem = $dbItems->fetch()){
//		// В D7 не получается вывести кастомные свойства!
//
//			$element = \Bitrix\Iblock\Elements\ElementCatalogTable::getList([
//				'select' => ['ID', 'TEST_PROPERTY.ID'],
//				'filter' => [
//					'ID' => $arItem['ID'],
//				],
//			])->fetchObject();
//
//			echo '<pre>';
//			print_r($element);
//			echo '</pre>';
//
//        $arItems[] = $element;
//
//		}

  	return [];
	}
}