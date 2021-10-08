<?php
session_start();
$host     = 'mysql153.phy.lolipop.lan';
$username = 'LAA1338030';   // MySQLのユーザ名
$password = 'tkjYFVqi';       // MySQLのパスワード
$dbname   = 'LAA1338030-6oacr2';   // MySQLのDB名(今回、MySQLのユーザ名を入力してください)
$charset  = 'utf8';   // データベースの文字コード
// MySQL用のDSN文字列
$dsn = 'mysql:dbname='.$dbname.';host='.$host.';charset='.$charset;

$err_msg = [];

try {
  // データベースに接続
  $dbh = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  
    //データチェック============================================================
    //==========================================================================
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $_POST[''] = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    if (isset($_POST['send']) === TRUE) {
      $passwd = '';
      if (isset($_POST['passwd']) === TRUE) {
        $passwd = $_POST['passwd'];
      }
        if ($passwd === '') {
          $err_msg[] = '※パスワードを入力してください';
        }
        
        
        
        try {
          $sql = 'SELECT * FROM Reservation_data WHERE passwd = ?';
          // SQLを実行
            $stmt  = $dbh->prepare($sql);
            $stmt->bindvalue(1,$passwd);
            $stmt->execute();
            // レコードの取得
            $rows = $stmt->fetch();
            // var_dump($rows);
          } catch (PDOException $e) {
            $err_msg[] = '購入できませんでした。理由：'.$e->getMessage();
          }
          
          if (count($err_msg) === 0) {
            
            if ($rows !== FALSE) {
              // エラーがないので確認画面に移動
              $_SESSION['form'] = $_POST;
              $_SESSION['passwd'] = $passwd;
              header('Location: completion.php');
              exit();
            } else {
              $err_msg[] = 'パスワードが違います';
            }
          }

      }
    }
  
} catch (PDOException $e) {
  echo '接続できませんでした。理由：'.$e->getMessage();
}



$num = 1;
$sum = 1;
//$_SESSION['form'] = $_POST['form'];
//var_dump($passwd);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
body {
--vk-margin-element-bottom: 1.5rem;
--vk-line-height: 1.7em;
--vk-line-height-low: 1.4em;
}
body, html {
font-size: 16px;
color: #333333;
word-wrap: break-word;
}
*, ::after, ::before {
box-sizing: border-box;
}
blockquote, dl, iframe, ol, p, table, ul {
    margin-bottom: var(--vk-margin-element-bottom);
}
table {
border-collapse: collapse;
border-spacing: 0;
border-color: rgba(128,128,128,0.4);
}
.first-visit-reception-top {
width: 760px;
margin-left: auto;
margin-right: auto;
}
.first-visit-reception-contents {
width: 760px;
margin-left: auto;
margin-right: auto;
background: aliceblue;
height: 500px;
padding-top: 40px;
}
.first-visit-reception-contents p {
padding: 10px 0 0 10px;
}
.first-visit-reception-contents h6 {
padding: 10px 0 10px 40px;
background: #7dcfdc6e;
width: 730px;
display: block;
margin-left: auto;
margin-right: auto;
margin-top: 0;
border-radius: 10px 10px 0 0;
font-size: 17px;
}
.first-visit-reception-contents table {
margin-left: auto;
margin-right: auto;
width: 700px;
}
.title {
margin: 0 0 20px 0;
padding: 10px;
}
.note {
  text-align: center;
  padding: 100px 100px;
}
.step {
display: flex;
background: #eee;
width: 730px;
margin-left: auto;
margin-right: auto;
}
.select {
background: #e4cf90;
margin: 15px 10px;
padding: 10px 27px;
border-style: solid;
}
.other {
background: #f9eabe;
padding: 10px 26px;
border-style: solid;
margin: 15px 10px;
}
.calendar table thead tr, table thead td {
padding: 0px;
text-align: center;
}
.calendar tbody td {
width: 90px;
text-align: center;
}
.first-visit-reception-container {
max-width: 1903px;
}
@media screen and (max-width: 1023px) {
.first-visit-reception-container {
padding: 0;
margin: 0;
width: auto;
height: auto;
}
}
.note table td, table th {
padding: .5rem 1rem;
font-size: var(--vk-size-text-sm);
}
table td, table th {
font-size: var(--vk-size-text-sm);
}
h1, h2, h3, h4, h5, h6 {
margin-top: 0;
margin-bottom: 0;
line-height: var(--vk-line-height-low);
}
.calendar-border-bottom {
  border-bottom-style: dotted;
  border-width: 1px;
}
.sunday {
  background: rgba(255,0,0,0.1);
  color: rgba(255,0,0,0.8);
}
.button {
  padding: 0;
  border-radius: 15px;
  width: 80px;
  height: 25px;
  position: relative;
}
.button-img {
  position: absolute;
  bottom: 0.5px;
  right: 1px;
  width: 75px;
}
.err {
  color: red;
  display: block;
}
.input {
  margin-right: 5px;
}
.select-text {
  padding-left: 5px;
}
.check-text {
  padding-right: 5px;
}
.Interview-text {
  background: rgba(128,128,128,0.1);
}
.Interview-box {
  background: #ffffffeb;
}
.mail-box {
  width: 300px;
}
.td {
  width: 200px;
  background: rgba(128,128,128,0.1);
}
.textbox-no3 {
  height: 60px;
  width: 670px;
}
.next-button-box {
  text-align: center;
}
.next-button {
  padding: 5.8px 35px;
  border-radius: 20px;
  margin: 0 0 0 20px;
  color: black;
  font-size: 16px;
  background: ghostwhite;
}
.site-footer-copyright {
  text-align: center;
}
.return-button {
  padding: 5.7px 35px;
  border-radius: 20px;
  margin: 0 0 0 20px;
  background: gainsboro;
  border: solid 2px;
  color: black;
}
a {
  text-decoration: none;
}
.text {
  text-align: center;
  display: block;
  margin-bottom: 20px;
}
  </style>
  <title></title>
</head>
<body>
  <div class="first-visit-reception-container">
 <div class="first-visit-reception-top">
 <img src="https://tbs-kkk.com/wp-content/uploads/2021/09/img53.jpg" alt="眼形成クリニック Crarity初診受付サービス">
 </div>

 <div class="first-visit-reception-contents">
   <div class="note">
    <span class="text">パスワードを入力してください</span>
    <?php foreach ($err_msg as $err) { ?>
      <span class="err"><?php echo $err; ?></span>
      <?php } ?>
    <span class="err"></span>
      <table border="1">
    <tr>
    <form method="post" action="">
    <br><input type="text" name="passwd"><br><br>
    <button type="submit" name="send">送信</button>
    </tr>
  </table>
</div>
  </form>
</div>
 </div>

  <div class="site-footer-copyright">
    <p>Copyright (c) 2020 - 2021 眼形成クリニック Clarity All Rights Reserved.</p>
  </div>
 </div>
</div>
</body>
</html>