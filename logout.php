<?php
session_start();

unset($_SESSION['username']);
unset($_SESSION['has_logged_in']);

header('Location: login.php');
die;
