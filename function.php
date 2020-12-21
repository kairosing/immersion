<?php

function get_user($email){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort","root","");
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email]);
    $user_id = $statement->fetch(PDO::FETCH_ASSOC);
    return $user_id;

}

function get_userAll(){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort","root","");
    $sql = "SELECT * FROM users";
    // $sql = "SELECT * FROM users LEFT JOIN information ON users.id = information.user_id LEFT JOIN social_links  ON users.id = social_links.user_id";
    //"SELECT * FROM users INNER JOIN information";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

function get_userOne(){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort","root","");
    $sql = "SELECT * FROM users";
   // INNER JOIN information ON users.id = information.user_id INNER JOIN social_links  ON users.id = social_links.user_id
    //"SELECT * FROM users INNER JOIN information";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function get_userAlter(){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort","root","");
    $sql = "ALTER TABLE users INNER JOIN information ON users.id = information.user_id INNER JOIN social_links  ON users.id = social_links.user_id";
    //"SELECT * FROM users INNER JOIN information";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function add_user($email, $password){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort","root","");
    $sql = "INSERT INTO users(email,password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email, 'password' => $password]);
    return $pdo->lastInsertId();
    /**
     * Parameters:
     *      $email string
     *      $password string
     *
     *  Description добавить пользователя
     *  Return value: int (user_id)
     */

}


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

function set_flash_message($status, $message){
    $_SESSION['status'] = $status;
    $_SESSION['message'] = $message;
}

function redirect_to($path){
    header("Location: {$path}");
    exit;
}

function login ($email, $password){
    $user = get_user($email);
    if (empty($user)) {
        set_flash_message('danger', 'такого пользователя не существует');
        return false;
    }
    elseif(!cheak_password($user, $password)) {
       set_flash_message('danger' ,'пароль не верный');
       return false;
    } else {
        $_SESSION['email'] = $user['email'];
        $_SESSION['admin'] = $user['admin'];
        return true;
    }
}

 function cheak_password($user, $password){

     if ($user['password'] == $password){
         return true;
     }
     return false;
 }

function display_flash_message($status)
{
    if (isset($_SESSION['status'])) {
        echo "<div class=\"alert alert-{$status} text-dark\" role=\"alert\">{$_SESSION['message']}</div>";
        unset($_SESSION['status']);
        unset($_SESSION['message']);
    }
}

function set_status($status, $user_id){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort", "root", "");
    $sql = "UPDATE users SET status = :status WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['status' => $status , 'id' => $user_id]);

}
/**
 * Parameters:
 *      $status string
 *
 *  Description установить статус
 *  Return value: null
 */

function upload_avatar($avatar, $user_id){
   $name = $avatar['name'];
    $tmp_name = $avatar['tmp_name'];
   move_uploaded_file($tmp_name,"img/avatars/" . $name);
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort", "root", "");
    $sql = "UPDATE users SET avatar = :avatar WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['avatar' => $avatar , 'id' => $user_id]);
}

/**
 * Parameters:
 *      $image array
 *
 *  Description загрузить аватар
 *  Return value: null | string (path)
 */

function is_not_logged_in(){
    if (isset($_SESSION['email']) && !empty($_SESSION['email'])){
        return false;
    }
    return true;
}


function check_admin(){
    if ($_SESSION['admin']) {

        return true;
    }
    return false;
}


function is_author($logged_user_id, $edit_user_id){}

/**
 * Parameters:
 *      $logger_user_id int
 *      $edit_user_id int
 *
 *  Description проверить, автор текущий авторизованный рользователь
 *  Return value: boolean
 */

function get_user_by_id($user_id){

    $pdo = new pdo("mysql:host=localhost;dbname=get_fort","root","");
    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $user_id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

/**
 * Parameters:
 *      $user_id int
 *
 *  Description получить пользователя по id
 *  Return value: array
 */



