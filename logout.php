<?php
include 'init.php';
session_destroy();
header('Location: ./');
exit;