<?php
include 'init.php';
if (!$loggedin) {
    header('Location: ./login.php');
    exit;
}
$title = 'New Thread';
if (!empty($_POST['post']) && !empty($_POST['title'])) {
    $post = trim($_POST['post']);
    $title = trim($_POST['title']);
    $title = substr($title, 0, 500);
    if (!empty($post)) {
        $strippost = trim(strip_tags($post));
        if (!empty($strippost)) {
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            $post = $purifier->purify($post);
            $stmt = $conn->prepare('INSERT INTO thread (postedby, content, title) VALUES (?, ?, ?)');
            $postedbyid = intval($_SESSION['id']);
            $stmt->bind_param('iss', $postedbyid, $post, $title);
            $stmt->execute();
            header('Location: thread.php?id=' . intval($conn->insert_id));
            exit;
        }
    }
}
include 'header.php';
?>
<h1>New Thread</h1>
<form method="post">
    
    <div class="msg">
    <form method="post">
        <div class="threadtitle">
            <p><b>Thread Title:</b></p>
            <input type="text" required placeholder="Thread Title" name="title" autofocus>
        </div>
        <div class="msgcontent replymsg">
            <div class="editor" id="editor"></div>
            <input type="text" name="post" id="html" class="hidden">
        </div>
        <div class="msgpost">
            <button class="button" type="submit">Create Thread</button>
        </div>
    </form>
    <script>
        pell.init({
            element: document.getElementById('editor'),
            onChange: html => document.getElementById('html').value = html,
            placeholder: 'test'
        });
    </script>
</div>
</form>
<?php
include 'footer.php';