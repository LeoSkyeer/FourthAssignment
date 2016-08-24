<?php

require_once ('php/function.php');

if ( isset($_POST["add-user"])){
    if (empty($_POST["user_name"]) || empty($_POST["user_surname"]) || empty($_POST["user_age"])|| empty($_POST["user_message"])) exit ("Данные отсутствуют");

    $link=connect();
    addQuery($_POST["user_name"], $_POST["user_surnam"], $_POST["user_age"], $_POST["user_message"]);
    close($link);
}

//if (isset($_POST["setLogin"])){
//    $link=connect();
//    Autorization($_POST["userLogin"], $_POST["userPassword"]);
//    close($link);
//    redirect('index.php');
//}
//
//if (isset($_POST["setExit"])){
//    logout();
//}
//
//if (isset($_GET["action"])&&($_GET["action"]=="accept")&&isAuth()){
//    $link=connect();
//    saveAccept($_GET["id"]);
//    close($link);
//}


?>

<!doctype html>
<html lang="RU-ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css.css">
    <link rel="stylesheet" href="/css/animate.css.css">
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<!--    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
</head>
<body style="background-color:whitesmoke;">
<div class="col-sm-3 col-sm-offset-4">
    <div class="well" style="margin-top: 10%; background-color:lightsteelblue">
        <h3 style="text-align: center;">Регистрация</h3>
        <form role="form" id="contactForm" data-toggle="validator" class="shake" action="index.php" method="POST" enctype="multipart/form-data">

            <div class="row">
                <!-- Имя -->
                <div class="form-group col-sm-12">
                    <label for="name" class="h4">Имя</label>
                    <input name="user_name" type="text" class="form-control" id="name" placeholder="Введите свое имя" data-error="Забыли как вас зовут?" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="row">
                <!-- Фамилия -->
                <div class="form-group col-sm-12">
                    <label for="surname" class="h4">Фамилия</label>
                    <input name="user_surnam" type="text" class="form-control" id="surname" placeholder="Введите свою фамилию" data-error="Забыли свою фамилию?" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <!--Возраст-->
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="age" class="h4">Возраст</label>
                    <input name="user_age" type="text" class="form-control" id="age" placeholder="Введите ваш возраст" data-error="Забыли сколько вам лет?" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <!--Картинка-->
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="fileToUpload" class="h4">Загрузить картинку</label>
            <input type="file" class="file" name="fileToUpload" id="fileToUpload">
                </div>
            </div>
            <!-- Сам отзыв -->
            <div class="row">
            <div class="form-group col-sm-12">
                <label for="message" class="h4">О себе</label>
                <textarea name="user_message" id="message" class="form-control" rows="5" placeholder="Напишите немного о себе"  data-error="Необходимо написть хоть что-нибудь" required></textarea>
                <div class="help-block with-errors"></div>
            </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3 col-sm-offset-3">
                    <input type="submit" class="btn btn-default" value="Зарегистрироваться" name="add-user">
                </div>
            </div>
            <div id="msgSubmit" class="h3 text-center hidden"></div>

            <div class="clearfix"></div>
        </form>
    </div>
</div>
</div>




<?php



?>

</body>
</html>