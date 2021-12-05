<?php

require_once 'C:\xampp\htdocs\SharePost\app\bootstrap.php';
// use Template;
 define('TEMPLATES_PATH', dirname(__FILE__));

//Instanciate new object

$template = new Template(TEMPLATES_PATH . '/templates/example.html');
// $template = new Template('/example.html');

// $args = array(
//   'Test1' => 'This is the test one string'
// );

$template->assign('TEST', 'This is the test one string');
$template->show();