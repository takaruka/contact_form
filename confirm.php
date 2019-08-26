<?php
  session_start();
  require_once('db.php');

  if(isset($_POST['btn_back'])){
    $_SESSION["backname"]=$_SESSION["name"];
    $_SESSION["backgender"]=$_SESSION["gender"];
    $_SESSION["backmail"]=$_SESSION["mail"];
    $_SESSION["backcontents"]=$_SESSION["contents"];
    header('Location: input.php');
    exit;  
  }

  if(isset($_POST['btn_submit'])){
    
    //dbセット
    $dbclass = new db();
    $db=$dbclass->db_set("mysql:dbname=test;host=localhost;charaset=utf8","root","");
    
    //照合順序を変更
    $altersql="ALTER TABLE contact_form COLLATE utf8mb4_general_ci";
    $stmt=$db->prepare($altersql);
    $stmt->execute();

    //SQLセット
    $sql="INSERT INTO contact_form(id,name,gender,mail,contents)VALUES(NULL,:name,:gender,:mail,:contents)";
    $stmt=$db->prepare($sql);

    //SQLにフォーム入力値をバインド
    $stmt->bindParam(':name',$_SESSION["name"],PDO::PARAM_STR);
    $stmt->bindParam(':gender',$_SESSION["gender"],PDO::PARAM_STR);
    $stmt->bindParam(':mail',$_SESSION["mail"],PDO::PARAM_STR);
    $stmt->bindParam(':contents',$_SESSION["contents"],PDO::PARAM_STR);
    
    //実行
    $stmt->execute();

    header('Location: complete.php');
    exit;
  }

?>



<!DOCTYPE html>
<html>
  <body>
    <h1>お問い合わせフォーム(確認)</h1>
    <form action="" method="post">
      <p>名前</p>
      <?php echo $_SESSION["name"]; ?>
      <p>性別</p>
      <?php echo $_SESSION["gender"]; ?>
      <p>メールアドレス</p>
      <?php echo $_SESSION["mail"]; ?>
      <p>内容</p>
      <?php echo $_SESSION["contents"]; ?><br>
      <input type="submit" name="btn_back" value="戻る">
      <input type="submit" name="btn_submit" value="送信">
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