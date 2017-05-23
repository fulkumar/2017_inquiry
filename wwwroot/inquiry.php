<?php
// inquiry.php
//
ob_start();
session_start();

// 確認
//var_dump($_SESSION);

// 入力内容を取得
//$input = $_SESSION['buffer']['input'] ?? []; 
if (true === isset($_SESSION['buffer']['input'])) {
    $input = $_SESSION['buffer']['input'];
} else {
    //$input = []; // PHP 5.4以降ならこっちでもよい
    $input = array();
}

// エラー内容を取得
//$error_detail = $_SESSION['buffer']['error_detail'] ?? [];
if (true === isset($_SESSION['buffer']['error_detail'])) {
    $error_detail = $_SESSION['buffer']['error_detail'];
} else {
    //$error_detail = []; // PHP 5.4以降ならこっちでもよい
    $error_detail = array();
}
var_dump($error_detail);


//CSRF トークン作成
//XXX PHP 7 前提

$csrf_token = hash('sha512', random_bytes(128));
//var_dump($csrf_token);
while (5 <= count(@$_SESSION['csrf_token'])){
  array_shift($_SESSION['csrf_token']);
}

//CSRFトークンをSESSIONに入れておく：時間付き
$_SESSION['csrf_token'][$csrf_token] = time();


// XSS対策用関数
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES);
}

?>
<html>

<body>
<?php
  if (0 < count($error_detail)) {
    echo '<div style="color: red;">エラーがあります</div>';
  }
?>

<?php
  // error_must_email
  if (isset($error_detail['error_must_email'])) {
    echo '<div style="color: red;">メアドは必須です。</div>';
  }
?>
<html>
<body>

<?php
if (0 < count($error_detail)){
	echo '<div style="color: red;"> エラーがあります</div>';

}
?>
<?php
	//error_must_email
	if (isset($error_detail['error_must_email'])) {
	echo '<divstyle="color: red;"> メアド必須です。</div>';

}

?>

  <form action="./inquiry_fin.php" method="post">
	Email Adress(*):<input type="text" name="email"
		value="<?php echo h((string)@$input['email']); ?>"><br>

	Name:<input type="text" name="name"
		value="<?php echo h((string)@$input['name']); ?>"><br>

	Birthday:<input type="text" name="birthday"
		value="<?php echo h((string)@$input['birthday']); ?>"><br>

	Inquiry:<textarea name="body">
<?php echo h((string)@$input['body']); ?></textarea><br>
	<input type="hidden" name="csrf_token"
	  value="<?php echo h($csrf_token); ?>">
	<button>Inquiry</button>
</form>
</body>
</html>
