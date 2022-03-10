<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="POST">
    <input type="text" name="s" id="s">
    <input type="submit" name="btn" id="btn" value="Найти">
</form>  
<?php
include "connect.php";
$pdo->exec("set names utf8");
    if ( 3<=strlen($_POST['s'] ) ){
        $name = trim($_POST['s']);
        $name = "%$name%";
        $stm  = $pdo->prepare("SELECT posts.title as 'title',comments.body as 'body' FROM posts,comments WHERE posts.id=comments.postId AND comments.body LIKE ?");
        $stm->execute(array($name));
        $data = $stm->fetchAll();

    }
?>
    <table>
    <tr>
      <td>Заголовок записи</td>
      <td>Комментарии</td>     
    </tr>
    <?php foreach ($data as $value) {?>
    <tr>
      <td><?php echo $value['title'];?></td>
      <td><?php echo $value['body'];?></td>    
    </tr>
    <?php } ?>
    <tr>
  </table>



</body>
</html>
