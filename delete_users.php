<?php

session_start();
require_once "function.php";

if (is_not_logged_in()){
    redirect_to('page_login.php');
}

if (!check_admin()) {
    if (!is_author($_GET['id'], $_GET['id'])) {
        set_flash_message('danger', 'Вы можете редактировать только свой профиль');
        redirect_to('users.php');
    }
}

$user_id = $_GET["id"];
$user = get_user_by_id($user_id);

delete($user_id);
if ($_SESSION['id'] == $user_id) {
    session_unset();
//    session_destroy();
    set_flash_message("success", "Пользователь удален");
    redirect_to('page_register.php');
} else {

    redirect_to("users.php");

}
