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

// 入力画面からのアクセスでなければ、戻す
if (!isset($_SESSION['form'])) {
  header('Location: medical.php');
  exit();
} else {
  $_POST = $_SESSION['form'];
  $time = $_SESSION['time'];
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
    // 受け取り処理

    if (isset($_POST['next']) === TRUE) {

      if (isset($_POST['time'])) {
        $time = $_POST['time'];
      }

      if (isset($_POST['times']) === TRUE) {
        $times = $_POST['times'];
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
    }
  }

  try {
    $sql = 'SELECT * FROM Reservation_reception';
    // SQLを実行
    $stmt  = $dbh->prepare($sql);
    $stmt->execute();
    // レコードの取得
    $rows = $stmt->fetchAll();
    // var_dump($rows);
  } catch (PDOException $e) {
    $err_msg[] = '購入できませんでした。理由：'.$e->getMessage();
  }

} catch (PDOException $e) {
  echo '接続できませんでした。理由：'.$e->getMessage();
}

$num = 1;
$sum = 1;
//$_SESSION['form'] = $_POST['form'];
//var_dump($POST['time']);
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
}
.first-visit-reception-contents p {
padding: 10px 0 0 10px;
}
.check-title {
  text-align: center;
  padding: 0px 0 20px 10px;
  display: block;
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
margin: 0;
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
  cursor: pointer;
}
.r-button {
  padding: 5.8px 35px;
  border-radius: 20px;
  margin: 0 0 0 20px;
  color: black;
  font-size: 16px;
  background: gainsboro;
  cursor: pointer;
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

      <div class="title">
        <h6>眼形成クリニック Clarity</h6>
      </div>

      <div class="step">
        <div class="other">①日にちを選ぶ</div><div class="other">②情報の入力</div><div class="select">③入力内容の確認</div><div class="other">④送信完了</div>
      </div>

      <div class="title">
        <h6>情報入力</h6>
      </div>

      <span class="check-title">こちらの内容でよろしければ決定ボタンを押してください。</span>

      <?php foreach ($err_msg as $err) { ?>
        <span class="err">※<?php echo $err; ?></span>
      <?php } ?>

      <div class="note">
        <table border="1">
          <tr>
            <td class="td">診療日</td>
            <form method="post" action="step4.php">
            <td>2021年<?php echo $rows[0]['Reservation_datetime'] ?><?php echo $time ?>日</td>
            <input type="hidden" name="Reservation_datetime" value="9月">
            <input type="hidden" name="time" value="<?php echo $time; ?>">
          </tr>

          <tr>
            <td class="td">診療時間帯</td>
            <td>
              <?php echo htmlspecialchars($_POST['times']); ?>
              <input type="hidden" name="times" value="<?php echo htmlspecialchars($_POST['times']); ?>">
            </td>
          </tr>
        </table>
      </div>

      <p>患者様情報</p>
      
      <div class="note">
        <table border="1">
          <tr>
            <td class="td">氏名</td>
            <td><?php echo htmlspecialchars($_POST['name']); ?></td>
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
          </tr>

          <tr>
            <td class="td">氏名（フリガナ）</td>
            <td><?php echo htmlspecialchars($_POST['furigana']); ?></td>
            <input type="hidden" name="furigana" value="<?php echo htmlspecialchars($_POST['furigana']); ?>">
          </tr>

          <tr>
            <td class="td">生年月日</td>
            <td><span><?php echo htmlspecialchars($_POST['birth']); ?>年</span>
              <span><?php echo htmlspecialchars($_POST['pulldown-Month']); ?>月</span>
              <span><?php echo htmlspecialchars($_POST['pulldown-day']); ?>日</span>
              <input type="hidden" name="birth" value="<?php echo htmlspecialchars($_POST['birth']); ?>">
              <input type="hidden" name="pulldown-Month" value="<?php echo htmlspecialchars($_POST['pulldown-Month']); ?>">
              <input type="hidden" name="pulldown-day" value="<?php echo htmlspecialchars($_POST['pulldown-day']); ?>">
            </td>
          </tr>

          <tr>
            <td class="td">性別</td>
            <td><?php echo htmlspecialchars($_POST['sex']); ?></td>
            <input type="hidden" name="sex" value="<?php echo htmlspecialchars($_POST['sex']); ?>">
          </tr>
        </table>

        <p>ご連絡先</p>
        <table border="1">
          <tr>
            <td class="td">お電話番号</td>
            <td><?php echo htmlspecialchars($_POST['tel']); ?></td>
            <input type="hidden" name="tel" value="<?php echo htmlspecialchars($_POST['tel']); ?>">
          </tr>

          <tr>
            <td class="td">メールアドレス</td>
            <td><?php echo htmlspecialchars($_POST['mail']); ?></td>
            <input type="hidden" name="mail" value="<?php echo htmlspecialchars($_POST['mail']); ?>">
          </tr>
        </table>

        <p>診療の参考となりますのでご記入ください。</p>
        <table border="1">
          <tr>
            <th class="Interview-text">１.いつごろから症状がありますか？</th>
          </tr>

          <tr>
            <td class="Interview-box">
            <?php echo htmlspecialchars($_POST['check3']); ?>
            <input type="hidden" name="check3" value="<?php echo htmlspecialchars($_POST['check3']); ?>">
            </td>
          </tr>

          <tr>
            <th class="Interview-text">２.どちらの目ですか？</th>
          </tr>

          <tr>
            <td class="Interview-box">
            <?php echo htmlspecialchars($_POST['check4']); ?>
            <input type="hidden" name="check4" value="<?php echo htmlspecialchars($_POST['check4']); ?>">
            </td>
          </tr>

          <tr>
            <th class="Interview-text">３－１.どのような症状ですか？</th>
          </tr>

          <tr>
            <td class="Interview-box">
              <?php $check5 = $_POST['check5'] ?>
              <?php foreach ($check5 as $checked) { ?>
                <?php echo $checked; ?>
                <input type="hidden" name="check5" value="<?php echo $checked; ?>">
              <?php } ?>
            </td>
          </tr>

          <tr>
            <th class="Interview-text">３－２．【その他】の症状の場合は、ご記入下さい。</th>
          </tr>

          <tr>
            <td class="Interview-box"><?php echo htmlspecialchars($_POST['interview_3_2']); ?></td>
            <input type="hidden" name="interview_3_2" value="<?php echo htmlspecialchars($_POST['interview_3_2']); ?>">
          </tr>

          <tr>
            <th class="Interview-text">４.メガネやコンタクトレンズを使用していますか？</th>
          </tr>

          <tr>
            <td class="Interview-box">
              <?php echo htmlspecialchars($_POST['check6']); ?>
              <input type="hidden" name="check6" value="<?php echo htmlspecialchars($_POST['check6']); ?>">
            </td>
          </tr>

          <tr>
            <th class="Interview-text">５－１.当院をどのように知りましたか？</th>
          </tr>

          <tr>
            <td class="Interview-box">
            <?php $check7 = $_POST['check7'] ?>
            <?php foreach ($check7 as $checked2) { ?>
            <?php echo $checked2; ?>
            <input type="hidden" name="check7" value="<?php echo $checked2; ?>">
            <?php } ?>
            </td>
          </tr>

          <tr>
            <th class="Interview-text">５－２.【紹介】にチェックされたかのみ、ご記入下さい。</th>
          </tr>

          <tr>
            <td class="Interview-box"><?php echo htmlspecialchars($_POST['interview_5_2']); ?></td>
            <input type="hidden" name="interview_5_2" value="<?php echo htmlspecialchars($_POST['interview_5_2']); ?>">
          </tr>

        </table>
      </div>

      <div class="next-button-box">
        <input type="submit" class="r-button" name="next" value="戻る" formaction="/wp-content/themes/lightning_child_sample/step2.php" formmethod="POST"/>
        <button type="submit" class="next-button" name="next4">進む</button>
        <input type="hidden" name="time" value="<?php echo $time ?>">
        </form>
      </div>

      <div class="site-footer-copyright">
        <p>Copyright (c) 2020 - 2021 眼形成クリニック Clarity All Rights Reserved.</p>
      </div>

    </div>
  </div>
</body>
</html>