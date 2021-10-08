<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.osdn.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'LAA1338030-6oacr2');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'LAA1338030');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'tkjYFVqi');

/** MySQL のホスト名 */
define('DB_HOST', 'mysql153.phy.lolipop.lan');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY', ':{j/U%p^w8..z]`7`$KQ`Iy:3nJZK888>rWpRl*U^J^)K7zoQ8vu[J!M9c89]`W{');
define('SECURE_AUTH_KEY', ',mRP>=NRT.jb=buMUW:ikWfL-*0;;^}aD<S`L?K)w#M)k[xyu4)0<P+-6sGK;^KI');
define('LOGGED_IN_KEY', 'HHyH+8K,dF(~6Ni<5wb;x!$|$ja-[HI59lf?T]SIU4U<Xf04j7zaW]+C#v3GrB_k');
define('NONCE_KEY', 'Spw"9_]CP#qG)-|4p2Y!VVB0}MOwHwQQzNBf^!Mdph8EE]4@@vO$4m<RUx3]73Xm');
define('AUTH_SALT', '>XZT!0*n$e)N5nmkf4PWV(W7[`j^;OHQZ+mPh&gM~N*st<qb]dYqVuA<2dmDB_SK');
define('SECURE_AUTH_SALT', '~RPTF;G<""}>rg=$LdW+{P&s]3(]){TS7++^~%e<4dZo547~L}d7czd++aVZ1&]v');
define('LOGGED_IN_SALT', 'p5".iSR]&)E69<9O9h%a8^EgNop*R6OZpDP+gnu[J7.[*u3|YcE5w`}9nOJpgcl}');
define('NONCE_SALT', 'e$I#&YF*my)]3O_]tQc2,2j4*EQm9BhxN</3b<uMvzb/C54YXyqh-1ABW$#bk"$B');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp20210820160020_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
  define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
