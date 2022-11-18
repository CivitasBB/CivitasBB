<?php
$conn = mysqli_connect('localhost', 'root', 'root', 'forum');
$name = 'PHP FORUMS';
$root = '/';
$copyrightname = 'PHP FORUMS';
session_name('FORUM');
session_start();
$loggedin = isset($_SESSION['loggedin']);
#### CONFIG ####
date_default_timezone_set('America/Los_Angeles');
$conn->query("SET GLOBAL time_zone = 'America/Los_Angeles';");
#### INCLUDES ####
include 'htmlpurifier/HTMLPurifier.auto.php';
include 'time2str.php';