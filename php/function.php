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
function addQuery($user_name, $user_age, $user_message, $link){
    $query="INSERT INTO Registration_Data
				(name, age, text)
			VALUES
				(
				'".$user_name."',
				'".$user_age."',
				'".$user_message."'
      )
			";

    $result = mysqli_query($link,$query);
    if( $result === false ) {
        exit( print_r(mysqli_connect_errno(),true) );
    }
    return true;
}
