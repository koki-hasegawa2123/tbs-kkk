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

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    // 受け取り処理
    if (isset($_POST['14'])) {
      $time = $_POST['14'];
    } else if (isset($_POST['15'])) {
      $time = $_POST['15'];
    } else if (isset($_POST['17'])) {
      $time = $_POST['17'];
    } else if (isset($_POST['21'])) {
      $time = $_POST['21'];
    } else if (isset($_POST['22'])) {
      $time = $_POST['22'];
    } else if (isset($_POST['24'])) {
      $time = $_POST['24'];
    } else if (isset($_POST['27'])) {
      $time = $_POST['27'];
    } else if (isset($_POST['28'])) {
      $time = $_POST['28'];
    } else if (isset($_POST['29'])) {
      $time = $_POST['29'];
    }

    if (isset($_POST['next']) === TRUE) {

      if (isset($_POST['time'])) {
        $time = $_POST['time'];
      }

      if (isset($_POST['times']) === TRUE) {
        $times = $_POST['times'];
      }
      if ($times === '') {
        $err_msg['times'] = 'blank';
      } else if ($times !== '08:40∼08:50' && $times !== '09:00∼09:10' && $times !== '09:20∼09:30') {
        $err_msg['times'] = 'error';
      }

      $name = '';
      if (isset($_POST['name']) === TRUE) {
        $name = $_POST['name'];
      }
      if ($name === '') {
        $err_msg['name'] = 'blank';
      }

      $furigana = '';
      if (isset($_POST['furigana']) === TRUE) {
        $furigana = $_POST['furigana'];
      }
      if ($furigana === '') {
        $err_msg['furigana'] = 'blank';
      } else if (!preg_match("/^[ 　ァ-ヶ]+$/u",$furigana)) {
        $err_msg['furigana'] = 'error';
      }

      $birth = '';
      if (isset($_POST['birth']) === TRUE) {
        $birth = $_POST['birth'];
      }
      if ($birth === '') {
        $err_msg['birth'] = 'blank';
      } else if (!preg_match('/^[0-9]{4}+$/',$birth)) {
        $err_msg['birth'] = 'error';
      }

      $month = '';
      if (isset($_POST['pulldown-Month']) === TRUE) {
        $month = $_POST['pulldown-Month'];
      }
      if ($month === '') {
        $err_msg['pulldown-Month'] = 'blank';
      } else if (!ctype_digit($month)) {
        $err_msg['pulldown-Month'] = 'error';
      }

      $day = '';
      if (isset($_POST['pulldown-day']) === TRUE) {
        $day = $_POST['pulldown-day'];
      }
      if ($day === '') {
        $err_msg['pulldown-day'] = 'blank';
      } else if (!ctype_digit($day)) {
        $err_msg['pulldown-day'] = 'error';
      }

      $sex = '';
      if (isset($_POST['sex']) === TRUE) {
        $sex = $_POST['sex'];
      }
      if ($sex === '') {
        $err_msg['sex'] = 'blank';
      } else if ($sex !== '男性' && $sex !== '女性') {
        $err_msg['sex'] = 'error';
      }

      $tel = '';
      if (isset($_POST['tel']) === TRUE) {
        $tel = $_POST['tel'];
      }
      if ($tel === '') {
        $err_msg['tel'] = 'blank';
      } else if (!preg_match('/^[0-9]{3,4}[0-9]{2,4}[0-9]{3,4}+$/',$tel)) {
        $err_msg['tel'] = 'error';
      }

      $mail = '';
      if (isset($_POST['mail']) === TRUE) {
        $mail = $_POST['mail'];
      }
      if ($mail === '') {
        $err_msg['mail'] = 'blank';
      } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $err_msg['mail'] = 'error';
      }

      $mail_check = '';
      if (isset($_POST['mail-check']) === TRUE) {
        $mail_check = $_POST['mail-check'];
      }
      if ($mail_check === '') {
        $err_msg['mail_check'] = 'blank';
      } else if ($mail !== $mail_check) {
        $err_msg['mail_check'] = 'error';
      }

      $check3 = '';
      if (isset($_POST['check3']) === TRUE) {
        $check3 = $_POST['check3'];
      }
      if ($check3 === '') {
        $err_msg['check3'] = 'blank';
      } else if ($check3 !== '①今日（来院日 当日）'&&$check3 !== '②昨日（来院日 前日）'&&$check3 !== '③２、３日前'&&$check3 !== '④１週間前'&&$check3 !== '⑤それより前（１週間以上前）') {
        $err_msg['check3'] = 'error';
      }

      $check4 = '';
      if (isset($_POST['check4']) === TRUE) {
        $check4 = $_POST['check4'];
      }
      if ($check4 === '') {
        $err_msg['check4'] = 'blank';
      } else if ($check4 !== '①右目'&&$check4 !== '②左目'&&$check4 !== '③両目') {
        $err_msg['check4'] = 'error';
      }

      $check5 = '';
      if (isset($_POST['check5']) === TRUE) {
        $check5 = $_POST['check5'];
      }
      if ($check5 === '') {
        $err_msg['check5'] = 'blank';
      } 
      foreach ($check5 as $f) {
        if ($f !== '①涙が出る' && $f !== '②まぶたが下がった' && $f !== '③視力の低下' && $f !== '④歪んで見える' && $f !== '⑤黒いものが見える'&& 
            $f !== '⑥疲れ目' && $f !== '⑦痛み' && $f !== '⑧かゆみ' && $f !== '⑨異物感' && $f !== '⑩まつげが目に入る' &&
            $f !== '⑪できものができた' && $f !== '⑫充血' && $f !== '⑬健診で受診を勧められた' && $f !== '⑭めやに' && $f !== '⑮目が乾く' &&
            $f !== '⑯その他') {
          $err_msg['check5'] = 'error';
        }
      }

      $check6 = '';
      if (isset($_POST['check6']) === TRUE) {
        $check6 = $_POST['check6'];
      }
      if ($check6 === '') {
        $err_msg['check6'] = 'blank';
      } else if ($check6 !== '①メガネ'&&$check6 !== '②ハードコンタクト'&&$check6 !== '③ソフトコンタクト'&&$check6 !== '④メガネ・コンタクト両方'&&$check6 !== '⑤使用していない') {
        $err_msg['check6'] = 'error';
      }

      $check7 = '';
      if (isset($_POST['check7']) === TRUE) {
        $check7 = $_POST['check7'];
      }
      //if ($check7 === '') {
        //$err_msg['check7'] = 'blank';
      foreach ($check7 as $n) {
        if ($n !== '①広告'&&$n !== '②ホームページ'&&$n !== '③紹介') {
          $err_msg['check7'] = 'error';
        }
      }

      $interview_3_2 = '';
      if (isset($_POST['interview_3_2']) === TRUE) {
        $interview_3_2 = $_POST['interview_3_2'];
      }

      $interview_5_2 = '';
      if (isset($_POST['interview_5_2']) === TRUE) {
        $interview_5_2 = $_POST['interview_5_2'];
      }
      
      
      if (count($err_msg) === 0) {
        // エラーがないので確認画面に移動
        $_SESSION['form'] = $_POST;
        $_SESSION['time'] = $time;
        header('Location: step3.php');
        exit();
      }
    }
  } else {
    if (isset($_SESSION['form'])) {
      $_POST = $_SESSION['form'];
    }
  }

  try {
    $sql = 'SELECT * FROM Reservation_reception WHERE status = 0';
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
//var_dump($times);
$num = 1;
$sum = 1;
//$_SESSION['form'] = $_POST['form'];
//var_dump($time);
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
<title>ステップ2</title>
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
        <div class="other">①日にちを選ぶ</div><div class="select">②情報の入力</div><div class="other">③入力内容の確認</div><div class="other">④送信完了</div>
      </div>

      <div class="title">
        <h6>情報入力</h6>
      </div>

      <p>診療時間帯をお選びください。</p>

      <div class="note">
        <table border="1">
          <tr>
            <td class="td">診療日</td>
            <td>2021年<?php echo $rows[0]['Reservation_datetime'] ?><?php echo $time ?><?php if (count($err_msg) === 0) { ?><?php echo htmlspecialchars($_POST['time']); ?><?php } ?>日</td>
          </tr>
          <tr>
            <td class="td">診療時間帯</td>
            <td>
              <form method="post" action="">
              <select name="times" size="1">
              <?php foreach ($rows as $row) { ?>
                <?php if ($time == $row['day']) { ?>
                <option value="<?php echo $row['time'] ?>"><?php echo $row['time']; ?></option>
                <span class="err"><?php if ($err_msg['times']==='blank') { ?>※予約時間を選択してください<?php } else if ($err_msg['times']==='error') { ?>※不正な選択です<?php } ?></span>
                <?php } ?>
              <?php } ?>
              <?php echo htmlspecialchars($_POST['times']); ?>
              </select>
            </td>
          </tr>
        </table>
      </div>

      <p>患者様情報</p>
      
      <div class="note">
        <table border="1">
          <tr>
            <td class="td">氏名</td>
            <td><input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name']); ?>"><span class="err"><?php if ($err_msg['name']==='blank') { ?>※氏名を入力してください<?php } ?></span></td>
          </tr>

          <tr>
            <td class="td">氏名（フリガナ）</td>
            <td><input type="text" name="furigana" value="<?php echo htmlspecialchars($_POST['furigana']); ?>">
            <span class="err"><?php if ($err_msg['furigana']==='blank') { ?>※フリガナを入力してください<?php } else if ($err_msg['furigana']==='error') { ?>※カタカナで入力してください<?php } ?></span></td>
          </tr>

          <tr>
            <td class="td">生年月日</td>
            <td>
              <input type="text" name="birth" class="input" placeholder="1989" value="<?php echo htmlspecialchars($_POST['birth']); ?>"><span>年</span>
              <select name="pulldown-Month" size="1">
              <option value="<?php echo htmlspecialchars($_POST['pulldown-Month']); ?>"label="<?php echo htmlspecialchars($_POST['pulldown-Month']); ?>"><?php echo htmlspecialchars($_POST['pulldown-Month']); ?></option>
              <option value="1">1</option><option value="2">2</option><option value="3">3</option>
              <option value="4">4</option><option value="5">5</option><option value="6">6</option>
              <option value="7">7</option><option value="8">8</option><option value="9">9</option>
              <option value="10">10</option><option value="11">11</option><option value="12">12</option>
              </select><span class="select-text">月</span>
              <select name="pulldown-day" size="1">
              <option value="<?php echo htmlspecialchars($_POST['pulldown-day']); ?>"label="<?php echo htmlspecialchars($_POST['pulldown-day']); ?>"><?php echo htmlspecialchars($_POST['pulldown-day']); ?></option>
              <option value="1">1</option><option value="2">2</option><option value="3">3</option>
              <option value="4">4</option><option value="5">5</option><option value="6">6</option>
              <option value="7">7</option><option value="8">8</option><option value="9">9</option>
              <option value="10">10</option><option value="11">11</option><option value="12">12</option>
              <option value="13">13</option><option value="14">14</option><option value="15">15</option>
              <option value="16">16</option><option value="17">17</option><option value="18">18</option>
              <option value="19">19</option><option value="20">20</option><option value="21">21</option>
              <option value="22">22</option><option value="23">23</option><option value="24">24</option>
              <option value="25">25</option><option value="26">26</option><option value="27">27</option>
              <option value="28">28</option><option value="29">29</option><option value="30">30</option>
              </select><span class="select-text">日</span>
              <span class="err"><?php if ($err_msg['birth']==='blank') { ?>※生年月日を入力してください<?php } else if ($err_msg['birth']==='error') { ?>※生年月日が適正ではありません<?php } ?></span>
              <span class="err"><?php if ($err_msg['pulldown-Month']==='blank') { ?>※月を選択してください<?php } else if ($err_msg['pulldown-Month']==='error') { ?>※不正な選択です<?php } ?></span>
              <span class="err"><?php if ($err_msg['pulldown-day']==='blank') { ?>※日を選択してください<?php } else if ($err_msg['pulldown-day']==='error') { ?>※不正な選択です<?php } ?></span>
            </td>
          </tr>

          <tr>
            <td class="td">性別</td>
            <td><input type="radio" id="check1" name="sex" value="男性" checked><label for="check1">男性</label>
              <input type="radio" id="check2" name="sex" value="女性"><label for="check2">女性</label>
              <span class="err"><?php if ($err_msg['sex']==='blank') { ?>※性別を選択してください<?php } else if ($err_msg['sex']==='error') { ?>※不正な選択です<?php } ?></span>
            </td>
          </tr>
          </table>
          <p>ご連絡先</p>

          <table border="1">
          <tr>
            <td class="td">お電話番号</td>
            <td><input type="text" name="tel" placeholder="00088885555" value="<?php echo htmlspecialchars($_POST['tel']); ?>">
              <span class="err"><?php if ($err_msg['tel']==='blank') { ?>※電話番号を入力してください<?php } else if ($err_msg['tel']==='error') { ?>※不正な入力です<?php } ?></span>
            </td>
          </tr>

          <tr>
            <td class="td">メールアドレス</td>
            <td><input type="text" name="mail" class="mail-box" value="<?php echo htmlspecialchars($_POST['mail']); ?>">
              <span class="err"><?php if ($err_msg['mail']==='blank') { ?>※メールアドレスを入力してください<?php } else if ($err_msg['mail']==='error') { ?>※不正な入力です<?php } ?></span>
            </td>
          </tr>
          <tr>
            <td class="td">メールアドレス（確認用）</td>
            <td><input type="text" name="mail-check" class="mail-box">
              <span class="err"><?php if ($err_msg['mail']==='blank') { ?>※メールアドレスを入力してください<?php } else if ($mail !== $mail_check) { ?>※再度入力し直してください<?php } ?></span>
            </td>
          </tr>
          </table>

          <p>診療の参考となりますのでご記入ください。</p>
          <table border="1">
            <tr>
              <th class="Interview-text">１.いつごろから症状がありますか？</th>
            </tr>

            <tr>
              <td class="Interview-box">
                <input type="checkbox" id="check3" name="check3" value="①今日（来院日 当日）"<?php if ($_POST['check3'] === '①今日（来院日 当日）') { ?>checked <?php } ?>><label for="check3"><span class="check-text">①今日（来院日 当日）</span></label>
                <input type="checkbox" id="check4" name="check3" value="②昨日（来院日 前日）"<?php if ($_POST['check3'] === '②昨日（来院日 前日）') { ?>checked <?php } ?>><label for="check4"><span class="check-text">②昨日（来院日 前日）</span></label>
                <input type="checkbox" id="check5" name="check3" value="③２、３日前"<?php if ($_POST['check3'] === '③２、３日前') { ?>checked <?php } ?>><label for="check5"><span class="check-text">③２、３日前</span></label>
                <input type="checkbox" id="check6" name="check3" value="④１週間前"<?php if ($_POST['check3'] === '④１週間前') { ?>checked <?php } ?>><label for="check6"><span class="check-text">④１週間前</span></label>
                <input type="checkbox" id="check7" name="check3" value="⑤それより前（１週間以上前）"<?php if ($_POST['check3'] === '⑤それより前（１週間以上前）') { ?>checked <?php } ?>><label for="check7"><span class="check-text">⑤それより前（１週間以上前）</span></label>
                <span class="err"><?php if ($err_msg['check3']==='blank') { ?>※未選択です<?php } else if ($err_msg['check3']==='error') { ?>※不正な選択です<?php } ?></span>
                <?php if (count($err_msg) === 0) { echo htmlspecialchars($_POST['check3']); } ?>
              </td>
            </tr>

            <tr>
              <th class="Interview-text">２.どちらの目ですか？</th>
            </tr>

            <tr>
              <td class="Interview-box">
                <input type="checkbox" id="check8" name="check4" value="①右目"<?php if ($_POST['check4'] === '①右目') { ?>checked <?php } ?>><label for="check8"><span class="check-text">①右目</span></label>
                <input type="checkbox" id="check9" name="check4" value="②左目"<?php if ($_POST['check4'] === '②左目') { ?>checked <?php } ?>><label for="check9"><span class="check-text">②左目</span></label>
                <input type="checkbox" id="check10" name="check4" value="③両目"<?php if ($_POST['check4'] === '③両目') { ?>checked <?php } ?>><label for="check10"><span class="check-text">③両目</span></label>
                <span class="err"><?php if ($err_msg['check4']==='blank') { ?>※未選択です<?php } else if ($err_msg['check4']==='error') { ?>※不正な選択です<?php } ?></span>
                <?php if (count($err_msg) === 0) { echo htmlspecialchars($_POST['check4']); } ?>
              </td>
            </tr>

            <tr>
              <th class="Interview-text">３－１.どのような症状ですか？</th>
            </tr>

            <tr>
              <td class="Interview-box">
                <input type="checkbox" id="check11" name="check5[]" value="①涙が出る"<?php foreach ($check5 as $g) { if ($g === '①涙が出る') { ?>checked <?php } }?>><label for="check11"><span class="check-text">①涙が出る</span></label>
                <input type="checkbox" id="check12" name="check5[]" value="②まぶたが下がった"<?php foreach ($check5 as $g) { if ($g === '②まぶたが下がった') { ?>checked <?php } } ?>><label for="check12"><span class="check-text">②まぶたが下がった</span></label>
                <input type="checkbox" id="check13" name="check5[]" value="③視力の低下"<?php foreach ($check5 as $g) { if ($g === '③視力の低下') { ?>checked <?php } }?>><label for="check13"><span class="check-text">③視力の低下</span></label>
                <input type="checkbox" id="check14" name="check5[]" value="④歪んで見える"<?php foreach ($check5 as $g) { if ($g === '④歪んで見える') { ?>checked <?php } }?>><label for="check14"><span class="check-text">④歪んで見える</span></label>
                <input type="checkbox" id="check15" name="check5[]" value="⑤黒いものが見える"<?php foreach ($check5 as $g) { if ($g === '⑤黒いものが見える') { ?>checked <?php } }?>><label for="check15"><span class="check-text">⑤黒いものが見える</span></label>
                <input type="checkbox" id="check16" name="check5[]" value="⑥疲れ目"<?php foreach ($check5 as $g) { if ($g === '⑥疲れ目') { ?>checked <?php } }?>><label for="check16"><span class="check-text">⑥疲れ目</span></label>
                <input type="checkbox" id="check17" name="check5[]" value="⑦痛み"<?php foreach ($check5 as $g) { if ($g === '⑦痛み') { ?>checked <?php } }?>><label for="check17"><span class="check-text">⑦痛み</span></label>
                <input type="checkbox" id="check18" name="check5[]" value="⑧かゆみ"<?php foreach ($check5 as $g) { if ($g === '⑧かゆみ') { ?>checked <?php } }?>><label for="check18"><span class="check-text">⑧かゆみ</span></label>
                <input type="checkbox" id="check19" name="check5[]" value="⑨異物感"<?php foreach ($check5 as $g) { if ($g === '⑨異物感') { ?>checked <?php } }?>><label for="check19"><span class="check-text">⑨異物感</span></label>
                <input type="checkbox" id="check20" name="check5[]" value="⑩まつげが目に入る"<?php foreach ($check5 as $g) { if ($g === '⑩まつげが目に入る') { ?>checked <?php } }?>><label for="check20"><span class="check-text">⑩まつげが目に入る</span></label>
                <input type="checkbox" id="check21" name="check5[]" value="⑪できものができた"<?php foreach ($check5 as $g) { if ($g === '⑪できものができた') { ?>checked <?php } }?>><label for="check21"><span class="check-text">⑪できものができた</span></label>
                <input type="checkbox" id="check22" name="check5[]" value="⑫充血"<?php foreach ($check5 as $g) { if ($g === '⑫充血') { ?>checked <?php } }?>><label for="check22"><span class="check-text">⑫充血</span></label>
                <input type="checkbox" id="check23" name="check5[]" value="⑬健診で受診を勧められた"<?php foreach ($check5 as $g) { if ($g === '⑬健診で受診を勧められた') { ?>checked <?php } }?>><label for="check23"><span class="check-text">⑬健診で受診を勧められた</span></label>
                <input type="checkbox" id="check24" name="check5[]" value="⑭めやに"<?php foreach ($check5 as $g) { if ($g === '⑭めやに') { ?>checked <?php } }?>><label for="check24"><span class="check-text">⑭めやに</span></label>
                <input type="checkbox" id="check25" name="check5[]" value="⑮目が乾く"<?php foreach ($check5 as $g) { if ($g === '⑮目が乾く') { ?>checked <?php } }?>><label for="check25"><span class="check-text">⑮目が乾く</span></label>
                <input type="checkbox" id="check26" name="check5[]" value="⑯その他"<?php foreach ($check5 as $g) { if ($g === '⑯その他') { ?>checked <?php } }?>><label for="check26"><span class="check-text">⑯その他</span></label>
                <span class="err"><?php if ($err_msg['check5']==='blank') { ?>※未選択です<?php } else if ($err_msg['check5']==='error') { ?>※不正な選択です<?php } ?></span>
                <?php if (count($err_msg) === 0) { echo htmlspecialchars($_POST['check5']); } ?>
              </td>
            </tr>

            <tr>
              <th class="Interview-text">３－２．【その他】の症状の場合は、ご記入下さい。</th>
            </tr>

            <tr>
              <td class="Interview-box"><input type="text" class="textbox-no3" name="interview_3_2" value="<?php echo htmlspecialchars($_POST['interview_3_2']); ?>"></td>
            </tr>

            <tr>
              <th class="Interview-text">４.メガネやコンタクトレンズを使用していますか？</th>
            </tr>

            <tr>
              <td class="Interview-box">
                <input type="checkbox" id="check27" name="check6" value="①メガネ"<?php if ($_POST['check6'] === '①メガネ') { ?>checked <?php } ?>><label for="check27"><span class="check-text">①メガネ</span></label>
                <input type="checkbox" id="check28" name="check6" value="②ハードコンタクト"<?php if ($_POST['check6'] === '②ハードコンタクト') { ?>checked <?php } ?>><label for="check28"><span class="check-text">②ハードコンタクト</span></label>
                <input type="checkbox" id="check29" name="check6" value="③ソフトコンタクト"<?php if ($_POST['check6'] === '③ソフトコンタクト') { ?>checked <?php } ?>><label for="check29"><span class="check-text">③ソフトコンタクト</span></label>
                <input type="checkbox" id="check30" name="check6" value="④メガネ・コンタクト両方"<?php if ($_POST['check6'] === '④メガネ・コンタクト両方') { ?>checked <?php } ?>><label for="check30"><span class="check-text">④メガネ・コンタクト両方</span></label>
                <input type="checkbox" id="check31" name="check6" value="⑤使用していない"<?php if ($_POST['check6'] === '⑤使用していない') { ?>checked <?php } ?>><label for="check31"><span class="check-text">⑤使用していない</span></label>
                <span class="err"><?php if ($err_msg['check6']==='blank') { ?>※未選択です<?php } else if ($err_msg['check6']==='error') { ?>※不正な選択です<?php } ?></span>
                <?php if (count($err_msg) === 0) { echo htmlspecialchars($_POST['check6']); } ?>
              </td>
            </tr>

            <tr>
              <th class="Interview-text">５－１.当院をどのように知りましたか？</th>
            </tr>

            <tr>
              <td class="Interview-box">
                <input type="checkbox" id="check32" name="check7[]" value="①広告"<?php foreach ($check7 as $n) { if ($n === '①広告') { ?>checked <?php } } ?>><label for="check32"><span class="check-text">①広告</span></label>
                <input type="checkbox" id="check33" name="check7[]" value="②ホームページ"<?php foreach ($check7 as $n) { if ($n === '②ホームページ') { ?>checked <?php } } ?>><label for="check33"><span class="check-text">②ホームページ</span></label>
                <input type="checkbox" id="check34" name="check7[]" value="③紹介"<?php foreach ($check7 as $n) { if ($n === '③紹介') { ?>checked <?php } } ?>><label for="check34"><span class="check-text">③紹介</span></label>
                <span class="err"><?php if ($err_msg['check7']==='error') { ?>※不正な選択です<?php } ?></span>
                <?php if (count($err_msg) === 0) { echo htmlspecialchars($_POST['check7']); } ?>
              </td>
            </tr>

            <tr>
              <th class="Interview-text">５－２.【紹介】にチェックされた方のみ、ご記入下さい。</th>
            </tr>

            <tr>
              <td class="Interview-box"><input type="text" class="textbox-no3" name="interview_5_2" value="<?php echo htmlspecialchars($_POST['interview_5_2']); ?>"></td>
            </tr>
        </table>
      </div>

      <div class="next-button-box">
        <a href="./medical.php"><span class="return-button">戻る</span></a>
        <button type="submit" class="next-button" name="next">進む</button>
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