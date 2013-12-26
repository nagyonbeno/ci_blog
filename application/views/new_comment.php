<?php if($this->session->userdata('user_id')){ ?>
<?= form_open(base_url().'comments/new_comment'); ?> 
<p><?= form_label('Leave a comment', 'comment'); ?> : <br /><?php
$data_form = array(
  'name'  => 'comment',
  'id'    => 'comment',
  'rows'  => '10',
  'cols'  => '40',
  'value' => set_value('comment')
  );
echo form_textarea($data_form);
?></p>
<input type="hidden" name="post_id" value="<?= $post['post_id'] ?>" />
<?= form_submit('','Post!'); ?></p>
<?= form_close(); ?>
<? } ?>
<?php if($errors) { ?>       
<div>
<?=$errors?>
</div>
<? } ?>