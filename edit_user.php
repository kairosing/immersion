<?php

session_start();
require_once "function.php";

$user_id = $_GET["id"];
$username = $_POST["username"];
$job_title = $_POST["job_title"];
$phone = $_POST["phone"];
$address = $_POST["address"];

edit_information($username, $job_title, $phone, $address, $user_id);
set_flash_message('success', 'Профиль успешно обновлен');
redirect_to('users.php');


