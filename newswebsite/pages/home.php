<?php
    $sql =  "SELECT users.user_id, users.fname, users.lname, categories.cid, categories.name AS catname, news.* FROM news
    JOIN users ON users.user_id = news.created_by
    JOIN categories ON categories.cid = news.category_of ORDER BY nid DESC";
    $newsResult = mysqli_query($conn, $sql);





?>


<div class = "news-list">
    <?php foreach($newsResult as $news) { ?>
    <div class = "news-box">
        
        <?php if ($news['image']) { ?>
        <img src="<?=public_url('newsimages/'.$news['image']); ?>" alt="">
        <?php } ?>
        <a href="<?=base_url('news-details?id=').$news['nid'];?>"><h1><?=$news['title'];?></h1></a>
        <p><?=$news['summary'];?></p>
        <a href="<?=base_url('news-details?id=').$news['nid'];?>" id="read-more">Read More</a>
        <span>Category: <?=$news['catname'];?></span>
        <span>Posted By: <?=$news['fname'].' '.$news['lname'];?></span>

    </div>
    <?php } ?>
</div>