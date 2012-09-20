<?php namespace components\project\models; if(!defined('TX')) die('No direct access.');

class Projects extends \dependencies\BaseModel
{

  protected static

    $table_name = 'project__projects';

    // $relations = array(
    //   'ThingTypes'=>array('type_id' => 'ThingsTypes.id'),
    //   'ThingLocations'=>array('id' => 'ThingLocations.thing_id')
    // );

  // public function get_urls()
  // {

  //   return $this->table('ThingUrls')->where('thing_id', $this->id)->order('order_nr')->execute();

  // }

}
