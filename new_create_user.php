<?php
session_start();
//require_once "edit_user.php";
require_once "users.php";

$username = $_POST["username"];
$job_title = $_POST["job_title"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$telegram = $_POST["telegram"];
$instagram = $_POST["instagram"];
$vk = $_POST["vk"];


function edit_information($username, $job_title, $phone, $address)
{
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort", "root", "");
    $sql = "INSERT INTO information(username, job_title, phone, address) VALUES (:username, :job_title, :phone, :address)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['username' => $username, 'job_title' => $job_title, 'phone' => $phone, 'address' => $address]);

}

function add_social_links($telegram, $instagram, $vk){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort", "root", "");
    $sql = "INSERT INTO social_links (telegram, instagram, vk) VALUES (:telegram, :instagram, :vk)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['telegram' => $telegram, 'instagram' => $instagram, 'vk' => $vk]);
}

edit_information($username, $job_title, $phone, $address);

add_social_links($telegram, $instagram, $vk);

//set_flash_message("success", "Пользователь успешно добавлен");
//redirect_to("users.php");