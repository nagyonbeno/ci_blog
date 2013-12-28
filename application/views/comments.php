<?php if($comment) { ?>
<h4>Comments :</h4>
<? foreach ($comment as $row) { ?>
<div class="comments">
	<h4><?=$row['nev']?> :</h4>
	<p><?=$row['comment_szoveg']?></p>
	<p class="comment-date"><?=$row['comment_datum']?></p>
	<?php if($this->session->userdata('user_type')=="admin") { ?>
	<p class="anchor"><?= anchor(base_url().'/comments/delete_comment/'.$row['comment_id'], 'Delete Comment', 'title="Delete Comment"'); ?></p>
	<? } ?>
</div>
<?php }
}; ?>
<p class="anchor"><?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?></p>
<?php if(isset($pages)) { ?>
    <?=$pages?>
<? } ?>





