<?php
session_start();
require_once "function.php";


$email = $_POST['email'];
$password = $_POST['password'];
$status = $_POST['status'];
$avatar = $_FILES['avatar'];

$username = $_POST["username"];
$job_title = $_POST["job_title"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$telegram = $_POST["telegram"];
$instagram = $_POST["instagram"];
$vk = $_POST["vk"];

if (get_user($email)){
    set_flash_message("danger", "Этот эл. адрес уже используется.");
    redirect_to("create_user.php");
}
$user_id = add_user($email, $password);
upload_avatar($_FILES['avatar'], $user_id);



set_status($status, $user_id);
edit_information($username, $job_title, $phone, $address, $user_id);
add_social_links($telegram, $instagram, $vk, $user_id);


set_flash_message("success", "Пользователь успешно добавлен");
redirect_to("users.php");