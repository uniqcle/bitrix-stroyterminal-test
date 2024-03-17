<?php
namespace Uniqcle\IBlock;
\CModule::includeModule("sale");
use Bitrix\Main\Localization\Loc;
// \Bitrix\Main\Loader::includeModule('sale');

class IBlockUniqcle{

	protected array $propsOptions = [
		["VALUE" => "Да","DEF" => "N", "SORT" => "100"],
		["VALUE" => "Нет","DEF" => "N", "SORT" => "200"],
		["VALUE" => "Наверное","DEF" => "N", "SORT" => "300"]
	];

	function createTypeInfoBlock(){
		if (\CModule::IncludeModule('iblock')) {
			$arFields = array(
				'ID'       => 'catalog',
				'SECTIONS' => 'Y',
				'IN_RSS'   => 'N',
				'SORT'     => 100,
				'LANG'     => array(
					'en' => array(
						'NAME'         => 'catalog',
						'SECTION_NAME' => 'Sections',
						'ELEMENT_NAME' => 'Products'
					),
					'ru' => array(

						'NAME'         => 'Каталог',
						'SECTION_NAME' => 'Разделы',
						'ELEMENT_NAME' => 'Продукты'

					)
				)
			);
			$obBlocktype = new \CIBlockType;

			$res = $obBlocktype->Add($arFields);

		}
	}

