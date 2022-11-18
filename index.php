<?php
include 'init.php';
$title = 'Home';
include 'header.php';
?>
<h1><?=$name?></h1>
<?php
if ($loggedin):
?>
<a href="newthread.php" class="button btn-block">+ New Thread</a>
<?php
endif;
?>
<div class="listbox">
    <?php
    $res = $conn->query('SELECT * FROM thread ORDER BY date DESC LIMIT 100');
    while ($row = mysqli_fetch_assoc($res)):
    ?>
    <a class="item" href="thread.php?id=<?=intval($row['id'])?>">
        <b><?=htmlspecialchars($row['title'])?></b>
        <span class="desc"><?=htmlspecialchars(time2str(strtotime($row['date'])))?></span>
    </a>
    <?php
    endwhile;
    ?>
</div>
<?php
include 'footer.php';