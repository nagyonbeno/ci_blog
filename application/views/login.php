<h2>Login</h2>
<?php if($error==1){ ?>
<p>Your username / password did not match!</p>
<? } ?>
<?=form_open(base_url().'users/login'); ?>
<p><?=form_label('Username', 'nev');?> : <?php
$data_form = array(
	'name' => 'nev',
	'id'   => 'nev',
	'size' => '40'
	);	
echo form_input($data_form);
?></p>
<p><?=form_label('Password', 'jelszo');?> : <?php
$data_form = array(
	'id'   => 'jelszo',
	'name' => 'jelszo',
	'size' => '40'
 	);
echo form_password($data_form);	
?></p>
<p><?=form_label('User type', 'user_type');?> : <?php
$options = array(
	'' => '---',
	'user' => 'User',
	'author' => 'Author',
	'admin' => 'Admin'
	);
echo form_dropdown('user_type', $options);
?></p>
<?=form_submit('', 'Login');?>
<?=form_close()?>
<?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?>








