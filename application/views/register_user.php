<section id="container">
	<section id="regist">
		<h2>Sign Up User</h2>
		<?= form_open_multipart(base_url().'users/register'); ?>
		<p><?php
		$data_form = array(
			'name' 		  => 'nev',
			'id'  		  => 'nev',
			'size' 		  => '40',
			'placeholder' => 'Username',
			'value' 	  => set_value('nev')
		 	); 
		echo form_input($data_form);
		?></p>
		<p><?php
		$data_form = array(
			'name' 		  => 'email',
			'id'  		  => 'email',
			'size' 		  => '40',
			'placeholder' => 'E-mail address',
			'value' 	  => set_value('email')
		 	); 
		echo form_input($data_form);
		?></p>
		<p><?php
		$data_form = array(
			'name'		  => 'jelszo',
			'id'  		  => 'jelszo',
			'size' 		  => '40',
			'placeholder' => 'Password'
			);
		echo form_password($data_form);
		?></p>
		<p><?php
		$data_form = array(
			'name'		  => 'jelszo2',
			'id'  		  => 'jelszo2',
			'size' 		  => '40',
			'placeholder' => 'Confirm Password'
			); 
		echo form_password($data_form);
		?></p>
		<p><?php
		$data_form = array(
			'name'		  => 'kep',
			'id'		  => 'kep'
 			); 
		echo form_upload($data_form);
		?></p>
		<p><?php
		$options = array(
			'' 		 => '---',
			'author' => 'Author',
			'user'   => 'User'
			); 
		echo form_dropdown('user_type',$options,set_value('user_type'));
		?></p>
		<p><?= form_submit('','Register'); ?></p>
		<?= form_close(); ?>
		<?php if($errors) { ?>
		<div>
			<?=$errors?>
		</div>
		<? } ?>
		<p class="back"><?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?></p>
	</section>