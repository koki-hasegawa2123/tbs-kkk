<?php
$host     = 'mysql153.phy.lolipop.lan';
$username = 'LAA1338030';   // MySQLのユーザ名
$password = 'tkjYFVqi';       // MySQLのパスワード
$dbname   = 'LAA1338030-6oacr2';   // MySQLのDB名(今回、MySQLのユーザ名を入力してください)
$charset  = 'utf8';   // データベースの文字コード
// MySQL用のDSN文字列
$dsn = 'mysql:dbname='.$dbname.';host='.$host.';charset='.$charset;

try {
  // データベースに接続
  $dbh = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $amount = '';
  //データチェック============================================================
  //==========================================================================
  try {
    $sql = 'SELECT * FROM calendar';
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
margin-top: 15px;
margin-bottom: 10px;
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
.calendar-table {
  background: rgba(248,248,255,0.5);
}
.calendar table thead tr, table thead td {
padding: 0px;
text-align: center;
}
.calendar tbody td {
width: 90px;
text-align: center;
}
.calendar-text {
  font-size: 21px;
  padding: 0 0 10px 35px;
  display: block;
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
.td {
  background: rgba(128,128,128,0.1);
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
.guidance {
  margin: 0 0 10px 30px;
  display: flex;
}
.guidance-text {
  padding: 0;
}
.guidance-text-box {
  margin: 0 0 0 10px;
}
.site-footer-copyright {
  text-align: center;
}
</style>
<title>予約受付</title>
</head>
<body>

  <div class="first-visit-reception-container">

    <div class="first-visit-reception-top">
      <img src="https://tbs-kkk.com/wp-content/uploads/2021/09/img53.jpg" alt="眼形成クリニック Crarity初診受付サービス">
    </div>

    <div class="first-visit-reception-contents">
      <p>インターネットから初診受付のお申し込みができるサービスです。</p>

      <div class="title">
        <h6>眼形成クリニック Clarity</h6>
      </div>

      <div class="note">
        <table border="1">
          <tr>
            <td class="td">住所</td>
            <td>北海道札幌市中央区南〇条西〇丁目000-00 ○○ビル3F</td>
          </tr>

          <tr>
            <td class="td">電話番号</td>
            <td>000-000-0000</td>
          </tr>

          <tr>
            <td class="td">診療時間</td>
            <td>8：30～12：00,13：30～1７：00（月、水、金）<br>
                8：30～12：00（火、土）<br>
                13：30～17：00（手術のみ火、木）<br>
                最終受付時間は、診療終了時間の60分前となります。
            </td>
          </tr>

          <tr>
            <td class="td">休診日</td>
            <td>土曜午後、日曜、祝日</td>
          </tr>

          <tr>
            <td class="td">診療科目</td>
            <td>眼科</td>
          </tr>

          <tr>
            <td class="td">ホームページ</td>
            <td><a href="https://tbs-kkk.com">https://tbs-kkk.com</a></td>
          </tr>

          <tr>
            <td class="td">お知らせ</td>
            <td>ご来院時には、保険証、医療証各種をお持ちください。<br>
                また、受付でインターネット予約の旨をお伝えください。<br>
                基本的にご予約の方を優先させていただいていますので、ご予約での来院をお勧めします。
            </td>
          </tr>
        </table>
      </div>

    <div class="title">
      <h6>診療受付</h6>
    </div>

    <div class="step">
      <div class="select">①日にちを選ぶ</div><div class="other">②情報の入力</div><div class="other">③入力内容の確認</div><div class="other">④送信完了</div>
    </div>

    <div class="calendar">
      <p>ご希望日を選択してください</p>

      <?php //foreach ($rows as $row) { ?>
      <table class="calendar-table" border="1">
        <thead>
          <span class="calendar-text">2021年9月</span>
          <tr>
            <td class="sunday">日</td><td>月</td><td>火</td><td>水</td><td>木</td><td>金</td><td>土</td>
          </tr>
        </thead>

        <tbody>
          <form method="post" action="./step2.php">

          <tr class="calendar-border-bottom">
            <td></td><td></td><td></td><td>1</td><td>2</td><td>3</td><td>4</td>
          </tr>

          <!-- 第一週 -->
          <tr>
          <td></td><td></td>
          <td></td><td><img src="<?php echo $rows[0]['img']; ?>"></td>
          <td><img src="<?php echo $rows[0]['img']; ?>"></td><td><img src="<?php echo $rows[0]['img']; ?>"></td>
          <td><img src="<?php echo $rows[0]['img']; ?>"></td>
          </tr>

          <!-- 第二週 -->
          <tr class="calendar-border-bottom">
          <td class="sunday">5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td>
          </tr>

          <tr>
          <td class="sunday"><img src="<?php echo $rows[1]['img']; ?>"></td><td><img src="<?php echo $rows[0]['img']; ?>"></td>
          <td><img src="<?php echo $rows[0]['img']; ?>"></td><td><img src="<?php echo $rows[0]['img']; ?>"></td>
          <td><img src="<?php echo $rows[0]['img']; ?>"></td><td><img src="<?php echo $rows[0]['img']; ?>"></td>
          <td><button class="button" disabled><img class="button-img" src="<?php echo $rows[2]['img']; ?>"></button></td>
          </tr>

          <!-- 第三週 -->
          <tr class="calendar-border-bottom">
          <td class="sunday">12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td>
          </tr>

          <tr>
          <td class="sunday"><img src="<?php echo $rows[1]['img']; ?>"></td><td><img src="<?php echo $rows[0]['img']; ?>"></td>
          <td><img src="<?php echo $rows[0]['img']; ?>"></td>
          <td><img src="<?php echo $rows[0]['img']; ?>"></td>
          <td><img src="<?php echo $rows[0]['img']; ?>"></td>
          <td><img src="<?php echo $rows[0]['img']; ?>"></td>
          <td><img src="<?php echo $rows[0]['img']; ?>"></td>
          </tr>

          <!-- 第四週 -->
          <tr class="calendar-border-bottom">
          <td class="sunday">19</td><td class="sunday">20</td><td>21</td><td>22</td><td class="sunday">23</td><td>24</td><td class="sunday">25</td>
          </tr>

          <tr>
          <td class="sunday"><img src="<?php echo $rows[1]['img']; ?>"></td>
          <td class="sunday"><img src="<?php echo $rows[1]['img']; ?>"></td>
          <td><img src="<?php echo $rows[0]['img']; ?>"></td>
          <td><img src="<?php echo $rows[0]['img']; ?>"></td>
          <td class="sunday"><img src="<?php echo $rows[1]['img']; ?>"></td>
          <td><button class="button" name="24" value="24" type="submit"><img class="button-img" src="<?php echo $rows[3]['img']; ?>"></button></td>
          <td class="sunday"><img src="<?php echo $rows[1]['img']; ?>"></td>
          </tr>

          <!-- 第五週 -->
          <tr class="calendar-border-bottom">
          <td class="sunday">26</td><td>27</td><td>28</td><td>29</td><td class="sunday">30</td><td></td><td></td>
          </tr>
          
          <tr>
          <td class="sunday"><img src="<?php echo $rows[1]['img']; ?>"></td>
          <td><button class="button" name="27" value="27" type="submit"><img class="button-img" src="<?php echo $rows[3]['img']; ?>"></button></td>
          <td><button class="button" name="28" value="28" type="submit"><img class="button-img" src="<?php echo $rows[3]['img']; ?>"></button></td>
          <td><button class="button" name="29" value="29" type="submit"><img class="button-img" src="<?php echo $rows[3]['img']; ?>"></button></td>
          <td class="sunday"><img src="<?php echo $rows[1]['img']; ?>"></td>
          <td></td>
          <td></td>
          </tr>
        </tbody>
        </form>
      </table>
      <?php // } ?>
    </div>

    <div class="guidance">
      <button class="button"><img class="button-img" src="<?php echo $rows[3]['img']; ?>"></button>
      <div class="guidance-text-box">
        <span class="guidance-text">空きがあります。ご希望日のボタンをクリックしてください。</span>
      </div>
      </div>

      <div class="guidance">
      <button class="button"><img class="button-img" src="<?php echo $rows[2]['img']; ?>"></button>
      <div class="guidance-text-box">
        <span class="guidance-text">空きがありません。</span>
      </div>
      </div>

      <div class="guidance">
      <button class="button"><img class="button-img" src="<?php echo $rows[0]['img']; ?>"></button>
      <div class="guidance-text-box">
        <span class="guidance-text">受付を行っておりません。</span>
      </div>
      </div>

      <div class="guidance">
      <button class="button"><img class="button-img" src="<?php echo $rows[1]['img']; ?>"></button>
      <div class="guidance-text-box">
        <span class="guidance-text">休診日です。</span>
      </div>
      </div>

      <div class="site-footer-copyright">
        <p>Copyright (c) 2020 - 2021 眼形成クリニック Clarity All Rights Reserved.</p>
      </div>

    </div>
  
  </div>
</body>
</html>