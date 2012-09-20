<?php namespace components\project; if(!defined('TX')) die('No direct access.');

class Modules extends \dependencies\BaseViews
{

  protected $default_permissions = 1;

  protected function project_list()
  {

    return array(
      'projects' => tx('Component')->helpers('project')->get_projects()
    );

  }
 

}
