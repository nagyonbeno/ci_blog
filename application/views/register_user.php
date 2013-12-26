<h2>Register User</h2>
<?= form_open(base_url().'users/register'); ?>
<p><?= form_label('Username', 'nev'); ?> : <?php
$data_form = array(
	'name' 	=> 'nev',
	'id'  	=> 'nev',
	'size' 	=> '40',
	'value' => set_value('nev')
 	);
echo form_input($data_form);
?></p>
<p><?= form_label('Password', 'jelszo'); ?> : <?php
$data_form = array(
	'name'	=> 'jelszo',
	'id'  	=> 'jelszo',
	'size' 	=> '40'
	);
echo form_password($data_form);
?></p>
<p><?= form_label('Password confirmed', 'jelszo2'); ?> : <?php
$data_form = array(
	'name'	=> 'jelszo2',
	'id'  	=> 'jelszo2',
	'size' 	=> '40'
	);
echo form_password($data_form);
?></p>
<p><?= form_label('User type', 'user_type'); ?> : <?php
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
<?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?>