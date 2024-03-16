<?php
//use \Bitrix\Main\Loader;
//use \Uniqcle\IBlock\IBlockUniqcle;
//
//Loader::includeModule("uniqcle.test");
//
//IBlockUniqcle::test();


CModule::AddAutoloadClasses(
	"uniqcle.test",
	array(
		"Uniqcle\\IBlock\\IBlockUniqcle" => "lib/iblock.php",
	)
);
