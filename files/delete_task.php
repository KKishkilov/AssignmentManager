<?php
require_once '../vendor/autoload.php';
$task = new Task();
$task->delete($_GET['task_id']);
header('Location: ../index.php');
?>

