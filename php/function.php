<?php
$server="localhost";
$login ="root";
$password="";


// Соеденяемся с БД
function connect(){
    global $server, $login, $password;
    $link=mysqli_connect($server, $login, $password);
    if (!$link) {
        die('Error: ' . mysqli_connect_errno());
    }

    mysqli_set_charset($link, "UTF8");

    $db_selected = mysqli_select_db($link, "Registration" );
    if (!$db_selected) {
        exit( print_r(mysqli_connect_errno(),true) );
    }
    return $link;
}


//ДОбавляем данные
function addQuery($user_name, $user_age, $user_message, $name_in_db, $link){
    $query="INSERT INTO Registration_Data
				(name, age, text, img)
			VALUES
				(
				'".$user_name."',
				'".$user_age."',
				'".$user_message."',
				'".$name_in_db."'
      )
			";

    $result = mysqli_query($link,$query);
    if( $result === false ) {
        exit( print_r(mysqli_connect_errno(),true) );
    }
    return true;
}

//Сохраняем картинку
$path = 'photos/';
$ext = array_pop(explode('.',$_FILES['fileToUpload']['name'])); // расширение
$new_name = time().'.'.$ext; // новое имя с расширением
$full_path = $path.$new_name; // полный путь с новым именем и расширением
$name_in_db = substr($new_name, 0, -4);

if($_FILES['fileToUpload']['error'] == 0){
    if(substr($_FILES["fileToUpload"]["name"], -3)=="jpg" || substr($_FILES["file"]["name"], -3)=="png"){
    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $full_path)){
        echo "Картинка загружена, регистрация прошла успешно";
    }else{
        echo "Warning";
    }
    }
}

// Авторизация

function Autorization($e_login, $link) {
    if (isset($_POST['setLogin'])){
        $query=mysqli_query($link, "SELECT name FROM Registration_Data WHERE name='$e_login'");
        $user_data = mysqli_fetch_array($query);
        if ($user_data['name']== $e_login){
            $_SESSION["is_auth"] = true;
        } else {
            $_SESSION["is_auth"] = false;
        }
    }
}

// Создаем сессию
function isAuth() {
    if (isset($_SESSION["is_auth"])) { //Если сессия существует
        return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
    }
    else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
}

// Закрываем соединение
function close($link){
    mysqli_close($link);
}

// Выходим из сессии
function logout() {
    $_SESSION = array(); //Очищаем сессию
    session_destroy(); //Уничтожаем
}

define('WEB_DOMAIN','http://building-a-bootstrap-contact-form-using-php-and-ajax-master');
define('WEB_FOLDER','/');

function myUrl($url='',$fullurl=false){
    $s=$fullurl ? WEB_DOMAIN : '';
    $s.=WEB_FOLDER.$url;
    return $s;
}

function redirect($url){
    header( 'Location: '.myUrl($url) );
    exit;
}
