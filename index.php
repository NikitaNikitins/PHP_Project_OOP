<?php

header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: *");

// Стартуем сессию
if (session_id() == '') {
    session_start();
}

// Выбираем и подключаем нужный шаблон
include_once "./index.html";