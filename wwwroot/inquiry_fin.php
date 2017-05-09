<?php
// inquiry_fin.php
//
ob_start();
session_start();

// ���͂��ꂽ�����擾
/*
$email = (string)@$_POST['email'];
$email = (string)filter_input(INPUT_POST, 'email');
*/
$params = array(
    'email', 'name', 'birthday', 'body'
);
$input_data = array();
foreach($params  as  $p) {
    $input_data[$p] = (string)@$_POST[$p];
}
var_dump($input_data);

// validate(���͐������H)
$error_detail = array(); // �G���[���i�[�p�ϐ�

// �K�{�`�F�b�N
$must_params = array('email', 'body');
foreach($must_params  as  $p) {
    if ('' === $input_data[$p]) {
        // �G���[����
        $error_detail["error_must_{$p}"] = true;
    }
}

// �^�`�F�b�N�Femail
// XXX RFC�񏀋��̃��A�h�͂����I�I
if (false === filter_var($input_data['email'], FILTER_VALIDATE_EMAIL)) {
    // �G���[����
    $error_detail["error_format_email"] = true;
}

// �^�`�F�b�N�F���t
if ('' !== $input_data['birthday']) {
    if (false === strtotime($input_data['birthday'])) {
        // �G���[����
        $error_detail["error_format_birthday"] = true;
    }
}

// �G���[����
if (array() !== $error_detail) {
    // �G���[���e���Z�b�V�����ɕێ�����
    $_SESSION['buffer']['error_detail'] = $error_detail;
    // ���͏����Z�b�V�����ɕێ�����
    $_SESSION['buffer']['input'] = $input_data;
//var_dump($error_detail);
    // echo '�G���[���������炵���I�I';
    // ���̓y�[�W�ɓ˂��Ԃ�
    header('Location: ./inquiry.php');
    exit;
}
// �_�~�[
echo '�f�[�^��validate��OK�ł����I�I';

// ���͂��ꂽ����DB��insert

// �u���肪�Ƃ��vPage�̏o��

