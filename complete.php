<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <body>
    <h1>お問い合わせフォーム(完了)</h1>
    <form action="input.php" method="post">
    <p>名前</p>
    <?php echo $_SESSION["name"]; ?>
    <p>性別</p>
    <?php echo $_SESSION["gender"]; ?>
    <p>メールアドレス</p>
    <?php echo $_SESSION["mail"]; ?>
    <p>内容</p>
    <?php echo $_SESSION["contents"]; ?><br>
    <input type="submit" value="入力画面へ">
    </form>
  </body>
</html>

<style>
  
  h1{
    font-family:serif;
    font-weight:bold;
    font-size:40px;
  }

  p{
    font-family:serif;
    font-weight:bold;
    font-size:20px;
  }

</style>