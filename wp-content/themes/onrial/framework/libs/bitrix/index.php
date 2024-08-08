<?php
require_once 'CRest.php';
require_once 'Logger.php';
require_once 'BitrixService.php';

$log = new Logger();
$bitrix = new BitrixService($log);

echo "<pre>";

$byEmail = $bitrix->findContactByEmail('test@test.com');
$byPhone = $bitrix->findContactByPhone('+380 98 228 2616');

$bitrix->createDeal([]);

echo 'phone';
var_dump($byPhone);

echo 'email';
var_dump($byEmail);