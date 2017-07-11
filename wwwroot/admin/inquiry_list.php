<?php
// admin/inquiry_list.php
require_once( __DIR__ . '/init_auth.php');

// �������[�h���擾����
$find_string = array(); // ����������ۑ��p
//
foreach(['name', 'email', 'birthday_from', 'birthday_to'] as $p) {
    $find_string[$p] = (string)@$_GET[$p];
}
//var_dump($find_string);
// �擾�����������[�h��HTML���ŕ\������
$smarty_obj->assign('find_string', $find_string);
// �ꗗ��DB����擾����
// DB�n���h�����擾
$dbh = get_dbh();
$bind_data = array();
// �v���y�A�h�X�e�[�g�����g
$sql = 'SELECT * FROM inquirys ';
// SQL�𓮓I�ɒǉ�(�s���S)
if ('' !== $find_string['email']) {
    $sql .= ' WHERE email=:email ';
    $bind_data[':email'] = $find_string['email'];
}
// XXX name�̌���(LIKE��)
// XXX birthday�̌���(�͈͌���)
// SQL�̒���
//$sql = $sql . ' ORDER BY inquiry_id DESC;';
$sql .= ' ORDER BY inquiry_id DESC;';
$pre = $dbh->prepare($sql);
// �l�̃o�C���h
foreach($bind_data as $k => $v) {
    $pre->bindValue($k, $v);
}
// ���s
$r = $pre->execute(); // XXX �G���[�`�F�b�N�ȗ�
// �f�[�^���擾
$data = $pre->fetchAll(PDO::FETCH_ASSOC);
//var_dump($data);
// �e���v���[�g�Ƀf�[�^��n����
$smarty_obj->assign('inquiry_list', $data);
// �\������
error_reporting(E_ALL & ~E_NOTICE);
$smarty_obj->display('admin/inquiry_list.tpl');