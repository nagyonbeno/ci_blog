<section id="container">
	<div id="login">
		<h2>Login</h2>
		
		<?=form_open(base_url().'users/login'); ?>
		<p><?php
		$data_form = array(
			'name' 		  => 'nev',
			'id'   		  => 'nev',
			'size' 		  => '40',
			'placeholder' => 'Username'
			);	
		echo form_input($data_form);
		?></p>
		<p><?php
		$data_form = array(
			'id'   		  => 'jelszo',
			'name' 		  => 'jelszo',
			'size'		  => '40',
			'placeholder' => 'Password'
		 	);
		echo form_password($data_form);	
		?></p>
		<p><?php
		$options = array(
			'' 		 => '---',
			'user'   => 'User',
			'author' => 'Author',
			'admin'  => 'Admin'
			);
		echo form_dropdown('user_type', $options);
		?></p>
		<p><?=form_submit('', 'Login');?></p>
		<?=form_close()?>
		<?php if($error==1){ ?>
		<p>Your username / password did not match!</p>
		<? } ?>
		<p><?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?></p>
	</div>







