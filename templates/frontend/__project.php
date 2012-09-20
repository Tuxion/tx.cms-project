<?php namespace components\project; if(!defined('TX')) die('No direct access.'); ?>

<h1><a href="<?php echo url('view=projects&project_id=NULL'); ?>"><?php __('Projects'); ?></a> &raquo; <?php echo $data->proj->title; ?></h1>

<?php echo $data->issues; ?>

