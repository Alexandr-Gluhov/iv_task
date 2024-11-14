<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/iv_task/.core/index.php');

unset($_SESSION['USER_ID']);

header("Location: /iv_task/authentication/login.php");
die();