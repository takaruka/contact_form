<?php
  session_start();
  require_once('validate.php');

  if(isset($_POST['btn_confirm'])){  

    //戻るボタンから引き継いだセッションを削除
    unset($_SESSION['backname'],$_SESSION['backgender'],$_SESSION['backmail'],$_SESSION['backcontents']);

    //Varidateクラスを読み込む
    $check = new Validate();
    
    //空白チェック
    $errors['name']= $check->empty_check($_POST['name'],"名前");
    $errors['mail']= $check->empty_check($_POST['mail'],"メールアドレス");
    $errors['contents']= $check->empty_check($_POST['contents'],"内容");

    //文字数チェック
    $errors['namemax']= $check->max_check($_POST['name'],20,"名前");
    $errors['contentsmax']= $check->max_check($_POST['contents'],100,"内容");

    //メールの形式チェック
    $errors['mailformat']= $check->mailformat_check($_POST['mail']);

    //空白を取り除く
    $errors = array_filter($errors, 'strlen');

    if (empty($errors)) {
      $_SESSION=$_POST;

      header('Location: confirm.php');
      exit;  
    } 
  }

?>

<!DOCTYPE html>
<html>
  <body>
    <h1>お問い合わせフォーム</h1>
    <form action="" method="post">
      <p>名前を入力してください</p>
      <input type="text" name="name" 
      value="<?php if(!empty($_POST['name'])) {echo $_POST['name'];}if(!empty($_SESSION['backname'])) {echo $_SESSION['backname'];}?>"
       class="nameText">
      <?php 
        if(!empty($errors['name'])){
          echo '<span class="errorMessage">'.$errors['name'].'</span>';
        }
        if(!empty($errors['namemax'])){
          echo '<span class="errorMessage">'.$errors['namemax'].'</span>';
        }
      ?>
      <br>
      <p>性別を選択してください</p>
      <select name="gender">
      <option value="男性" 
      <?php if(!empty($_POST['gender'])&&$_POST['gender']=="男性") {echo 'selected';}
      if(!empty($_SESSION['backgender'])&&$_SESSION['backgender']=="男性") {echo 'selected';}?>>男性</option>
      <option value="女性" 
      <?php if(!empty($_POST['gender'])&&$_POST['gender']=="女性") {echo 'selected';}
      if(!empty($_SESSION['backgender'])&&$_SESSION['backgender']=="女性") {echo 'selected';}?>>女性</option>
      </select>
      <br>
      <p>メールアドレスを入力してください</p>
      <input type="text" name="mail" 
      value="<?php if(!empty($_POST['mail'])) {echo $_POST['mail'];}if(!empty($_SESSION['backmail'])) {echo $_SESSION['backmail'];}?>" 
      class="mailText">
      <?php 
        if(!empty($errors['mail'])){
          echo '<span class="errorMessage">'.$errors['mail'].'</span>';
        }
        if(!empty($errors['mailformat'])){
          echo '<span class="errorMessage">'.$errors['mailformat'].'</span>';
        }
      ?>
      <br>
      <p>内容を入力してください</p>
      <textarea name="contents" class="contentsText"><?php if(!empty($_POST['contents'])) {echo $_POST['contents'];}if(!empty($_SESSION['backcontents'])) {echo $_SESSION['backcontents'];}?></textarea>
      <?php 
        if(!empty($errors['contents'])){
          echo '<span class="errorMessage">'.$errors['contents'].'</span>';
        }
        if(!empty($errors['contentsmax'])){
          echo '<span class="errorMessage">'.$errors['contentsmax'].'</span>';
        }
      ?>
      <br>
      <input type="submit" name="btn_confirm" value="送信する">
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

  .nameText{
    width: 180px;
  }
  
  .mailText{
    width: 400px;
  }

  .contentsText{
    width: 500px;
    height: 200px;
  }

  .errorMessage{
    color: red;
    padding-right:20px
  }
</style>

<?php//git練習用 ?>