<?php
include_once ('sender.php');

// Инициализация отправщика писем
$mailer = \app\sender::instance();

// Простая заготовка для письма
$text = 'Пример текста';
$subject = 'Пример заголовка';
$mail = 'test@exemple.ru';
// Отсылка письма с параметрами по умолчанию
$result = $mailer->send($mail, $subject, $text);


// Отправка письма со своим конфигом

$config = ['login' => 'text@exemple.com',
           'pass' => 'password',
           'host' => 'smtp.yandex.ru',
           'port' => '465',
           'from' => 'text@exemple.com',
           'encryption' => 'ssl'];

$mailer->init($config)->send($mail, $subject, $text);