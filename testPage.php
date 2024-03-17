<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');
?>

<?
$APPLICATION->IncludeComponent(
	"uniqcle:testComponent",
	"",
	array(
	                          "CACHE_TIME" => 36000000,
	                          "CACHE_TYPE" => "A"
	)
);
?>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>