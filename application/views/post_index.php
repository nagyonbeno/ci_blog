      <?php if($this->session->userdata('user_id')){ ?>
      <p>Hello <?=$this->session->userdata('username')?>!</p>
      <p>You are <?=$this->session->userdata('user_type')?>.</p>
      <?= anchor('/users/logout', 'Log out', 'title="Log out"')."<br />"; ?>
      <?php if($this->session->userdata('user_type')=="author" || $this->session->userdata('user_type')=="admin") { ?>
      <?= anchor('/posts/new_post', 'Add Post', 'title="Add post"')."<br />"; ?>
      <? } ?>
      <? } else { ?>
      <?= anchor('/users/login', 'Login', 'title="Login"')."<br />"; ?>
      <?= anchor('/users/register', 'Sign up', 'title="Sign up"'); ?>
      <? } ?>
      <?= form_open(base_url().'posts/index'); ?> 
	    <p> 
	    <?php 
	    $data_form = array(
	      'name'  => 'search',
	      'id'    => 'search',
	      'size'  => '40',
	      );
	    echo form_input($data_form);?>
	    <?= form_submit('','Search!'); ?></p>
		<?= form_close(); ?>
  		<?php if(!isset($posts)){ ?>
	  		<p>No posts to load foo!</p>
	  	<?php } else { 
	  		foreach ($posts as $row){ ?>
	  			<article>		  	
					<h3>
						<a href="<?=base_url()?>posts/post/<?=$row['post_id']?>"><?=$row['cim']?></a><br />
						<?php if($this->session->userdata('user_type')=="author" || $this->session->userdata('user_type')=="admin") { ?>
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
    <?=$pages?>
