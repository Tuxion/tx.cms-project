<?php namespace components\project\models; if(!defined('TX')) die('No direct access.');

class IssueStatuses extends \dependencies\BaseModel
{

  protected static

    $table_name = 'project__issue_statuses',

    $relations = array(
      'Issues'=>array('id' => 'Issues.status_id')
    );

}
