<?php



function get_user($email){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort","root","");
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function get_userAll(){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort","root","");
    $sql = "SELECT * FROM users LEFT JOIN information ON users.id = information.user_id LEFT JOIN social_links  ON users.id = social_links.user_id";
    //"SELECT * FROM users INNER JOIN information";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}


function add_user($email, $password){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort","root","");
    $sql = "INSERT INTO users(email,password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email, 'password' => $password]);
    $user_id = get_user($email);
    return $user_id['id'];

    /**
     * Parameters:
     *      $email string
     *      $password string
     *
     *  Description добавить пользователя
     *  Return value: int (user_id)
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
        //var_dump(1);die();
        set_flash_message('danger', 'такого пользователя не существует');
        return false;
    }
    elseif(!cheak_password($user, $password)) {
       // var_dump(2);die();
       set_flash_message('danger' ,'пароль не верный');
       return false;
    } else {
       // var_dump(3);die();
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

function get_user_by_id($id){
    $pdo = new PDO("mysql:host=localhost;dbname=get_fort", "root", "");
    $sql = "SELECT * FROM users WHERE id =:id";
    $params = [
        ':id' => $id
    ];
    $statement = $pdo->prepare($sql);
    $statement->execute($params);
    return $statement->fetch();

}

/**
 * Parameters:
 *      $user_id int
 *
 *  Description получить пользователя по id
 *  Return value: array
 */



