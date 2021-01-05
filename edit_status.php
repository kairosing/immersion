<?php
session_start();
require_once "function.php";

$status = $_POST['status'];
$user_id = $_POST["id"];

//var_dump($status, $user_id);die();

    set_status($status, $user_id);
    set_flash_message("success", "статус изменнен");
    redirect_to("page_profile.php?id=".$user_id);
