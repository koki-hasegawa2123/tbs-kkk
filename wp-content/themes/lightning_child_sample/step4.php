<?php
session_start();
$host     = 'mysql153.phy.lolipop.lan';
$username = 'LAA1338030';   // MySQLのユーザ名
$password = 'tkjYFVqi';       // MySQLのパスワード
$dbname   = 'LAA1338030-6oacr2';   // MySQLのDB名(今回、MySQLのユーザ名を入力してください)
$charset  = 'utf8';   // データベースの文字コード
// MySQL用のDSN文字列
$dsn = 'mysql:dbname='.$dbname.';host='.$host.';charset='.$charset;

$msg = '';
$err_msg = '';

// 入力画面からのアクセスでなければ、戻す
if (!isset($_SESSION['form'])) {
  header('Location: medical.php');
  exit();
}

try {
  // データベースに接続
  $dbh = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  
    //データチェック============================================================
    //==========================================================================
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $_POST[''] = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    if (isset($_POST['next4']) === TRUE) {

      $passwd = '';
      $passwd = mt_rand(1000,9999);

      if (isset($_POST['time'])) {
        $time = $_POST['time'];
      }

      if (isset($_POST['times']) === TRUE) {
        $times = $_POST['times'];
      }

      if (isset($_POST['Reservation_datetime']) === TRUE) {
        $Reservation_datetime = $_POST['Reservation_datetime'];
      }

      $name = '';
      if (isset($_POST['name']) === TRUE) {
        $name = $_POST['name'];
      }

      $furigana = '';
      if (isset($_POST['furigana']) === TRUE) {
        $furigana = $_POST['furigana'];
      }

      $birth = '';
      if (isset($_POST['birth']) === TRUE) {
        $birth = $_POST['birth'];
      }

      $month = '';
      if (isset($_POST['pulldown-Month']) === TRUE) {
        $month = $_POST['pulldown-Month'];
      }

      $day = '';
      if (isset($_POST['pulldown-day']) === TRUE) {
        $day = $_POST['pulldown-day'];
      }

      $sex = '';
      if (isset($_POST['sex']) === TRUE) {
        $sex = $_POST['sex'];
      }

      $tel = '';
      if (isset($_POST['tel']) === TRUE) {
        $tel = $_POST['tel'];
      }

      $mail = '';
      if (isset($_POST['mail']) === TRUE) {
        $mail = $_POST['mail'];
      }

      $mail_check = '';
      if (isset($_POST['mail-check']) === TRUE) {
        $mail_check = $_POST['mail-check'];
      }

      $check3 = '';
      if (isset($_POST['check3']) === TRUE) {
        $check3 = $_POST['check3'];
      }

      $check4 = '';
      if (isset($_POST['check4']) === TRUE) {
        $check4 = $_POST['check4'];
      }

      $check5 = '';
      if (isset($_POST['check5']) === TRUE) {
        $check5 = $_POST['check5'];
      }

      $check6 = '';
      if (isset($_POST['check6']) === TRUE) {
        $check6 = $_POST['check6'];
      }

      $check7 = '';
      if (isset($_POST['check7']) === TRUE) {
        $check7 = $_POST['check7'];
      }

      $interview_3_2 = '';
      if (isset($_POST['interview_3_2']) === TRUE) {
        $interview_3_2 = $_POST['interview_3_2'];
      }

      $interview_5_2 = '';
      if (isset($_POST['interview_5_2']) === TRUE) {
        $interview_5_2 = $_POST['interview_5_2'];
      }
      
  try {
    $sql = 'INSERT INTO Reservation_data(passwd,Reservation_datetime,name,day,times,furigana,birth,birth_month,birth_day,sex,tel,mail,Interview_1,Interview_2,Interview_3_1,Interview_3_2,Interview_4,Interview_5,Interview_5_2,create_datetime) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now())';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $passwd,    PDO::PARAM_STR);
    $stmt->bindValue(2, $Reservation_datetime,    PDO::PARAM_STR);
    $stmt->bindValue(3, $name,    PDO::PARAM_STR);
    $stmt->bindValue(4, $time,    PDO::PARAM_STR);
    $stmt->bindValue(5, $times,    PDO::PARAM_STR);
    $stmt->bindValue(6, $furigana,    PDO::PARAM_STR);
    $stmt->bindValue(7, $birth,    PDO::PARAM_STR);
    $stmt->bindValue(8, $month,    PDO::PARAM_STR);
    $stmt->bindValue(9, $day,    PDO::PARAM_STR);
    $stmt->bindValue(10, $sex,    PDO::PARAM_STR);
    $stmt->bindValue(11, $tel,    PDO::PARAM_STR);
    $stmt->bindValue(12, $mail,    PDO::PARAM_STR);
    $stmt->bindValue(13, $check3,    PDO::PARAM_STR);
    $stmt->bindValue(14, $check4,    PDO::PARAM_STR);
    $stmt->bindValue(15, $check5,    PDO::PARAM_STR);
    $stmt->bindValue(16, $interview_3_2,    PDO::PARAM_STR);
    $stmt->bindValue(17, $check6,    PDO::PARAM_STR);
    $stmt->bindValue(18, $check7,    PDO::PARAM_STR);
    $stmt->bindValue(19, $interview_5_2,    PDO::PARAM_STR);
    $stmt->execute();
    //echo '登録成功しました';
  } catch (PDOException $e) {
    $err_msg[] = '購入できませんでした。理由：'.$e->getMessage();
  }

  mb_language("Japanese");
  mb_internal_encoding("UTF-8");
 
  $to = $_POST['mail'];
  $title = '予約確認';
  $message = "こちらのページからパスワードを入力して予約を完了してください。"."\n"."パスワード「".$passwd."」"."\n"."https://tbs-kkk.com/wp-content/themes/lightning_child_sample/passwd.php";
  $headers = "From: 眼成形クリニックCrarity";
 
  if(mb_send_mail($to, $title, $message, $headers))
  {
    $msg = "$name.様宛にパスワードと確認メールを送信しました。"."\n"."パスワードを送信して予約を完了してください。";
  }
  else
  {
    $err_msg = "メール送信が失敗しました。"."\n"."お手数ですが、もう一度予約をし直してください。";
  }
}
}

} catch (PDOException $e) {
  echo '接続できませんでした。理由：'.$e->getMessage();
}

$num = 1;
$sum = 1;
//$_SESSION['form'] = $_POST['form'];
//var_dump($check7);
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
height: 600px;
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
  padding-left: 30px;
  display: block;
  margin-bottom: 20px;
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
  </style>
  <title></title>
</head>
<body>
  <div class="first-visit-reception-container">
 <div class="first-visit-reception-top">
 <img src="https://tbs-kkk.com/wp-content/uploads/2021/09/img53.jpg" alt="眼形成クリニック Crarity初診受付サービス">
 </div>

 <div class="first-visit-reception-contents">
 <div class="step">
  <div class="other">①日にちを選ぶ</div><div class="other">②情報の入力</div><div class="other">③入力内容の確認</div><div class="select">④送信完了</div>
 </div>
  <div class="note">
  <table border="1">
    <tr>
    <h1>ご予約ありがとうございました。</h1><br>
    <h3><?php echo $msg; ?></h3>
    <h3 class="err"><?php echo $err_msg; ?></h3>
    </tr>
  </table>
</div>
<div class="next-button-box">
  <a href="./medical.php"><span class="return-button">戻る</span></a>
  <input type="hidden" name="time" value="<?php echo $time ?>">
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