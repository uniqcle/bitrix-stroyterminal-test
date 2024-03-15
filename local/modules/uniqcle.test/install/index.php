<?php
use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);

Class uniqcle_test extends CModule
{
	function __construct()
	{
		$arModuleVersion = array();
		include(__DIR__."/version.php");

		$this->MODULE_ID = 'uniqcle.test';
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = Loc::getMessage("UNIQCLE_TEST_MODULE_NAME");
		$this->MODULE_DESCRIPTION = Loc::getMessage("UNIQCLE_TEST_MODULE_DESC");

		$this->PARTNER_NAME = Loc::getMessage("UNIQCLE_TEST_PARTNER_NAME");
		$this->PARTNER_URI = Loc::getMessage("UNIQCLE_TEST_PARTNER_URI");
	}

	public function isVersionD7()
	{
		return CheckVersion(\Bitrix\Main\ModuleManager::getVersion('main'), '14.00.00');
	}

	public function GetPath($notDocumentRoot=false)
	{
		if($notDocumentRoot)
			return str_ireplace($_SERVER["DOCUMENT_ROOT"],'',dirname(__DIR__));
		else
			return dirname(__DIR__);
	}


	function createTypeInfoBlock(){
		if (CModule::IncludeModule('iblock')) {
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
			$obBlocktype = new CIBlockType;

			$res = $obBlocktype->Add($arFields);

		}
	}

   function createInfoBlock(){
		$this->createTypeInfoBlock();

		$ID = null;

		if (CModule::IncludeModule('iblock')){
			$ib = new CIBlock;

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
				"GROUP_ID" => $arAccess, // Права доступа
				"FIELDS" => array(
					"DETAIL_PICTURE" => array(
						"IS_REQUIRED" => "N", // не обязательное
						"DEFAULT_VALUE" => array(
							"SCALE" => "Y", // возможные значения: Y|N. Если равно "Y", то изображение будет отмасштабировано.
							"WIDTH" => "600", // целое число. Размер картинки будет изменен таким образом, что ее ширина не будет превышать значения этого поля.
							"HEIGHT" => "600", // целое число. Размер картинки будет изменен таким образом, что ее высота не будет превышать значения этого поля.
							"IGNORE_ERRORS" => "Y", // возможные значения: Y|N. Если во время изменения размера картинки были ошибки, то при значении "N" будет сгенерирована ошибка.
							"METHOD" => "resample", // возможные значения: resample или пусто. Значение поля равное "resample" приведет к использованию функции масштабирования imagecopyresampled, а не imagecopyresized. Это более качественный метод, но требует больше серверных ресурсов.
							"COMPRESSION" => "95", // целое от 0 до 100. Если значение больше 0, то для изображений jpeg оно будет использовано как параметр компрессии. 100 соответствует наилучшему качеству при большем размере файла.
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
						"IS_REQUIRED" => "Y", // Обязательное
						"DEFAULT_VALUE" => array(
							"UNIQUE" => "Y", // Проверять на уникальность
							"TRANSLITERATION" => "Y", // Транслитерировать
							"TRANS_LEN" => "30", // Максмальная длина транслитерации
							"TRANS_CASE" => "L", // Приводить к нижнему регистру
							"TRANS_SPACE" => "-", // Символы для замены
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
					                                   "IS_REQUIRED" => "Y",
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

				"SECTION_PROPERTY" => "Y", // Разделы каталога имеют свои свойства (нужно для модуля интернет-магазина)
			);

			$ID = $ib->Add($arFields);
	     }

		 return $ID;
   }

   function createProps($infoBlockID){
	   // Определяем, есть ли у инфоблока свойства
	   $dbProperties = CIBlockProperty::GetList(array(), array("IBLOCK_ID"=>$infoBlockID));
	   if ($dbProperties->SelectedRowsCount() <= 0) {
		   $ibp = new CIBlockProperty;

		   $arFields = Array(
			   "NAME" => "TEST_PROPERTY",
			   "ACTIVE" => "Y",
			   "SORT" => "100",
			   "CODE" => "TEST_PROPERTY",
			   "PROPERTY_TYPE" => "L",
			   "IBLOCK_ID" => $infoBlockID
		   );
			   $arFields["VALUES"][0] = Array(
				   "VALUE" => "Да",
				   "DEF" => "N",
				   "SORT" => "100"
			   );

		   $arFields["VALUES"][1] = Array(
			   "VALUE" => "Нет",
			   "DEF" => "N",
			   "SORT" => "200"
		   );

			$arFields["VALUES"][2] = Array(
			"VALUE" => "Наверное",
			"DEF" => "Y",
			"SORT" => "300"
			);

		$ibp->Add($arFields);
	   }
	   return;
   }

    function removeInfoBlock(){
		//удаляем инфоблок
    }

	function DoInstall()
	{
		global $APPLICATION;
		if($this->isVersionD7())
		{
			\Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
			$infoBlockID = $this->createInfoBlock();
			$this->createProps($infoBlockID);
		}
		else
		{
			$APPLICATION->ThrowException(Loc::getMessage("UNIQCLE_TEST_INSTALL_ERROR_VERSION"));
		}
		$APPLICATION->IncludeAdminFile(Loc::getMessage("UNIQCLE_TEST_INSTALL_TITLE"), $this->GetPath(). "/install/step.php");
	}

	function DoUninstall()
	{

		global $APPLICATION;

		$context = Application::getInstance()->getContext();
		$request = $context->getRequest();

		if($request["step"]<2)
		{
			$APPLICATION->IncludeAdminFile(Loc::getMessage("UNIQCLE_TEST_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep1.php");
		}
		elseif($request["step"]==2)
		{

			if($request["savedata"] != "Y")
				$this->removeInfoBlock();

			\Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);

			$APPLICATION->IncludeAdminFile(Loc::getMessage("UNIQCLE_D7_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep2.php");
		}


	}
}