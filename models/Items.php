<?php namespace components\project\models; if(!defined('TX')) die('No direct access.');

class Things extends \dependencies\BaseModel
{

  protected static

    $table_name = 'vamenos__things',

    $relations = array(
      'ThingTypes'=>array('type_id' => 'ThingsTypes.id')
    );

  public function get_stuff()
  {

    return true;

  }

}
