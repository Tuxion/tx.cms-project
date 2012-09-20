<?php namespace components\project; if(!defined('TX')) die('No direct access.'); ?>


<h1><?php __('Projects'); ?></h1>

<?php echo $data->projects->as_list(function($row){
  return '<a href="'.url('view=project&project_id='.$row->id, true).'">'.$row->title.'</a>';
}); ?>

<h1><?php __('New project'); ?></h1>

<form action="<?php echo url('action=project/save_project/post'); ?>" method="post">

  <div class="ctrlHolder">
    <label><?php echo __('Title'); ?></label>
    <input type="text" name="title" value="">
  </div>

  <div class="ctrlHolder">
    <label><?php echo __('Description'); ?></label>
    <input type="text" name="description" value="">
  </div>

  <div class="ctrlHolder">
    <label><?php echo __('Homepage'); ?></label>
    <input type="text" name="homepage" value="http://">
  </div>

  <div class="buttonHolder">
    <input type="submit" value="<?php __('Save project'); ?>">
  </div>

</form>