<?php

$id = $_GET['id'];
$sql = "SELECT * FROM news where nid='$id'";
$prepare = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($prepare);



?>

<div class="news-display">

        <h1><?=$result['title'];?></h1>
        <?php if ($result['image']) { ?>
        <img src="<?=public_url('newsimages/'.$result['image']); ?>" alt="">
        <?php } ?>
        <p><?=$result['description'];?></p>

</div>
