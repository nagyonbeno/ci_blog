<?php if($comment) { ?>
<h4>Comments :</h4>
<? foreach ($comment as $row) { ?>
<h4><?=$row['comment_szoveg']?></h4>
<p>Hozzáadta: <?=$row['nev']?></p>
<p><?=$row['comment_datum']?></p>
<?= anchor(base_url().'/comments/delete_comment/'.$row['comment_id'], 'Delete Comment', 'title="Delete Comment"'); ?>
<?php }
}; ?>
<p><?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?></p>





