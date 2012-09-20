<?php namespace components\project; if(!defined('TX')) die('No direct access.');

class Sections extends \dependencies\BaseViews
{

  /**
   * Frontend
   */

  protected function projects()
  {

    return array(
      'projects' => tx('Component')->helpers('project')->get_projects()
    );

  }
 
  protected function project()
  {

    return array(
      'proj' => $this->table('Projects')->pk(tx('Data')->get->project_id)->execute_single(),
      'issues' => tx('Component')->sections('project')->get_html('issues')
    );

  }
 
  protected function issues()
  {

    return array(
      'issues' => $this->table('Issues')->where('project_id', tx('Data')->get->project_id)->where('parent_id', 'NULL')->order('created_on', 'ASC')->execute(),
      'new_issue' => tx('Component')->sections('project')->get_html('edit_issue')
    );

  }
 
  protected function issue()
  {

    $issue =
      $this
      ->table('Issues')
      ->where('id', tx('Data')->get->issue_id)
      ->execute_single();

    $latest_mutation =
      $this
      ->table('Issues')
      ->where('root_id', $issue->id->get())
      ->order('created_on', 'DESC')
      ->limit(1)
      ->execute_single()
      ->id;

    return array(
      'issue' => $issue,
      'proj' => $this->table('Projects')->pk($issue->project_id)->execute_single(),
      'update_issue' => tx('Component')->sections('project')->get_html('edit_issue', array('parent_id' => $latest_mutation->otherwise(tx('Data')->get->issue_id)))
    );

  }

  protected function edit_issue($options = null)
  {

    return array(
      'issue' => $this->table('Issues')->pk($options->parent_id->otherwise(tx('Data')->get->issue_id))->execute_single(),
      'issue_statuses' => $this->table('IssueStatuses')->order('position')->execute(),
      'issue_priorities' => $this->table('IssuePriorities')->order('position')->execute(),
      'users_to_assign_to' => $this->table('Users')->order('username')->execute()
    );

  }

}
