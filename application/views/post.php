<div class="current_post">
	<h2><?=$post['cim']?></h2>
	<p><?=$post['post_szoveg']?></p>
	<h4>Added by: <?=$post['nev']?></h4>
	<h4>On: <?=$post['datum']?></h4>
	<?php if($post['hashtag']) { ?>
	<h4>Tags: <?=$post['hashtag']?></h4>
	<? } ?>
	
	<p class="anchor"><?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?></p>
</div>
