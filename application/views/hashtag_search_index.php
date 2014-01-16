      <nav>
      	<section class="user_logged">
	      <?php if($this->session->userdata('user_id')){ ?>
	      <p>Hello <?=$this->session->userdata('username')?>!</p>
	      <p>You are <?=$this->session->userdata('user_type')?>.</p>
	  	</section>
	  	<section class="menu">
	      <p><?= anchor('/users/logout', 'Log out', 'title="Log out"'); ?></p>
	      <?php if($this->session->userdata('user_type')=="author" || $this->session->userdata('user_type')=="admin") { ?>
	      <p><?= anchor('/posts/new_post', 'Add Post', 'title="Add post"'); ?></p>
	      	<?php if($this->session->userdata('user_type')=="admin") { ?>
	      		<?= anchor('/posts/posts_approve', 'Approve Posts', 'title="Approve posts"'); ?>
	      	<? } ?>
	      <? } ?>
	      <? } else { ?>
	      <section class="menu">
		      <p><?= anchor('/users/login', 'Login', 'title="Login"'); ?></p>
		      <p><?= anchor('/users/register', 'Sign up', 'title="Sign up"'); ?></p>
	      </section>
	      <? } ?>
	      <div class="clear"></div>
	  	</section>
	  </nav>  
	  <section id="container">
	  	<?php if(count($posts)>0){ ?>
	      <?= form_open(base_url().'posts/index'); ?> 
		    <p> 
		    <?php $data_form = array(
		      'name'  => 'search',
		      'id'    => 'search',
		      'size'  => '40',
		      );
		    echo form_input($data_form);?>
		    <?= form_submit('','Search!'); ?>
			<?= form_close(); ?></p>
		<?php if(isset($errors)) { ?>
			<?=$errors?>
	  	<? } ?>
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
					<p class="clear"><img src="<?=base_url()?>assets/pics/writing.png" alt="Author" /><a href="<?=base_url()?>users/user/<?=$row['user_id']?>"><?=$row['nev']?></a><span class="date"><img src="<?=base_url()?>assets/pics/calendar.png" alt="Time" /><?=$row['datum']?></span></p>
					<p class="post-exerpt">
						<?php if(strlen($row['post_szoveg'])>400) {
						echo substr(strip_tags($row['post_szoveg']),0,400)."...";
					}else{
						echo strip_tags($row['post_szoveg']);
					} ?>
					<p>
					<p class="more-link"><a href="<?=base_url()?>posts/post/<?=$row['post_id']?>">Read More</a></p>
				</article>
			<?php }
		}; ?>
	<?php if(isset($pages)) { ?>
    <?=$pages?>
    <? } ?>
