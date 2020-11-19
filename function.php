<?php
function get_user_by_email($email){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort","root","");
    $sql = "SELECT * FROM users WHERE email=:email";

    $statement = $pdo->prepare($sql);
    $statement->execute(['email'  =>    $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;

}

function set_flash_message($name, $message){
    $_SESSION[$name] = $message;
}

function redirect_to($path){
    header("Location: {$path}");
    exit;
}

function add_user($email, $password){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort","root","");
    $sql = "INSERT INTO users(email,password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

    return $pdo;
    /**
     * Parameters:
     *      $email string
     *      $password string
     *
     * Description добавить пользователя
     * Return value: int(user_id)
     */
}

function display_flash_message($name)
{
    if (isset($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{ $_SESSION[$name]}</div>";
        unset($_SESSION[$name]);
    }
}

//edit_information($username, $job_title, $phone, $address);
/**
 * Parameters:
 *      $username string
 *      $job_title string
 *      $phone string
 *      $address string
 *  Description редактировать профиль
 *  Return value: boolean
 */


function set_status($status){}
/**
 * Parameters:
 *      $status string
 *
 *  Description установить статус
 *  Return value: null
 */

function upload_avatar($image){}
/**
 * Parameters:
 *      $image array
 *
 *  Description загрузить аватар
 *  Return value: null | string (path)
 */



//add_social_links($telegram, $instagram, $vk);
/**
 * Parameters:
 *      $telegram string
 *      $instagram string
 *      $vk string
 *
 *  Description добавить ссылки на соц сети
 *  Return value: null
 */



function is_not_logger_in(){
    if (isset($_SESSION['email']) && !empty($_SESSION['email'])){
        return false;
    }
    return true;
}

function check_admin(){
    if ($_SESSION['role'] == "Администратор"){
        return true;
    }
    return false;
}








