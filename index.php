<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');
?>

<?
$APPLICATION->IncludeComponent(
	"uniqcle:testComponent", // разработчик:название компонента
	"",             // шаблон
	array(                    // параметры
	                          "CACHE_TIME" => 0,
	                          "CACHE_TYPE" => "A"
	)
);
?>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>