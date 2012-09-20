<?php namespace components\project; if(!defined('TX')) die('No direct access.'); ?>

<h1>Issue #<?php echo $data->issue->id; ?>: <?php echo $data->issue->title; ?></h1>

<dl class="important issue-properties clearfix">

  <dt class="status"><?php __('Status'); ?></dt>
  <dd class="status"><?php echo $data->issue->status; ?></dd>

  <dt class="priority"><?php __('Priority'); ?></dt>
  <dd class="priority"><?php echo $data->issue->priority; ?></dd>

  <dt class="due_date">Due date</dt>
  <dd class="due_date"><?php echo $data->issue->due_date; ?></dd>
  
  <dt class="assigned_to">Assigned to</dt>
  <dd class="assigned_to"><?php echo $data->issue->assigned_to; ?></dd>

</dl>

<p class="issue-description">
  <?php echo $data->issue->description; ?>
</p>

<dl class="issue-properties">

  <dt><?php __('Start date'); ?></dt>
  <dd><?php echo $data->issue->start_date; ?></dd>

  <dt><?php __('Estimated hours'); ?></dt>
  <dd><?php echo $data->issue->estimated_hours; ?> hours</dd>

  <dt><?php __('Done ratio'); ?></dt>
  <dd><?php echo $data->issue->done_ratio; ?> %</dd>

  <dt><?php __('Created by'); ?></dt>
  <dd><?php echo $data->issue->author_id; ?></dd>

  <dt><?php __('Created on'); ?></dt>
  <dd><?php echo $data->issue->created_on; ?></dd>

  <dt><?php __('Updated on'); ?></dt>
  <dd><?php echo $data->issue->updated_on; ?></dd>

</dl>

<div class="issue-updates">

  <h2>Updates</h2>

  <?php
  $exclude_fields_in_update_list = array('id', 'parent_id', 'root_id', 'author_id', 'created_on');
  $data->issue->updates->each(function($update)use($exclude_fields_in_update_list){
    if(true || $update->parent_id->get() != $update->root_id->get()){
    ?>

    <div class="issue-update">
      <h3 class="issue-update-title">Update by <?php echo $update->author; ?> on <?php echo $update->created_on; ?></h3>
      <dl class="clearfix">
      <?php
      $update->each(function($row)use($exclude_fields_in_update_list){
        if(
          $row->get() != NULL &&
          $row->get() != 0 &&
          !in_array($row->key(), $exclude_fields_in_update_list)
        ){
        ?>
          <dt>Updated <?php echo $row->key(); ?>:</dt>
          <dd><?php echo $row; ?></dd>
        <?php
        }
      });
      ?>
      </dl>
    </div><!-- /.issue-update -->

    <?php
    }
  }); ?>

</div>

<div class="clear"></div>

<?php echo $data->update_issue; ?>
  