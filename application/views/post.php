<h2><?=$post['cim']?></h2>
<p><?=$post['post_id']?></p>
<p><?=$post['post_szoveg']?></p>
<p>Hozzáadta: <?=$post['nev']?></p>
<?php if($post['hashtag']) { ?>
<p>Címkék: <?=$post['hashtag']?></p>
<? } ?>
<p><?=$post['datum']?></p>
<?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?>