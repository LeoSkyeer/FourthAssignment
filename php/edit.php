<?php

require_once ('function.php');

if ( isset($_POST["saveEditText"])){
    if (empty($_POST["user_message"])) exit ("Данные отсутствуют");

    $link=connect();
    saveText($_POST["id"], $_POST["image"], $link);
    close($link);
    redirect ("index.php");
}

if ( isset($_POST["goBack"])){
    redirect ("index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Отзывы</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/normalize.css">

</head>
<?php
$link=connect();
$text=getText1($_GET["id"], $link);
close($link);

?>

<body style="background-color: #bebebe">
<!-- Редактирование  -->
<div class="col-sm-8 col-sm-offset-2">
    <div class="well" style="margin-top: 5%;">
        <h3 class="text-center">Редактирование</h3>
        <form role="form" id="contactForm" data-toggle="validator" class="shake" action="<?php echo "edit.php?id=".$_GET["user_id"];?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <textarea name="user_message" class="form-control" rows="5" placeholder=""><?=$text["image"];?></textarea>
            </div>
            <!-- Кнопы -->
            <input type="submit" id="form-submit" class="btn btn-success btn-md pull-right " value="Cохранить" name="saveEditText">
            <input type="submit" id="form-submit" class="btn btn-danger btn-md pull-left" value=" Не Cохранять" name="goBack">
            <div class="clearfix"></div>
        </form>
    </div>
</div>
</div>
</body>
</html>
