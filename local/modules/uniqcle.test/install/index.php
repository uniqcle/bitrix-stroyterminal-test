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

   function createInfoBlock(){
		//создаем инфоблок

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
			$this->createInfoBlock();
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