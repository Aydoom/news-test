<?php 
header('Content-Type: text/html; charset=utf8');

/**
 * Файл загрузки базовыйх функций, автолоадера и конфигурации.
 * Конфигурация базы данных находится в файле config/bootstrap.php
 */
require_once "config/bootstrap.php";

// Файл создания таблицы с статьями
require VENDOR . "php-mysql-migration/index.php";

// Запуск приложения
require APP . "router.php";
