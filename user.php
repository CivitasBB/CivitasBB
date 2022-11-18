<?php
include 'init.php';
if (!$loggedin) {
    header('Location: login.php');
    exit;
}
if (!isset($_GET['id'])) {
    header('Location: ./');
    exit;
}
$id = intval($_GET['id']);
$res = $conn->query('SELECT * FROM user WHERE id = ' . intval($id));
if (mysqli_num_rows($res) == 0) {
    header('Location: ./');
    exit;
}
$row = mysqli_fetch_array($res);
$title = htmlspecialchars($row['username']);
include 'header.php';
?>
<h1><?=htmlspecialchars($row['username'])?></h1>
<p><b><?=number_format(intval($row['points']))?> <?=(intval($row['points']) == 1) ? 'point' : 'points'?></b></p>
<p><b>Biography:</b></p>
<div><?=nl2br(htmlspecialchars($row['bio']))?></div>
<?php
include 'footer.php';