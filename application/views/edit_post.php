<h2>Edit Post</h2>
<?php if($success==1) { ?>
<div>This post have been updated!</div>
<? } ?>
<?= form_open(base_url().'posts/edit_post/'.$post['post_id']); ?>
<p><?= form_label('Title', 'cim'); ?> : <?php
$data_form = array(
  'name'  => 'cim',
  'id'    => 'cim',
  'size'  => '40',
  'value' => set_value('cim',$post['cim'])
  );
echo form_input($data_form);
?></p>
<p><?= form_label('Post text', 'post_szoveg'); ?> : <?php
$data_form = array(
  'name'  => 'post_szoveg',
  'id'    => 'post_szoveg',
  'rows'  => '20',
  'cols'  => '70',
  'value' => set_value('post_szoveg',$post['post_szoveg'])
  );
echo form_textarea($data_form);
?></p>
<p><?=form_label('Tags', 'hashtag');?> : <?php
$data_form = array(
  'id'   => 'hashtag',
  'name' => 'hashtag',
  'size' =>  '40',
  'value'=> set_value('hastah',$post['hashtag'])
  );  
echo form_input($data_form);
?></p>
<p><?= form_submit('','Edit!'); ?></p>
<?= form_close(); ?> 
<?php if($errors) { ?>       
<div>
<?=$errors?>
</div>
<? } ?>    
<?= anchor('', 'Back to the posts', 'title="Back to the posts"'); ?>






