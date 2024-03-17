<?php
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Uniqcle\IBlock\TestGetlistFactory;

class D7Class extends CBitrixComponent
{
	protected function checkModules()
	{
		if (!Loader::includeModule('uniqcle.test'))
		{
			ShowError(Loc::getMessage('Модуль Uniqcle.test не установлен'));
			return false;
		}

		return true;
	}

	public function executeComponent()
	{
		try {
			if ($this->startResultCache(false)) {

				$this->checkModules();
				Loader::includeModule("uniqcle.test");

				$getListFactoryInstance= new TestGetlistFactory();

				$this-> arResult = $getListFactoryInstance->oldGetlist();
				//TODO: $d7getList = $getListFactory->d7GetList();

				$this->includeComponentTemplate();

			}
		} catch (Exception $e) {
			$this->AbortResultCache();
			$this->arResult['ERROR'] = $e->getMessage();
		}
	}
}