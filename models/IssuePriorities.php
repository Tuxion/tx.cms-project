<?php namespace components\project\models; if(!defined('TX')) die('No direct access.');

class IssuePriorities extends \dependencies\BaseModel
{

  protected static

    $table_name = 'project__issue_priorities',

    $relations = array(
      'Issues'=>array('id' => 'Issues.priority_id')
    );

}
