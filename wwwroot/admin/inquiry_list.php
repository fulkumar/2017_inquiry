<?php
// admin/inquiry_list.php
require_once( __DIR__ . '/init_auth.php');
// �ꗗ��DB����擾����
// DB�n���h�����擾
$dbh = get_dbh();
// �v���y�A�h�X�e�[�g�����g
$sql = 'SELECT * FROM inquirys
  ORDER BY inquiry_id DESC;';
$pre = $dbh->prepare($sql);
// XXX ����̓o�C���h�Ȃ�
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