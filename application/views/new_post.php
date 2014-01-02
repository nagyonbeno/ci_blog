<h2>Add Post</h2>
<?= form_open(base_url().'posts/new_post'); ?>
<p><?= form_label('Title', 'cim'); ?> : <?php
$data_form = array(
  'name'  => 'cim',
  'id'    => 'cim',
  'size'  => '40',
  'value' => set_value('cim')
  );
echo form_input($data_form);
?></p>
<p><?= form_label('Post text', 'post_szoveg'); ?> : <?php
$data_form = array(
  'name'  => 'post_szoveg',
  'id'    => 'post_szoveg',
  'rows'  => '20',
  'cols'  => '70',
  'value' => set_value('post_szoveg')
  );
echo form_textarea($data_form);
?></p>
<p><?=form_label('Tags', 'hashtag');?> : <?php
$data_form = array(
  'id'          => 'hashtag',
  'name'        => 'hashtag',
  'size'        => '40',
  'placeholder' => 'Tag1,Tag2,etc..',
  'value'       => set_value('hashtag')
  );  
echo form_input($data_form);
?></p>
<?php if($this->session->userdata('user_type')=="admin") { ?>
<p><?=form_label('Status', 'statusz');?> : <?php
$options = array(
   '1' => 'Active',
   '0' => 'Inactive'
);
echo form_dropdown('statusz', $options);
?></p>
<? } ?>
<p><?= form_submit('','Post!'); ?></p>
<?= form_close(); ?> 
<?php if($errors) { ?>       
<div>
<?=$errors?>
</div>
<? } ?>
<?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?>
       
   



