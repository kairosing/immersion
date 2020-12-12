<?php
session_start();
require_once "function.php";
//require_once "users.php";

$email = $_POST['email'];
$password = $_POST['password'];
//$status = $_POST['status'];
//$avatar = $_FILES['avatar'];

$username = $_POST["username"];
$job_title = $_POST["job_title"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$telegram = $_POST["telegram"];
$instagram = $_POST["instagram"];
$vk = $_POST["vk"];

//if (get_user($email)){
//    set_flash_message("danger", "Этот эл. адрес уже используется.");
//    redirect_to("create_user.php");
//}
$user_id = add_user($email, $password);
//var_dump($user_id);die();


function edit_information($username, $job_title, $phone, $address, $user_id) {
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort", "root", "");
    $sql = "UPDATE users SET username = :username, job_title = :job_title, phone = :phone, address = :address WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['username' => $username, 'job_title' => $job_title, 'phone' => $phone, 'address' => $address, 'id' => $user_id]);

    /**
     * Parameters:
     *      $user_id ini
     *      $username string
     *      $job_title string
     *      $phone string
     *      $address string
     *  Description редактировать профиль
     *  Return value: boolean
     */
}


function add_social_links($telegram, $instagram, $vk, $user_id){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort", "root", "");
    $sql = "UPDATE users SET telegram = :telegram, instagram = :instagram, vk = :vk WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['telegram' => $telegram, 'instagram' => $instagram, 'vk' => $vk, 'id' => $user_id]);

    /**
     * Parameters:
     *      $telegram string
     *      $instagram string
     *      $vk string
     *
     *  Description добавить ссылки на соц сети
     *  Return value: null
     */
}

edit_information($username, $job_title, $phone, $address, $user_id);
add_social_links($telegram, $instagram, $vk, $user_id);


//var_dump(edit_information($username, $job_title, $phone, $address, $user_id));
//var_dump(add_social_links($telegram, $instagram, $vk, $user_id));die();

//set_flash_message("success", "Пользователь успешно добавлен");
//redirect_to("users.php");