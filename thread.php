<?php
include 'init.php';
if (!isset($_GET['id'])) {
    header('Location: ./');
    exit;
}
$id = intval($_GET['id']);
$res = $conn->query('SELECT * FROM thread WHERE id = ' . intval($id));
if (mysqli_num_rows($res) == 0) {
    header('Location: ./');
    exit;
}
$row = mysqli_fetch_array($res);
$userrow = mysqli_fetch_array($conn->query('SELECT * FROM user WHERE id = ' . intval($row['postedby'])));
$title = htmlspecialchars($row['title']);
if (!empty($_POST['post'])) {
    if (!$loggedin) {
        header('Location: login.php');
        exit;
    }
    $post = trim($_POST['post']);
    if (!empty($post)) {
        $strippost = trim(strip_tags($post));
        if (!empty($strippost)) {
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            $post = $purifier->purify($post);
            $stmt = $conn->prepare('INSERT INTO reply (postedby, content, replyto) VALUES (?, ?, ?)');
            $replyto = intval($id);
            $postedbyid = intval($_SESSION['id']);
            $stmt->bind_param('isi', $postedbyid, $post, $replyto);
            $stmt->execute();
            header('Location: thread.php?id=' . intval($id));
            exit;
        }
    }
}
include 'header.php';
?>
<h1><?=htmlspecialchars($row['title'])?></h1>
<div class="msg">
    <a class="msgheader" href="user.php?id=<?=intval($userrow['id'])?>">
        <span><?=htmlspecialchars($userrow['username'])?></span>
    </a>
    <div class="msgcontent html"><?=$row['content']?></div>
    <div class="msgfooter">
        <?=time2str(strtotime($row['date']))?>
    </div>
</div>
<?php
$replies = $conn->query('SELECT * FROM reply WHERE replyto = ' . intval($row['id']) . ' ORDER BY date');
while ($rw = mysqli_fetch_assoc($replies)):
    $userrow = mysqli_fetch_array($conn->query('SELECT * FROM user WHERE id = ' . intval($rw['postedby'])));
?>
<div class="msg reply">
    <a class="msgheader" href="user.php?id=<?=intval($userrow['id'])?>">
        <span><?=htmlspecialchars($userrow['username'])?></span>
    </a>
    <div class="msgcontent html"><?=$rw['content']?></div>
    <div class="msgfooter">
        <?=time2str(strtotime($rw['date']))?>
    </div>
</div>
<?php
endwhile;
if ($loggedin):
?>
<div class="msg reply">
    <form method="post">
        <div class="msgheader reply">
            <span>Reply to this thread</span>
        </div>
        <div class="msgcontent replymsg">

            <div class="editor" id="editor"></div>
            <input type="text" name="post" id="html" class="hidden">
        </div>
        <div class="msgpost">
            <button class="button" type="submit">Post</button>
        </div>
    </form>
    <script>
        pell.init({
            element: document.getElementById('editor'),
            onChange: html => document.getElementById('html').value = html,
            placeholder: 'test'
        });
        document.getElementById('editor').querySelector('.pell-content').focus();

    </script>
</div>
<?php
else:
?>
<div class="msg reply">
    <div class="msgheader reply">
        <b>Login to reply!</b>
    </div>
    <div class="msgcontent">
        <p>Please login to reply to this thread!</p>
    </div>
</div>
<?php
endif;
include 'footer.php';
