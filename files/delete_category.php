<?php
require_once '../vendor/autoload.php';
$task = new Category();
$task->delete($_GET['category_id']);
header('Location: ../index.php');
?>

