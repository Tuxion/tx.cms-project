<?php namespace components\project\models; if(!defined('TX')) die('No direct access.');

class Places extends \dependencies\BaseModel
{

  protected static

    $table_name = 'vamenos__places',

    $relations = array(
      'ThingLocations'=>array('id' => 'ThingLocations.place_id')
    );

  public function get_stuff()
  {

    return true;

  }

}
