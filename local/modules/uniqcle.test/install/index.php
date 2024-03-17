<?php
use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;


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

	function InstallFiles()
	{
		$path=$this->GetPath()."/install/components";

		if(\Bitrix\Main\IO\Directory::isDirectoryExists($path))
			CopyDirFiles($path, $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
		else
			throw new \Bitrix\Main\IO\InvalidPathException($path);

		if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath() . '/admin'))
		{
			CopyDirFiles($this->GetPath() . "/install/admin/", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin"); //если есть файлы для копирования
			if ($dir = opendir($path))
			{
				while (false !== $item = readdir($dir))
				{
					if (in_array($item,$this->exclusionAdminFiles))
						continue;
					file_put_contents($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.$this->MODULE_ID.'_'.$item,
						'<'.'? require($_SERVER["DOCUMENT_ROOT"]."'.$this->GetPath(true).'/admin/'.$item.'");?'.'>');
				}
				closedir($dir);
			}
		}

		return true;
	}

	function UnInstallFiles()
	{
		\Bitrix\Main\IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"] . '/bitrix/components/uniqcle/');

		if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath() . '/admin')) {
			DeleteDirFiles($_SERVER["DOCUMENT_ROOT"] . $this->GetPath() . '/install/admin/', $_SERVER["DOCUMENT_ROOT"] . '/bitrix/admin');
			if ($dir = opendir($path)) {
				while (false !== $item = readdir($dir)) {
					if (in_array($item, $this->exclusionAdminFiles))
						continue;
					\Bitrix\Main\IO\File::deleteFile($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $this->MODULE_ID . '_' . $item);
				}
				closedir($dir);
			}
		}
		return true;
	}

	function DoInstall()
	{
		global $APPLICATION;
		if($this->isVersionD7())
		{

			$this->InstallFiles();

			// \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
			RegisterModule("uniqcle.test");
			CModule::IncludeModule("uniqcle.test");

			$instanceModule = new \Uniqcle\IBlock\IBlockUniqcle();

			$infoBlockID  = $instanceModule->createInfoBlock();
			$instanceModule->createProps($infoBlockID);
			$instanceModule->createElements($infoBlockID);
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

			$this->UnInstallFiles();

			if($request["savedata"] != "Y"){
				//TODO: Удаление инфоблоков
				$this->removeInfoBlocks();
			}

			\Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);

			$APPLICATION->IncludeAdminFile(Loc::getMessage("UNIQCLE_D7_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep2.php");
		}


	}
}