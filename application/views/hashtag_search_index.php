      <?php if($this->session->userdata('user_id')){ ?>
      <p>Hello <?=$this->session->userdata('username')?>!</p>
      <p>You are <?=$this->session->userdata('user_type')?>.</p>
      <?= anchor('/users/logout', 'Log out', 'title="Log out"')."<br />"; ?>
      <?php if($this->session->userdata('user_type')=="author" || $this->session->userdata('user_type')=="admin") { ?>
      <?= anchor('/posts/new_post', 'Add Post', 'title="Add post"')."<br />"; ?>
      	<?php if($this->session->userdata('user_type')=="admin") { ?>
      		<?= anchor('/posts/posts_approve', 'Approve Posts', 'title="Approve posts"'); ?>
      	<? } ?>
      <? } ?>
      <? } else { ?>
      <?= anchor('/users/login', 'Login', 'title="Login"')."<br />"; ?>
      <?= anchor('/users/register', 'Sign up', 'title="Sign up"'); ?>
      <? } ?>
      <?= form_open(base_url().'posts/index'); ?> 
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
	  	<p><?="There are ".$count." results for : \"".$hashtag."\" tag ." ?></p>
	  	<p><?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?></p>
  		<?php if(!isset($posts) || count($posts)==0){ ?>
	  		<p>No posts to load!</p>
	  		<?php if(isset($_POST['search'])) { ?>
	  		<p><?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?></p>
	  		<? } ?>
	  	<?php } else {  
	  		foreach ($posts as $row){ ?>
	  			<article>	  	
					<h3>
						<a href="<?=base_url()?>posts/post/<?=$row['post_id']?>"><?=$row['cim']?></a><br />
						<?php if($this->session->userdata('user_type')=="admin") { ?>
						<a href="<?=base_url()?>posts/edit_post/<?=$row['post_id']?>">Edit</a> - 
						<a href="<?=base_url()?>posts/delete_post/<?=$row['post_id']?>">Delete</a>
						<? } ?>
					</h3>
					<span class="date"><?=$row['datum']?></span>
					<p class="post-exerpt"><?=substr(strip_tags($row['post_szoveg']),0,200).".."?><p>
					<p class="more-link"><a href="<?=base_url()?>posts/post/<?=$row['post_id']?>">Read More</a></p>
				</article>
			<?php }
		}; ?>
	<?php if(isset($pages)) { ?>
    <?=$pages?>
    <? } ?>
