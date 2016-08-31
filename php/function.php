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

//ДОбавляем данные Registration_Data
function addQuery($user_name, $user_age, $user_message, $name_in_db, $link){
    $query="INSERT INTO Registration_Data
				(name, age, text)
			VALUES
				(
				'".$user_name."',
				'".$user_age."',
				'".$user_message."'
      )
			";
    $query_2 = "INSERT INTO Image_Data
				(user_id, image)
			VALUES
				(
				(SELECT id FROM Registration_Data WHERE NAME='".$user_name."'),
				'".$name_in_db."'
      )
			";

//    print_r($query_2);
    $result = mysqli_query($link,$query);
    $result_2 = mysqli_query($link,$query_2);
    if( $result === false ) {
        exit( print_r(mysqli_connect_errno(),true) );
    }
    return true;
}



//Сохраняем картинку
    $path = 'photos/';
        $ext = array_pop(explode('.', $_FILES['fileToUpload']['image'])); // расширение
        $new_name = time() . '.' . $ext;

        $full_path = $path . $new_name;

        $name_in_db = substr($new_name, 0, -1);


        if ($_FILES['fileToUpload']['error'] == 0) {
            if (substr($_FILES["fileToUpload"]["name"], -3) == "jpg" || substr($_FILES["file"]["name"], -3) == "png") {
                if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $full_path)) {
                    echo "Регистрация прошла успешно";
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

//Получаем данные
function getData($link){
    $sql = "SELECT Registration_Data.id, Registration_Data.name, Image_Data.image FROM Registration_Data INNER JOIN Image_Data ON Registration_Data.id=Image_Data.user_id";
    $stmt = mysqli_query($link, $sql);
    if ($stmt === false) {
        exit(print_r(mysqli_errno($link), true));
    }
    while ($row = mysqli_fetch_array( $stmt, MYSQLI_ASSOC )) {
        $arr[] = $row;
    }

    return $arr;

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


// Редактирование
function getText1($id, $link){
    $sql = "
       SELECT
         image
       FROM
         Image_Data
      WHERE user_id=".$id;

    $stmt = mysqli_query($link, $sql);
    if( $stmt === false ) {
        exit( print_r(mysqli_errno($link),true) );
    }

    return mysqli_fetch_array( $stmt, MYSQLI_ASSOC );
}

// Сохранение
function saveText($id, $image, $link){
    $sql = "
   				UPDATE
   					Image_Data
   				SET
   					image = '".$image."'
   				WHERE
   					user_id = ".$id;

    $stmt = mysqli_query($link, $sql );
    if( $stmt === false ){
        exit( print_r(mysqli_errno($link),true));
    }
    return true;
}


function delete($id, $link){
    $del = "
                DELETE FROM 
                    Image_Data
                WHERE
                    id = ".$id;

    $stmt = mysqli_query($link, $del );
    if( $stmt === false ){
        exit( print_r(mysqli_errno($link),true));
    }
    return true;
}
