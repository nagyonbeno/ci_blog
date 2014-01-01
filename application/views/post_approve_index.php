  <h2>Pending posts</h2><br />
  <?= form_open(base_url().'posts/posts_approve'); ?> 
    <p> 
    <?= form_label('Search', 'search'); ?> : <?php
    $data_form = array(
      'name'  => 'search',
      'id'    => 'search',
      'size'  => '40',
      );
    echo form_input($data_form);?>
    <?= form_submit('','Search!'); ?></p>
	<?= form_close(); ?>
	<?php if(isset($errors)) { ?>
		<?=$errors?>
  	<? } ?>
  	<?php if(isset($search,$count)) { ?>
  	<p><?="There are ".$count." results for : ".$search." ." ?></p>
  	<p><?= anchor('posts/posts_approve', 'Back to pending posts', 'title="Back to pending posts"'); ?></p>
  	<? } ?>
	<?php if(!isset($posts) || count($posts)==0){ ?>
  		<p>No posts to load!</p></br />
  		<?php if(isset($_POST['search'])) { ?>
  		<p><?= anchor('posts/posts_approve', 'Back to pending posts', 'title="Back to pending posts"'); ?></p>
  		<?php } ?>
  	<?php } else {  
  		foreach ($posts as $row){ ?>
  			<article>	  	
				<h3>
					<a href="<?=base_url()?>posts/approve_post/<?=$row['post_id']?>"><?=$row['cim']?></a><br />
					<a href="<?=base_url()?>posts/approve_edit_post/<?=$row['post_id']?>">Edit</a> - 
					<a href="<?=base_url()?>posts/delete_post/<?=$row['post_id']?>">Delete</a>
				</h3>
				<span class="date"><?=$row['datum']?></span>
				<p class="post-exerpt"><?=substr(strip_tags($row['post_szoveg']),0,200).".."?><p>
				<p class="more-link"><a href="<?=base_url()?>posts/approve_post/<?=$row['post_id']?>">Read More</a></p>
			</article>
		<?php }
	}; ?>
	<p><?= anchor('/posts/', 'Back to Main', 'title="Back to Main"'); ?></p>
<?php if(isset($pages)) { ?>
<?=$pages?>
<? } ?>

