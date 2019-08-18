<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
	'PARAMETERS' => array(
		'CACHE_TIME'  =>  Array('DEFAULT'=>36000000),
		'CACHE_GROUPS' => array(
			'PARENT' => 'CACHE_SETTINGS',
			'NAME' => GetMessage('CP_BND_CACHE_GROUPS'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'Y',
		),
		'VK' => array(
			'NAME' => GetMessage('VKONTAKTE'),
			'TYPE' => 'STRING',
			'DEFAULT' => 'http://vkontakte.ru/aspro74'
		),
		'FACE' => array(
			'NAME' => 'Facebook',
			'TYPE' => 'STRING',
			'DEFAULT' => 'http://www.facebook.com/aspro74'
		),
		'TWIT' => array(
			'NAME' => 'Twitter',
			'TYPE' => 'STRING',
			'DEFAULT' => 'http://twitter.com/aspro_ru'
		),
	),
);
?>
