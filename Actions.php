<?php namespace components\project; if(!defined('TX')) die('No direct access.');

class Actions extends \dependencies\BaseComponent
{

  protected function save_project($data)
  {
    
    $project_id = 0;
    tx($data->id->get('int') > 0 ? 'Updating a project.' : 'Adding a new project', function()use($data, &$project_id){
      
      //Append user object for easy access.
      $user_id = tx('Data')->session->user->id;

      //Save project.
      $project = tx('Sql')->table('project', 'Projects')->pk($data->id->get('int'))->execute_single()->is('empty')
        ->success(function()use($data, $user_id, &$project_id){
          tx('Sql')->model('project', 'Projects')->merge($data->having('title', 'description', 'homepage', 'parent_id'))->merge(array('created_on' => time()))->save();
          $project_id = mysql_insert_id();
        })
        ->failure(function($project)use($data, $user_id, &$project_id){
          $project->merge($data->having('title', 'description', 'homepage', 'parent_id'))->merge(array('updated_on' => time()))->save();
          $project_id = $project->id->get('int');
        });

    })
    
    ->failure(function($info){
      throw $info->exception;
    });

    tx('Url')->redirect(url('view=projects&project_id=NULL'));
    
  }

  protected function save_issue($data)
  {
    
    $issue_id = 0;
    tx($data->id->get('int') > 0 ? 'Updating an issue.' : 'Adding a new issue', function()use($data, &$issue_id){

      $data->root_id = $data->root_id->otherwise(NULL);
      $data->parent_id = $data->parent_id->otherwise(NULL);

      //Append user object for easy access.
      $user_id = tx('Data')->session->user->id;

      //Save issue.
      $issue = tx('Sql')->table('project', 'Issues')->pk($data->id->get('int'))->execute_single()->is('empty')
        ->success(function()use(&$data, $user_id, &$issue_id){

          //Check if an root issue already exists.
          tx('Sql')->table('project', 'Issues')->pk(tx('Data')->get->issue_id)->execute_single()->is('empty')
            ->failure(function($root_issue)use(&$data, $user_id, &$issue_id){

              //Check which fields are changed since the last issue mutation.
              $parent_mutation = tx('Sql')->table('project', 'Issues')->pk($data->parent_id)->execute_single()->is('empty')
                ->failure(function($parent_issue)use($data, &$mutation_data){

                  //Compare values of parent mutation with the current mutation.
                  $mutation_data = Data();
                  $data->each(function($row)use($parent_issue, &$mutation_data){
                    if( $row->get() != $parent_issue->{$row->key()}->get() ){
                      $mutation_data->{$row->key()} = $row->get();
                    }
                  });

                });

              //Update root issue.
              $root_issue->merge($data->having('project_id', 'tracker_id', 'title', 'description', 'start_date', 'due_date', 'category_id', 'status_id', 'assigned_to_id', 'priority_id', 'done_ratio', 'estimated_hours', 'comment'))->merge(array('updated_on' => time()))->save();
              $data->root_id = $root_issue->id;

              //Now save the issue mutation.
              tx('Sql')->model('project', 'Issues')->merge($mutation_data->having('project_id', 'tracker_id', 'title', 'description', 'start_date', 'due_date', 'category_id', 'status_id', 'assigned_to_id', 'priority_id', 'done_ratio', 'estimated_hours', 'comment'))->merge(array('created_on' => time(), 'author_id' => $user_id, 'parent_id' => $data->parent_id->otherwise($issue_id), 'root_id' => $data->root_id))->save();

            })
            ->success(function()use(&$data, $user_id, &$issue_id){

              //If this is a new issue: insert root issue.
              tx('Sql')->model('project', 'Issues')->merge($data->having('project_id', 'tracker_id', 'title', 'description', 'start_date', 'due_date', 'category_id', 'status_id', 'assigned_to_id', 'priority_id', 'done_ratio', 'estimated_hours', 'comment'))->merge(array('created_on' => time(), 'author_id' => $user_id, 'parent_id' => $data->parent_id, 'root_id' => $data->root_id))->save();
              $data->root_id = $issue_id = mysql_insert_id();

              //And save the first issue mution.
              tx('Sql')->model('project', 'Issues')->merge($data->having('project_id', 'tracker_id', 'title', 'description', 'start_date', 'due_date', 'category_id', 'status_id', 'assigned_to_id', 'priority_id', 'done_ratio', 'estimated_hours', 'comment'))->merge(array('created_on' => time(), 'author_id' => $user_id, 'parent_id' => $data->parent_id->otherwise($issue_id), 'root_id' => $data->root_id))->save();

            });

        });

    })
    
    ->failure(function($info){
      throw $info->exception;
    });

    tx('Url')->redirect(url('view=issue&issue_id='.$data->root_id));
    
  }

  protected function delete_item($data)
  {
    $item = tx('Sql')->table('tuxion', 'Items')->pk($data->item_id)->execute_single()->is('empty', function()use($data){
      throw new \exception\User('Could not delete this item, because no entry was found in the database with id %s.', $data->id);
    })
    ->delete();
  }
 

}
