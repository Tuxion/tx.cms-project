<?php namespace components\project\models; if(!defined('TX')) die('No direct access.');

class Issues extends \dependencies\BaseModel
{

  protected static

    $table_name = 'project__issues',

    $relations = array(
      'Authors'=>array('author_id' => 'Authors.id'),
      'IssuePriorities'=>array('priority_id' => 'IssuePriorities.id'),
      'IssueStatuses'=>array('status_id' => 'IssueStatuses.id')
    );

  public function get_status()
  {
    return $this->table('IssueStatuses')->where('id', $this->status_id)->execute_single()->title;
  }
  public function get_priority()
  {
    return $this->table('IssuePriorities')->where('id', $this->priority_id)->execute_single()->title;
  }
  public function get_author()
  {
    return $this->table('Authors')->where('id', $this->author_id)->execute_single()->username->otherwise($this->author_id);
  }
  public function get_assigned_to()
  {
    return $this->table('Users')->where('id', $this->assigned_to_id)->execute_single()->username->otherwise($this->author_id);
  }
  public function get_updates(){
    return $this->table('Issues')->where('root_id', $this->id)->order('created_on')->execute();
  }

}
