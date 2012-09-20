<?php namespace components\project; if(!defined('TX')) die('No direct access.');

class EntryPoint extends \dependencies\BaseEntryPoint
{
  
  public function entrance()
  {
    
    //Display a login page?
    if(!tx('Account')->user->check('login'))
    {
      return $this->template('tx_login', 'tx_login', array(), array(
        'content' => tx('Component')->sections('account')->get_html('login_form')
      ));
    }

    //Otherwise: show project management app.
    else
    {

      return $this->template('project', array('plugins' => array(
        load_plugin('jquery'),
        load_plugin('jquery_ui'),
        load_plugin('jsFramework'),
        load_plugin('html5shiv'),
        load_plugin('jquery_appear'),
        load_plugin('jquery_smoothDivScroll')
      )),
      array(
        'content' => $this->view('app')
      ));

    }
   
  }

}
