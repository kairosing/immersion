<?php

session_start();
require_once "function.php";

$user_id = $_POST["id"];
$email = $_POST['email'];
$password = $_POST['password'];



 if(empty(get_user($email))){
     edit_credentials($user_id, $email);
     set_flash_message("success", "профиль успешно изменнен");
     redirect_to("users.php");
}  else {
     set_flash_message("danger", "профиль занят");
     redirect_to("security.php");
 }

