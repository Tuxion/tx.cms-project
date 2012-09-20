<?php namespace components\project; if(!defined('TX')) die('No direct access.');
$new = !$data->issue->id->is_set();
?>

<h1><?php __(($new ? 'New' : 'Update').' issue'); ?></h1>

<form action="<?php echo url('action=project/save_issue/post'); ?>" method="post">

  <input type="hidden" name="project_id" value="<?php echo $data->issue->project_id->otherwise(tx('Data')->get->project_id); ?>">
  <input type="text" name="parent_id" value="<?php echo $data->issue->id; ?>">
  <input type="hidden" name="root_id" value="<?php echo $data->issue->root_id->otherwise(''); ?>">

  <?php /*
  <div class="ctrlHolder">
    <label><?php echo __('Tracker'); ?></label>
    <?php echo $data->issue_trackers->as_options('tracker_id', 'title', 'id', array('default' => ($data->issue->tracker_id->is_set() ? $data->issue->tracker_id : 1))); ?>
  </div>
  */ ?>

  <?php if($new){ ?>
  <div class="ctrlHolder">
    <label><?php echo __('Subject'); ?></label>
    <input type="text" name="title" value="">
  </div>

  <div class="ctrlHolder">
    <label><?php echo __('Description'); ?></label>
    <input type="text" name="description" value="">
  </div>
  <?php } ?>

  <div class="ctrlHolder">
    <label><?php echo __('Start date'); ?></label>
    <input type="date" name="start_date" value="<?php echo ($data->issue->start_date->is_set() ? $data->issue->start_date : date('Y-m-d')); ?>">
  </div>

  <div class="ctrlHolder">
    <label><?php echo __('Due date'); ?></label>
    <input type="date" name="due_date" value="<?php echo ($data->issue->due_date->is_set() ? $data->issue->due_date : date('Y-m-d')); ?>">
  </div>

  <div class="ctrlHolder">
    <label><?php echo __('Status'); ?></label>
    <?php echo $data->issue_statuses->as_options('status_id', 'title', 'id', array('default' => ($data->issue->status_id->is_set() ? $data->issue->status_id : 2))); ?>
  </div>

  <div class="ctrlHolder">
    <label><?php echo __('Priority'); ?></label>
    <?php echo $data->issue_priorities->as_options('priority_id', 'title', 'id', array('default' => ($data->issue->priority_id->is_set() ? $data->issue->priority_id : 2))); ?>
  </div>

  <div class="ctrlHolder">
    <label><?php echo __('Assigned to'); ?></label>
    <?php echo $data->users_to_assign_to->as_options('assigned_to_id', 'username', 'id', array('default' => ($data->issue->assigned_to_id->is_set() ? $data->issue->assigned_to_id : tx('Account')->user->id))); ?>
  </div>

  <div class="ctrlHolder">
    <label><?php echo __('Estimated hours'); ?></label>
    <input type="text" name="estimated_hours" value="<?php echo $data->issue->estimated_hours->otherwise('0.0'); ?>">
  </div>

  <div class="ctrlHolder">
    <label><?php echo __('Done ratio'); ?></label>
    <select name="done_ratio">
      <?php for($i = 0; $i <= 100; $i = $i + 10){
        echo '<option value="'.$i.'"'.($i == $data->issue->done_ratio->get() ? ' selected="selected"' :  '').'>'.$i.' %</option>';
      } ?>
    </select>
  </div>

  <div class="ctrlHolder">
    <label><?php echo __('Comment'); ?></label>
    <textarea name="comment"><?php echo $data->issue->comment; ?></textarea>
  </div>

  <div class="buttonHolder">
    <input type="submit" value="<?php __('Save issue'); ?>">
  </div>

</form>