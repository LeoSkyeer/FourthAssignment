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
        exit( print_r(mysqli_error(),true) );
    }
    return $link;
}