	function createInfoBlock(){
		$this->createTypeInfoBlock();

		$ID = null;

		if (\CModule::IncludeModule('iblock')){
			$ib = new \CIBlock;

			$IBLOCK_TYPE = "catalog"; // Тип инфоблока
			$SITE_ID = "s1"; // ID сайта

			$arAccess = array(
				"2" => "R", // Все пользователи
			);

			$arFields = Array(
				"ACTIVE" => "Y",
				"NAME" => "Тестовый uniqcle",
				"CODE" => "catalog",
				"IBLOCK_TYPE_ID" => $IBLOCK_TYPE,
				"SITE_ID" => $SITE_ID,
				"SORT" => "5",
				"GROUP_ID" => $arAccess,
				"FIELDS" => array(
					"DETAIL_PICTURE" => array(
						"IS_REQUIRED" => "N",
						"DEFAULT_VALUE" => array(
							"SCALE" => "Y",
							"WIDTH" => "600",
							"HEIGHT" => "600",
							"IGNORE_ERRORS" => "Y",
							"METHOD" => "resample",
							"COMPRESSION" => "95",
						),
					),
					"PREVIEW_PICTURE" => array(
						"IS_REQUIRED" => "N", // не обязательное
						"DEFAULT_VALUE" => array(
							"SCALE" => "Y", // возможные значения: Y|N. Если равно "Y", то изображение будет отмасштабировано.
							"WIDTH" => "140", // целое число. Размер картинки будет изменен таким образом, что ее ширина не будет превышать значения этого поля.
							"HEIGHT" => "140", // целое число. Размер картинки будет изменен таким образом, что ее высота не будет превышать значения этого поля.
							"IGNORE_ERRORS" => "Y", // возможные значения: Y|N. Если во время изменения размера картинки были ошибки, то при значении "N" будет сгенерирована ошибка.
							"METHOD" => "resample", // возможные значения: resample или пусто. Значение поля равное "resample" приведет к использованию функции масштабирования imagecopyresampled, а не imagecopyresized. Это более качественный метод, но требует больше серверных ресурсов.
							"COMPRESSION" => "95", // целое от 0 до 100. Если значение больше 0, то для изображений jpeg оно будет использовано как параметр компрессии. 100 соответствует наилучшему качеству при большем размере файла.
							"FROM_DETAIL" => "Y", // возможные значения: Y|N. Указывает на необходимость генерации картинки предварительного просмотра из детальной.
							"DELETE_WITH_DETAIL" => "Y", // возможные значения: Y|N. Указывает на необходимость удаления картинки предварительного просмотра при удалении детальной.
							"UPDATE_WITH_DETAIL" => "Y", // возможные значения: Y|N. Указывает на необходимость обновления картинки предварительного просмотра при изменении детальной.
						),
					),
					"SECTION_PICTURE" => array(
						"IS_REQUIRED" => "N", // не обязательное
						"DEFAULT_VALUE" => array(
							"SCALE" => "Y", // возможные значения: Y|N. Если равно "Y", то изображение будет отмасштабировано.
							"WIDTH" => "235", // целое число. Размер картинки будет изменен таким образом, что ее ширина не будет превышать значения этого поля.
							"HEIGHT" => "235", // целое число. Размер картинки будет изменен таким образом, что ее высота не будет превышать значения этого поля.
							"IGNORE_ERRORS" => "Y", // возможные значения: Y|N. Если во время изменения размера картинки были ошибки, то при значении "N" будет сгенерирована ошибка.
							"METHOD" => "resample", // возможные значения: resample или пусто. Значение поля равное "resample" приведет к использованию функции масштабирования imagecopyresampled, а не imagecopyresized. Это более качественный метод, но требует больше серверных ресурсов.
							"COMPRESSION" => "95", // целое от 0 до 100. Если значение больше 0, то для изображений jpeg оно будет использовано как параметр компрессии. 100 соответствует наилучшему качеству при большем размере файла.
							"FROM_DETAIL" => "Y", // возможные значения: Y|N. Указывает на необходимость генерации картинки предварительного просмотра из детальной.
							"DELETE_WITH_DETAIL" => "Y", // возможные значения: Y|N. Указывает на необходимость удаления картинки предварительного просмотра при удалении детальной.
							"UPDATE_WITH_DETAIL" => "Y", // возможные значения: Y|N. Указывает на необходимость обновления картинки предварительного просмотра при изменении детальной.
						),
					),
					// Символьный код элементов
					"CODE" => array(
						"IS_REQUIRED" => "Y",
						"DEFAULT_VALUE" => array(
							"UNIQUE" => "Y",
							"TRANSLITERATION" => "Y",
							"TRANS_LEN" => "30",
							"TRANS_CASE" => "L",
							"TRANS_SPACE" => "-",
							"TRANS_OTHER" => "-",
							"TRANS_EAT" => "Y",
							"USE_GOOGLE" => "N",
						),
					),
					// Символьный код разделов
					"SECTION_CODE" => array(
						"IS_REQUIRED" => "Y",
						"DEFAULT_VALUE" => array(
							"UNIQUE" => "Y",
							"TRANSLITERATION" => "Y",
							"TRANS_LEN" => "30",
							"TRANS_CASE" => "L",
							"TRANS_SPACE" => "-",
							"TRANS_OTHER" => "-",
							"TRANS_EAT" => "Y",
							"USE_GOOGLE" => "N",
						),
					),
					"DETAIL_TEXT_TYPE" => array(      // Тип детального описания
					                                  "DEFAULT_VALUE" => "html",
					),
					"SECTION_DESCRIPTION_TYPE" => array(
						"DEFAULT_VALUE" => "html",
					),
					"IBLOCK_SECTION" => array(         // Привязка к разделам обязательноа
					                                   "IS_REQUIRED" => "N",
					),
					"LOG_SECTION_ADD" => array("IS_REQUIRED" => "Y"), // Журналирование
					"LOG_SECTION_EDIT" => array("IS_REQUIRED" => "Y"),
					"LOG_SECTION_DELETE" => array("IS_REQUIRED" => "Y"),
					"LOG_ELEMENT_ADD" => array("IS_REQUIRED" => "Y"),
					"LOG_ELEMENT_EDIT" => array("IS_REQUIRED" => "Y"),
					"LOG_ELEMENT_DELETE" => array("IS_REQUIRED" => "Y"),
				),

				// Шаблоны страниц
				"LIST_PAGE_URL" => "#SITE_DIR#/catalog/",
				"SECTION_PAGE_URL" => "#SITE_DIR#/catalog/#SECTION_CODE#/",
				"DETAIL_PAGE_URL" => "#SITE_DIR#/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",

				"INDEX_SECTION" => "Y", // Индексировать разделы для модуля поиска
				"INDEX_ELEMENT" => "Y", // Индексировать элементы для модуля поиска

				"VERSION" => 1, // Хранение элементов в общей таблице

				"ELEMENT_NAME" => "Товар",
				"ELEMENTS_NAME" => "Товары",
				"ELEMENT_ADD" => "Добавить товар",
				"ELEMENT_EDIT" => "Изменить товар",
				"ELEMENT_DELETE" => "Удалить товар",
				"SECTION_NAME" => "Категории",
				"SECTIONS_NAME" => "Категория",
				"SECTION_ADD" => "Добавить категорию",
				"SECTION_EDIT" => "Изменить категорию",
				"SECTION_DELETE" => "Удалить категорию",

				"SECTION_PROPERTY" => "Y",
			);

			$ID = $ib->Add($arFields);
		}

		$uniqcle_iblock = \Bitrix\Main\Config\Configuration::getInstance()-> get('uniqcle_iblock');

//		if($uniqcle_iblock['id'] || $uniqcle_iblock['id'] > 0){
//			echo \CAdminMessage::ShowMessage(array("MESSAGE" => Loc::getMessage('Ошибка! Инфоблок уже существует.'), "TYPE" => "ERROR"));
//		}

		$configuration = \Bitrix\Main\Config\Configuration::getInstance();
		$uniqcle_iblock = $configuration->get('uniqcle_iblock');
		$uniqcle_iblock['id'] = $ID;
		$configuration->add('uniqcle_iblock', $uniqcle_iblock);
		$configuration->saveConfiguration();

		return $ID;
	}

