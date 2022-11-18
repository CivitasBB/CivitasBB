<?php
include 'init.php';
$title = 'Login';
$wrong = false;
if ($loggedin) {
    header('Location: ./');
    exit;
}
if (!empty($_POST['uname']) && !empty($_POST['pword'])) {
    $uname = trim($_POST['uname']);
    $pword = $_POST['pword'];
    if (empty($uname)) {
        $wrong = true;
    } else {
        $stmt = $conn->prepare('SELECT * FROM user WHERE username = ? OR email = ? LIMIT 1');
        $stmt->bind_param('ss', $uname, $uname);
        $stmt->execute();
        $res = $stmt->get_result();
        if (mysqli_num_rows($res) == 0) {
            $wrong = true;
        } else {
            $row = mysqli_fetch_array($res);
            if (password_verify($pword, $row['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = intval($row['id']);
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                header('Location: ./');
                exit;
            } else {
                $wrong = true;
            }
        }
    }
}
include 'header.php';
if ($wrong):
?>
<div class="wrong">
    <p>Incorrect username or password!</p>
</div>
<?php
endif;
?>
<h1>Login</h1>
<form method="post">
    <p class="label">Username/Email:</p>
    <input type="text" placeholder="Username/Email" name="uname" required autofocus>
    <p class="label">Password:</p>
    <input type="password" placeholder="Password" name="pword" required>
    <button type="submit" class="button">Login</button>
</form>
<?php
include 'footer.php';