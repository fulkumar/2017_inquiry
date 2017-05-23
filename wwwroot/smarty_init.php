<?php
// smarty_test.php

// Smartyのinclude
require_once(__DIR__.'/vendor/smarty-3.1.30/libs/Smarty.class.php');

// Smartyの初期設定
$smarty_obj  =  new Smarty();
//var_dump($smarty_obj);
$smarty_obj->setTemplateDir(__DIR__.'/../smarty/templates/' );
$smarty_obj->setCompileDir(__DIR__.'/../smarty/templates_c/' );
//エスケープを追加する
$smarty_obj->escape_html = true;

