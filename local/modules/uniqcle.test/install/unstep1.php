<?php
use \Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid())
	return;

Loc::loadMessages(__FILE__);
?>

<? // $APPLICATION->GetCurPage() ?>

<form action="<? echo $APPLICATION->GetCurPage() ?>">
	<?= bitrix_sessid_post() ?>
	<input type="hidden" name="lang" value="<? echo LANGUAGE_ID ?>">
	<input type="hidden" name="id" value="uniqcle.test">
	<input type="hidden" name="uninstall" value="Y">
	<input type="hidden" name="step" value="2">

	<? echo CAdminMessage::ShowMessage(Loc::getMessage("MOD_UNINST_WARN")) ?>

	<p>Вы можете сохранить установленные инфоблоки от данного модуля.</p>
	<p>
		<input type="checkbox" name="savedata" id="savedata" value="Y" checked>
		<label for="savedata">
			<? echo Loc::getMessage("MOD_UNINST_SAVE_INFOBLOCK") ?>
		</label>
	</p>
	<input type="submit" name="" value="<? echo Loc::getMessage("MOD_UNINST_DEL") ?>">
</form>