<?php namespace components\project; if(!defined('TX')) die('No direct access.');

class Views extends \dependencies\BaseViews
{

  protected function app()
  {

    $v = tx('Data')->get->view;

    switch($v)
    {
      case 'projects':
      case 'project':
      case 'issue':
        $r = $this->section($v);
        break;
      default:
        $r = $this->section('projects');
        break;
    }

    return $r;

  }

}