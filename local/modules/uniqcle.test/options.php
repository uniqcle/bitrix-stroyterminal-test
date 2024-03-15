<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;


$module_id = 'uniqcle.test'; //обязательно, иначе права доступа не работают!

// Для того чтобы использовать языковые константы главного модуля
Loc::loadMessages($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
Loc::loadMessages(__FILE__);

// Проверяем доступ к настройкам модуля, кот. дана группе которой принадлежит текущ. пользователь. Вернет букву
if ($APPLICATION->GetGroupRight($module_id)<"S"){
	$APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}


\Bitrix\Main\Loader::includeModule($module_id);

echo 'Настройки модуля. Раздел в разработке...'; 
