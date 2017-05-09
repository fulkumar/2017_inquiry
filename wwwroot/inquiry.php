<?php
// inquiry.php
//
ob_start();
session_start();

// �m�F
//var_dump($_SESSION);

// ���͓��e���擾
//$input = $_SESSION['buffer']['input'] ?? []; // PHP 7.0�ȍ~�Ȃ炱����
if (true === isset($_SESSION['buffer']['input'])) {
    $input = $_SESSION['buffer']['input'];
} else {
    //$input = []; // PHP 5.4�ȍ~�Ȃ炱�����ł��悢
    $input = array();
}

// �G���[���e���擾
//$error_detail = $_SESSION['buffer']['error_detail'] ?? [];
if (true === isset($_SESSION['buffer']['error_detail'])) {
    $error_detail = $_SESSION['buffer']['error_detail'];
} else {
    //$error_detail = []; // PHP 5.4�ȍ~�Ȃ炱�����ł��悢
    $error_detail = array();
}

// XSS�΍��p�֐�
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES);
}

?>
<html>

<body>
<?php
  if (0 < count($error_detail)) {
    echo '<div style="color: red;">�G���[������܂�</div>';
  }
?>

<?php
  // error_must_email
  if (isset($error_detail['error_must_email'])) {
    echo '<div style="color: red;">���A�h�͕K�{�ł��B</div>';
  }
<html>
<body>

<?php
if (0 < count($error_detail))�@{
	echo '<div style="color: red;"> �G���[������܂�</div>';

}
?>
<?php
	//error_must_email
	if (isset($error_detail['error_must_email'])) {
	echo '<divstyle="color: red;"> ���A�h�K�{�ł��B</div>';

}

?>

  <form action="./inquiry_fin.php" method="post">
	Email Adress(*):<input type="text" name="email"
		value="<?php echo h((string)@$input['email']); ?>"><br>

	Name:<input type="text" name="name"
		value="<?php echo h((string)@$input['name']); ?>">><br>

	Birthday:<input type="text" name="birthday"
		value="<?php echo h((string)@$input['birthday']); ?>">><br>

	Inquiry:<textarea name="body">
<?php echo h((string)@$input['body']); ?></textarea><br>

	<button>Inquiry</button>
</form>
</body>
</html>
