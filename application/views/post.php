<div class="current_post">
	<h2><?=$post['cim']?></h2>
	<p><?=$post['post_szoveg']?></p>
	<h4>Added by: <?=$post['nev']?></h4>
	<h4>On: <?=$post['datum']?></h4>
	<?php if($post['hashtag']) { ?>
	<h4 id="hashtag">Tags:</h4>
    <?php $hashtags = $post['hashtag'];
	$hashtag = explode(",",$hashtags);
	$last_hashtag = end($hashtag);
	foreach ($hashtag as $row) { ?>
	<?php if($row === $last_hashtag) { ?>
	<p class="hashtag_search"><a href="<?=base_url()?>/posts/hashtag_posts/<?=$row?>"><?=$row?></a></p>
	<? } else { ?>
	<p class="hashtag_search"><a href="<?=base_url()?>/posts/hashtag_posts/<?=$row?>"><?=$row.","?></a></p>
	<? } } } ?>
	<p class="clear"></p>
	


	<p class="anchor"><?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?></p>
</div>
