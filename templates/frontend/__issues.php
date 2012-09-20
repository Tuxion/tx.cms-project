<?php namespace components\project; if(!defined('TX')) die('No direct access.'); ?>

<?php echo $data->issues->as_table(array(
  __('#', 1) => function($row){return $row->id;},
  __('Status', 1) => function($row){return $row->status;},
  __('Priority', 1) => function($row){return $row->priority;},
  __('Title', 1) => function($row){return $row->title;},
  __('view', 1) => function($row){
    return '<a class="view" href="'.url('view=issue&issue_id='.$row->id).'">'.__('view', 1).'</a>';
  }
));
?>

<?php echo $data->new_issue; ?>