<?php

require_once ('function.php');

if ( isset($_POST["deleteEditText"])){

    $link=connect();
    delete($_GET["id"], $link);
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

<body style="background-color: #bebebe">

<div class="col-sm-4 col-sm-offset-4" style="margin-top:250px">
    <div class="well" style="margin-top: 5%;">
        <h3 class="text-center" style="padding-bottom: 40px">Вы уверены, что хотите удалить картинку?</h3>
        <form role="form" id="contactForm" data-toggle="validator" class="shake" action="<?php echo "confirm.php?id=".$_GET["id"];?>" method="POST" enctype="multipart/form-data">

            <!-- Кнопы -->
            <input type="submit" id="form-submit" class="btn btn-success btn-md pull-left " value="Не уверен" name="goBack">
            <input type="submit" id="form-submit" class="btn btn-danger btn-md pull-right" value="Удалить!" name="deleteEditText">
            <div class="clearfix"></div>
        </form>
    </div>
</div>
</div>
</body>
</html>
