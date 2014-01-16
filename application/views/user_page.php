<section id="container">
	<section id="personal_page">
		<h2><?=$user_details['nev']?>'s data sheet:</h2>
		<p>username:<?=$user_details['nev']?></p>
		<p>email:<?=$user_details['email']?></p>
		<p>registration time:<?=$user_details['reg_ideje']?></p>
		<p><?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?></p>
	</section>
	<p><?=$user_details['nev']?>'s posts:</p>
	<p>there is/are <?=$posts_number?> posts</p>
	<?php foreach ($user_posts as $row){ ?>
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
			<?php } ?>
			<?php if(isset($pages)) { ?>
    			<?=$pages?>
    		<? } ?>
	

