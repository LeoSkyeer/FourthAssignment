<?php
$server="localhost";
$user="root";
$password="root";

// Соеденяемся с БД
function connect(){
    global $server, $user, $password;
    $link=mysqli_connect($server, $user, $password);
    if (!$link) {
        die('Error: ' . mysqli_connect_error());
    }
    mysqli_set_charset("UTF8", $link);

    $db_selected = mysqli_select_db( "Registration", $link);
    if (!$db_selected) {
        exit( print_r(mysqli_connect_error(),true) );
    }
    return $link;
}
//
//// Вносим данные в БД
//function addQuery($user_name, $user_surname, $user_age, $user_message){
//    $query="INSERT INTO Registration
//				(name, surname, age, text, img)
//			VALUES
//				(
//				'".$user_name."',
//				'".$user_surname."',
//				'".$user_age."',
//				'".$user_message."',
//				'".'0'."',
//				'".'0'."',
//				'".'123'."'
//      )
//			";
//
//    $result = mysqli_query($query);
//    if( $result === false ) {
//        exit( print_r(mysqli_error(),true) );
//    }
//    return true;
//}