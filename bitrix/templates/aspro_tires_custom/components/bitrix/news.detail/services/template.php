<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
$APPLICATION->SetTitle($arResult["NAME"]);
$APPLICATION->AddChainItem($APPLICATION->GetTitle());
//$APPLICATION->AddChainItem($arResult["NAME"], "");
?>
<?if($arResult["CODE"]=="shinomontazh"){?>
	<?
	function russian_date(){
		$date=explode(".", date("d.m.Y"));
		$aMonth = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');		
		return $date[0].'&nbsp;'.$aMonth[$date[1]-1].'&nbsp;'.$date[2];
	}
	?>
	<div class="module-recording">
		<div class="date-corusel">
			<span class="prev">1</span>
			<span class="next">2</span>
				<ul class="dates-list"></ul>				
		</div>
		<div class="sel-cols">
			<div class="time-col">
				<div class="t">Сегодня, <?=russian_date()?></div>
				<div class="time-lists-cols">
					<div class="list-headers">
						<div class="h l">Время</div>
						<div class="h r">Время</div>
					</div>
					<div class="list-cols">
						<ul class="time-recording-list l">
							<li>
								<div class="time">10:00	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>
							<li>
								<div class="time">10:30	</div>
								<div class="state"><a href="" class="order" data-time="10:30"><span>Записаться</span></a></div>
							</li>
							<li>
								<div class="time">11:00	</div>
								<div class="state"><a href="" class="order" data-time="11:00"><span>Записаться</span></a></div>
							</li>	
							<li>
								<div class="time">11:30	</div>
								<div class="state"><a href="" class="order" data-time="11:30"><span>Записаться</span></a></div>
							</li>	
							<li>
								<div class="time">12:00	</div>
								<div class="state"><a  href="" class="order" data-time="12:00"><span>Записаться</span></a></div>
							</li>	 
							<li>
								<div class="time">12:30	</div>
								<div class="state"><a href="" class="order" data-time="12:30"><span>Записаться</span></a></div>
							</li>	
							<li>
								<div class="time">13:30	</div>
								<div class="state"><a href="" class="order" data-time="13:00"><span>Записаться</span></a></div>
							</li> 
							<li>
								<div class="time">13:30	</div>
								<div class="state"><a href="" class="order" data-time="13:30"><span>Записаться</span></a></div>
							</li>
							<li>
								<div class="time">14:00	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>	
							<li>
								<div class="time">14:30	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>	
						</ul>
						<ul class="time-recording-list">
							<li>
								<div class="time">15:00	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>
							<li>
								<div class="time">15:30	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>
							<li>
								<div class="time">16:00	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>	
							<li>
								<div class="time">16:30	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>	
							<li>
								<div class="time">17:00	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>	
							<li>
								<div class="time">17:30	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>	
							<li>
								<div class="time">18:00	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>
							<li>
								<div class="time">18:30	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>
							<li>
								<div class="time">19:00	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>	
							<li>
								<div class="time">19:30	</div>
								<div class="state busy"><span>Время занято</span></div>
							</li>	
						</ul>
					</div>
				</div>
			</div>
			<div class="datepicker-col">
				<div id="datepicker"></div>
			</div>
		</div>		
		<div class="mass">Выберите на календаре день для записи и на шкале часов работы сервиса выберите удобное незанятое время шиномонтажа. После этого в вслывающем окне заполните небольшую форму с персональными данными.</div>
	</div>
<?}else{?>
<?//print_r($arResult["PROPERTIES"])?>
	<div class="txt-block">
		<?//print_r($arResult["PROPERTIES"])?>
		<? if ($arResult["PROPERTIES"]["ISSERVICE"]["VALUE"]=="Да"){ ?>
			<?if($arResult["PROPERTIES"]["IS_MONTAG"]["VALUE"]!="Y"){?>
				<div class="align-rights order-floating">
					<?if( !empty($arResult["DETAIL_PICTURE"]) ):?>
						<?$img = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array( "width" => 250, "height" => 191 ), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
						<a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="fancy right_link">
							<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" width="<?=$img['width']?>" height="<?=$img['height']?>" />
						</a>
					<?endif;?>
					<div class="agitation">
						<? if ($arResult["PROPERTIES"]["SERVICECOMMENT"]["VALUE"]!=""){ ?>
							<?=$arResult["PROPERTIES"]["SERVICECOMMENT"]["VALUE"];?>
						<?}else{?>
							Заполните форму заявки на сервис и наш менеджер перезвонит Вам в ближайшее время.
						<?}?>
						<a href="" class="button-30 order-popup-call" title="<?=$arResult["NAME"]?>"><span><?=($arResult["PROPERTIES"]["TEXT_ORDER"]["VALUE"]=="")? 'заказать услугу' : $arResult["PROPERTIES"]["TEXT_ORDER"]["VALUE"]?></span></a>
					</div>
				</div>
			<?}?>
		<?}else{?>
		<div>
			<?if( !empty($arResult["DETAIL_PICTURE"]) ):?>
				<?$img = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array( "width" => 250, "height" => 191 ), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
				<a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="fancy align-rights">
					<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" width="<?=$img['width']?>" height="<?=$img['height']?>" />
				</a>
			<?endif;?>
		</div>
		<?}?>		
		
	<?=$arResult["DETAIL_TEXT"]?>
<?
//print_r($arResult);
if($arResult["PROPERTIES"]["GALLERY"]["VALUE"]){
?>
<ul class="module-gallery-list">
<?
$files = $arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'];		
        if(array_key_exists('SRC', $files)) {
           // Жуткий хак, так как на одном элементе косячит
           // Заменяет первый символ пути на нечитаемый. Предполагаем, что это должен быть слеш
           $files['SRC'] = '/' . substr($files['SRC'], 1);
           // ID вообще устанавливает рандомно. Правильное значение лежит по такому пути
           $files['ID'] = $arResult['DISPLAY_PROPERTIES']['GALLERY']['VALUE'][0];
           $files = array($files);
		 //  print_r($files);
}
?>
<?foreach($files as $arFile):?>
<?
   $img = CFile::ResizeImageGet($arFile['ID'], array('width'=>175, 'height'=>125), BX_RESIZE_IMAGE_EXACT, true);
   $img = $img['src'];
$img_big = CFile::ResizeImageGet($arFile['ID'], array('width'=>800, 'height'=>600), BX_RESIZE_IMAGE_EXACT, true);
   $img_big = $img_big['src'];
?>
<li>
    <a href="<?=$img_big;?>" class="fancy" data-fancybox-group="gallery">
	<span class="zoom"></span>						 
		   <?= CFile::ShowImage($img); ?>
	</a>				  
</li>
<?endforeach;?>

</ul>
<?}
else{	
?>

<?}?>
	<? if ($arResult["PROPERTIES"]["ISSERVICE"]["VALUE"]=="Да"){ ?>
	<div class="module-order-service">
		<div class="left-data">
			<?//if($arResult["PROPERTIES"]["IS_MONTAG"]["VALUE"]!="Y"){?>
			<a href="/services/recording-on-the-tire/" class="button-30 <?=($arResult["PROPERTIES"]["IS_MONTAG"]["VALUE"]!="Y")?'order-popup-call' : ''?>"><span><?=($arResult["PROPERTIES"]["TEXT_ORDER"]["VALUE"]=="")? 'заказать услугу' : $arResult["PROPERTIES"]["TEXT_ORDER"]["VALUE"]?></span></a>
			<?//}?>
		</div>		
		<div class="right-data">
			<? if ($arResult["PROPERTIES"]["SERVICECOMMENT"]["VALUE"]!=""){ ?>
				<?=$arResult["PROPERTIES"]["SERVICECOMMENT"]["VALUE"];?>
			<?}else{?>
				Заполните форму заявки на сервис и наш менеджер <br> перезвонит Вам в ближайшее время
			<?}?>
			
		</div>
	</div>
	<?}?>
	
<?}?>
<div class="back">
	<a href="<?echo $arResult["LIST_PAGE_URL"];?>" class="button-19 back-link"><span>Вернуться</span></a>
</div>
</div>