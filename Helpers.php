<?php namespace components\project; if(!defined('TX')) die('No direct access.');

class Helpers extends \dependencies\BaseComponent
{ 

  public function get_projects()
  {
    return $this->table('Projects')->order('title')->execute();
  }
  
}
