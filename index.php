<?php
ini_set('session.use_cookies',1);
ini_set('session.use_only_cookies',1);
session_start();
require_once ('php\function.php');

if (isset($_POST['add_user'])){
    if(empty($_POST['user_name']) || empty($_POST['user_age']) || empty($_POST['user_message'])) exit ("Данные отсутствуют");


    $link=connect();
    addQuery($_POST["user_name"], $_POST["user_age"],$_POST["user_message"], $link);
//    addQuery_2($link);
    
    mysqli_close ($link);
}

if (isset($_POST["setLogin"])){
    $link=connect();
    Autorization($_POST["userLogin"], $link);
    close($link);
    redirect('index.php');
}

if (isset($_POST["setExit"])){
    logout();
}


?>

<!doctype html>
<html lang="RU-ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">

</head>
<body style="background-color:whitesmoke;">


<div class="row">
    <!-- Заголовок -->
    <div class="col-md-3 col-md-offset-4">
        <p class="h1" style="text-align: center">Регистрация</p>
    </div>

    <form role="form" class="shake" action="index.php" method="POST" id="loginPassword" data-toggle="validator" name="setLogin" enctype="multipart/form-data">
        <?php
        if(isAuth()){
            echo 'Вы успешно авторизованы <input type="submit" name="setExit" class="btn btn-success btn-xs" value="выход">';
        }else{
            echo '
  <div class="col-md-2 col-md-offset-9" >
  		<div class="well" style="background-color:lightgrey" >
  					<div class="row">
  							<div class="form-group col-md-12">
  									<label for="login">Имя</label>
  									<input id="login" type="text" name="userLogin" placeholder="Login" class="form-control">
  									<div class="help-block with-errors"></div>
  							</div>
  						
                    	<input type="submit" class="col-md-12 btn btn-xs btn-success" value="Login" name="setLogin">
  					</div>

  					<div id="msgSubmit" class="h3 text-center hidden">
            </div>
  </div>';}
        ?>
    </form>
    </div>

<div class="col-sm-5 col-sm-offset-3">
    <?php
        if (isAuth()){
            echo '
        <div class="well" style="margin-top: 0%; background-color:lightgrey">
        <h3 style="text-align: center;">Зарегистрированные картиночки</h3>
        <form role="form" id="contactForm"  class="shake" action="index.php" method="POST" enctype="multipart/form-data">
          
            
          <div class="col-md-12 col-md-offset-0">';
            $link = connect();
            $arr=getData($link);
            foreach ($arr as $value){
           echo ' <div class="well">
            
                <div class="row">
                
                  <div class="col-md-4">
                    <p>Имя пользователя:</p>
                  </div>
                  
                  <div class="col-md-4">
                    <p> '.$value["name"].'</p>      
                  </div>
                     
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <p>Картинка:</p>
                  </div>
                  
                  <div class="col-md-4">
                    <p></p>
                  </div>
                      
                  <div class="col-md-offset-10 ">
                     <a href="/php/edit.php?id='.$value["id"].'">Редактировать</a>
                  </div>
                  

                  
                  <!--<div class="col-md-offset-10">
                     <a href="/index.php?action=accept&id=">Подтвердить</a>
                  </div>-->
                    
                 </div>
            </div>';}
          echo '</div>
        
         <div class="clearfix"></div>
        </form>
   </div>';
        }else{
            echo '<div class="well" style="margin-top: 0%; background-color:lightgrey">
        <h3 style="text-align: center;">Регистрационные данные</h3>
        <form role="form" id="contactForm"  class="shake" action="index.php" method="POST" enctype="multipart/form-data">
            <!-- Имя -->
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="name" class="h4">Имя</label>
                    <input name="user_name" type="text" class="form-control" id="name" placeholder="Введите свое имя" data-error="Забыли как вас зовут?" required pattern="^[А-Яа-яЁё\s]+$">
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <!--Возраст-->
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="age" class="h4">Возраст</label>
                    <input name="user_age" type="text" class="form-control" id="age" placeholder="Введите ваш возраст" data-error="Забыли сколько вам лет?" required pattern="^[ 0-9]+$" >
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

            <!-- О себе -->
            <div class="row">
            <div class="form-group col-sm-12">
                <label for="message" class="h4">О себе</label>
                <textarea name="user_message" id="message" class="form-control" rows="5" placeholder="Напишите немного о себе"  data-error="Необходимо написть хоть что-нибудь" required></textarea>
            </div>
            </div>

            <!--Кнопка-->
            <div class="row">
                <div class="form-group col-sm-12 col-sm-offset-0">
                    <input type="submit" class="col-xs-12 btn btn-md btn-success" value="Зарегистрироваться" name="add_user">
                </div>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>';
        }
    ?>

</div>




<?php



?>

</body>
</html>