	function createProps($infoBlockID){

		$dbProperties = \CIBlockProperty::GetList(array(), array("IBLOCK_ID"=>$infoBlockID));
		if ($dbProperties->SelectedRowsCount() <= 0) {
			$ibp = new \CIBlockProperty;

			$arFields = Array(
				"NAME" => "TEST_PROPERTY",
				"ACTIVE" => "Y",
				"SORT" => "100",
				"CODE" => "TEST_PROPERTY",
				"PROPERTY_TYPE" => "L",
				"IBLOCK_ID" => $infoBlockID
			);

			$arFields["VALUES"] = $this -> propsOptions;

			$ibp->Add($arFields);
		}
		return;
	}

	function getPropListValue($infoBlockID){
		$arPropVal = [];

		foreach($this->propsOptions as $value):
			$dbPropVals = \CIBlockProperty::GetPropertyEnum('TEST_PROPERTY', [], ["IBLOCK_ID"=>$infoBlockID, "VALUE"=>$value['VALUE']]);
			$arPropVal[] = $dbPropVals->GetNext();
		endforeach;

		return $arPropVal;
	}

	function createElements($infoBlockID){



		global $USER;
		$list = 0;

		foreach($this->propsOptions as $value):
			$el = new \CIBlockElement;
			$PROP = array();

            $PROP['TEST_PROPERTY'] = [$this -> getPropListValue($infoBlockID)[$list]['ID']];

			$arLoadProductArray = Array(
				"MODIFIED_BY"    => $USER->GetID(),
				"IBLOCK_SECTION_ID" => false,
				"IBLOCK_ID"      => $infoBlockID,
				"PROPERTY_VALUES"=> $PROP,
				"NAME"           => "Элемент ". $value['SORT'],
				"CODE" =>      "test". $value['SORT'],
				"ACTIVE"         => "Y",            // активен
				"PREVIEW_TEXT"   => "текст для списка элементов",
				"DETAIL_TEXT"    => "текст для детального просмотра",

			);
			$PRODUCT_ID = $el->Add($arLoadProductArray);
			$list++;
		endforeach;




	}
}