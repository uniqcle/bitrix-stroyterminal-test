<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
//\Bitrix\Main\UI\Extension::load("ui.bootstrap4");

$this->addExternalCss($templateFolder."/bootstrap.css");
$this->addExternalCss($templateFolder."/style.css");
$this->addExternalJS( $templateFolder.'/script.js' );
?>

<div class="wrapper container">

    <h1>Тестовое задание ТД Стройтерминал </h1>

    <ul class="list-group list-group-horizontal-xl mb-3">
        <?php $i = 0; ?>
        <?php foreach($arResult['GETLIST'] as $item): ?>
            <li class=" btn <?php echo ($i == 0) ? 'btn-primary' : ' btn-outline-secondary '; ?> " data-tab="tab-<?=$item['ID'];?>"><?=$item['VALUE'];?></li>
	        <?php $i++; ?>
        <?php endforeach; ?>
    </ul>

    <?php $i=0 ?>

    <?php foreach($arResult['GETLIST'] as $item):  ?>
    <div class="card p-3 <?php echo ($i == 0) ? '' : 'hidden'; ?> " data-tab-content id="tab-<?=$item['ID'];?>" >
        <p>
            <?=$item['NAME'];?>
        </p>
        <p>
		    <?=$item['VALUE'];?>
        </p>
    </div>
    <?php $i++; ?>
    <?php endforeach; ?>

</div>

